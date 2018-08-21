<?php

namespace App\Http\Controllers\Front;

use App\Models\Common\CategoryModel;
use App\Models\Common\CommentModel;
use App\Models\Common\DynamicModel;
use App\Models\Common\OtherTagModel;
use App\Models\Common\SupportModel;
use App\Models\Common\TagModel;
use App\Models\Common\VideoModel;
use App\Models\Front\CollectionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Qiniu\Storage\UploadManager;

class VideoController extends Controller
{
    //视频列表
    public function index()
    {
        $videos = DB::table('videos')
            ->leftjoin('users', 'videos.user_id', '=', 'users.id')
            ->where('videos.status','=','1')
            ->select('videos.id as id',
                'videos.title as title',
                'users.id as user_id',
                'users.name as author',
                'videos.thumb as thumb',
                'videos.hits as hits',
                'videos.comments as comments',
                'videos.created_at as created_at'
            )
            ->orderBy('videos.created_at','desc')
            ->paginate('16');
        //相关话题
        $tags = TagModel::all();
        //话题分类
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        return view('ask.video.index',['videos'=>$videos,'tags'=>$tags,'cates'=>$cates,'cid'=>'']);
    }

    //视频分类筛选列表
    public function cate(Request $request)
    {
        $this->validate($request, ['cid'=>'required|numeric|exists:category,id']);
        $videos = DB::table('videos')
            ->leftjoin('users', 'videos.user_id', '=', 'users.id')
            ->where('videos.cate_id','=',$request->get('cid'))
            ->where('videos.status','=','1')
            ->select('videos.id as id',
                'videos.title as title',
                'users.id as user_id',
                'users.name as author',
                'videos.thumb as thumb',
                'videos.hits as hits',
                'videos.comments as comments',
                'videos.created_at as created_at'
            )
            ->orderBy('videos.created_at','desc')
            ->paginate('16');
        //话题分类
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        //相关话题
        $tags = TagModel::all();
        return view('ask.video.index',['videos'=>$videos,'tags'=>$tags,'cates'=>$cates,'cid'=>$request->get('cid')]);
    }

    //新增视频
    public function create()
    {
        $tags = TagModel::all();
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        return view('ask.video.create',[
            'cates'=>$cates,
            'tags'=>$tags
        ]);
    }

    //视频存储
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'cid'=>'required|numeric|exists:category,id',
            'title'=>'required|min:2',
            'thumb'=>'required|image|max:2048',
            'excerpt'=>'required|min:10',
            'local_video'=>'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime,video/x-m4v,video/webm',
            'status'=>'required|numeric|min:0|max:1'
        ],[
            'required'=>':attribute为必填项',
            'min'=>':attribute至少 :min个字节长',
            'max'=>':attribute超出限制',
            'image'=>':attribute格式错误',
            'mimetypes'=>':attribute格式错误',
            'url'=>':attribute格式错误'
        ],[
            'cid'=>'分类',
            'title'=>'标题',
            'thumb'=>'头图',
            'excerpt'=>'简介',
            'local_video'=>'视频',
            'status'=>'状态',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //存储图片
        $filePath = $request->file('thumb');
        $type = $filePath->getMimeType();
        $upManager = new UploadManager();
        $auth = new \Qiniu\Auth(env('QINIU_ACCESS_KEY'), env('QINIU_SECRET_KEY'));
        $token = $auth->uploadToken(env('QINIU_BUCKET'));
        $key = md5(time().rand(1,9999));
        list($ret,$error) = $upManager->putFile($token,$key,$filePath,null,$type,false);
        if($error){
            return redirect()->back()->withErrors(['error'=>'保存失败']);
        }else{
            $imgPath = env('QINIU_DOMAIN').'/'.$ret['key'];
        }
        //存储视频
        $filePath = $request->file('local_video');
        $type = $request->file('local_video')->getMimeType();
        $upManager = new UploadManager();
        $auth = new \Qiniu\Auth(env('QINIU_ACCESS_KEY'), env('QINIU_SECRET_KEY'));
        $token = $auth->uploadToken(env('QINIU_BUCKET'));
        $key = md5(time().rand(1,9999));
        list($ret,$error) = $upManager->putFile($token,$key,$filePath,null,$type,false);
        if($error){
            return redirect()->back()->withErrors(['error'=>'保存失败']);
        }else{
            $videoPath = env('QINIU_DOMAIN').'/'.$ret['key'];
        }
        $data = [
            'user_id'  => Auth::user()->id,
            'cate_id'  => $request->get('cid'),
            'title'    => trim($request->get('title')),
            'excerpt'  => $request->get('excerpt'),
            'thumb'  => $imgPath,
            'url'  =>  $videoPath,
            'status'   => $request->get('status'),
        ];

        $videoId = VideoModel::create($data);
        //tags不为空
        if(!empty($request->get('tags')[0]))
        {
            //只取前5个标签存入
            $tmpArr = array_only($request->get('tags'), ['0','1','2','3','4']);
            foreach($tmpArr as $tag)
            {
                //话题视频总数自增一
                DB::table("tags")->where('id',$tag)->increment("videos");
                OtherTagModel::updateOrCreate([
                    'source_id'=>$videoId->id,
                    'tag_id'=>$tag,
                    'source_type'=>'3'
                ],[
                    'source_id'=>$videoId->id,
                    'tag_id'=>$tag,
                    'source_type'=>'3'
                ]);
            }
        }
        //用户动态表
        if($request->get('status'))
        {
            DynamicModel::updateOrCreate([
                'uid'=>Auth::user()->id,
                'source_id'=>$videoId->id,
                'source_action'=>'3'
            ],[
                'uid'=>Auth::user()->id,
                'source_id'=>$videoId->id,
                'source_action'=>'3',
                'subject'=>trim($request->get('title'))
            ]);
        }else{
            DynamicModel::where([
                'uid'=>Auth::user()->id,
                'source_id'=>$videoId->id,
                'source_action'=>'3'
            ])->delete();
        }
        return redirect('/video');
    }

    //视频详情
    public function detail(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:videos,id'
        ]);
        //浏览数自增
        DB::table("videos")->where('id',$request->get('id'))->increment("hits");
        //查询视频
        $datas = DB::table('videos')
            ->leftjoin('users', 'videos.user_id', '=', 'users.id')
            ->leftjoin('category', 'videos.cate_id', '=', 'category.id')
            ->where('videos.id','=',$request->get('id'))
            ->select('videos.id as video_id',
                'videos.title as title',
                'users.name as author',
                'users.avator as avator',
                'videos.user_id as user_id',
                'category.name as catename',
                'videos.cate_id as cateid',
                'videos.excerpt as excerpt',
                'videos.url as url',
                'videos.thumb as thumb',
                'videos.likes as likes',
                'videos.created_at as created_at',
                'videos.comments as comments'
            )->orderBy('videos.created_at','desc')->get();
        //标签
        $tagss = DB::table('other_tag')
            ->leftjoin('tags', 'other_tag.tag_id', '=', 'tags.id')
            ->where('other_tag.source_id','=',$request->get('id'))
            ->where('other_tag.source_type','=','3')
            ->select(
                'tags.name as name',
                'tags.id as id'
            )
            ->orderBy('tags.created_at','desc')
            ->paginate('5');
        //评论内容
        $comments = DB::table('comments')
            ->leftjoin('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.source_id','=',$request->get('id'))
            ->where('comments.status','=','1')
            ->where('comments.source_type','=','3')
            ->select('comments.id as comment_id',
                'comments.user_id as user_id',
                'comments.source_id as video_id',
                'comments.content as content',
                'comments.to_user_id as to_user_id',
                'comments.created_at as created_at',
                'comments.status as status',
                'users.name as commentator',
                'users.avator as avator')
            ->orderBy('comments.created_at','desc')
            ->paginate('10');
        //点赞总数
        $supports = SupportModel::where(['source_id'=>$request->get('id'),'source_type'=>'3','rating'=>'1'])->count();
        //是否收藏
        if(!empty(Auth::id()))
        {
            if(CollectionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'3'])->exists())
            {
                $isCollected = true;
            }else{
                $isCollected = false;
            }
            //是否点赞
            if(SupportModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'3','rating'=>'1'])->exists())
            {
                $isSupported = true;
            }else{
                $isSupported = false;
            }

        }else{
            $isCollected = false;
            $isSupported = false;
        }
        return view('ask.video.detail',['datas'=>$datas[0],'tagss'=>$tagss,'comments'=>$comments,'supports'=>$supports,'id'=>$request->get('id'),'isCollected'=>$isCollected,'isSupported'=>$isSupported]);
    }

    //视频编辑
    public function edit(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:videos,id'
        ]);
        $datas =VideoModel::where([
            'id'=>$request->get('id'),
            'user_id'=>Auth::id()
        ])->get();
        //该视频选中的标签
        $selectedTags = DB::table('other_tag')
            ->leftjoin('tags', 'other_tag.tag_id', '=', 'tags.id')
            ->where('other_tag.source_id','=',$request->get('id'))
            ->where('other_tag.source_type','=','3')
            ->pluck('tags.id as id')->toArray();
        $tags = TagModel::all();
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        return view('ask.video.edit',[
            'cates'=>$cates,
            'tags'=>$tags,
            'selectedTags'=>$selectedTags,
            'datas'=>$datas[0]
        ]);
    }
    //更新保存
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:videos,id',
            'cid' => 'required|numeric|exists:category,id',
            'title' => 'required|min:2',
            'thumb' => $request->get('thumb') ? 'required|image|max:2048' : "",
            'excerpt' => 'required|min:10',
            'local_video' => $request->get('local_video') ? 'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime,video/x-m4v,video/webm' : "",
            'status' => 'required|numeric|min:0|max:1'
        ], [
            'required' => ':attribute为必填项',
            'min' => ':attribute至少 :min个字节长',
            'max' => ':attribute超出限制',
            'image' => ':attribute格式错误',
            'mimetypes' => ':attribute格式错误',
            'url' => ':attribute格式错误'
        ], [
            'cid' => '分类',
            'title' => '标题',
            'thumb' => '头图',
            'excerpt' => '简介',
            'local_video' => '视频',
            'status' => '状态',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!empty($request->file('thumb')))
        {
            //存储图片
            $filePath = $request->file('thumb');
            $type = $filePath->getMimeType();
            $upManager = new UploadManager();
            $auth = new \Qiniu\Auth(env('QINIU_ACCESS_KEY'), env('QINIU_SECRET_KEY'));
            $token = $auth->uploadToken(env('QINIU_BUCKET'));
            $key = md5(time().rand(1,9999));
            list($ret,$error) = $upManager->putFile($token,$key,$filePath,null,$type,false);
            if($error){
                return redirect()->back()->withErrors(['error'=>'保存失败']);
            }else{
                $imgPath = env('QINIU_DOMAIN').'/'.$ret['key'];
            }
        }else{
                $imgPath = DB::table('videos')->where('id',$request->get('id'))->pluck('thumb');
                $imgPath = $imgPath[0];
        }
        if(!empty($request->file('local_video')))
        {
            //存储视频
            $filePath = $request->file('local_video');
            $type = $request->file('local_video')->getMimeType();
            $upManager = new UploadManager();
            $auth = new \Qiniu\Auth(env('QINIU_ACCESS_KEY'), env('QINIU_SECRET_KEY'));
            $token = $auth->uploadToken(env('QINIU_BUCKET'));
            $key = md5(time().rand(1,9999));
            list($ret,$error) = $upManager->putFile($token,$key,$filePath,null,$type,false);
            if($error){
                return redirect()->back()->withErrors(['error'=>'保存失败']);
            }else{
                $videoPath = env('QINIU_DOMAIN').'/'.$ret['key'];
            }
        }else{
                $videoPath = DB::table('videos')->where('id',$request->get('id'))->pluck('url');
                $videoPath = $videoPath[0];
        }

        $data = [
            'user_id'  => Auth::user()->id,
            'cate_id'  => $request->get('cid'),
            'title'    => trim($request->get('title')),
            'excerpt'  => $request->get('excerpt'),
            'thumb'  => $imgPath,
            'url'  =>  $videoPath,
            'status'   => $request->get('status'),
        ];

        $videoId = VideoModel::where('id',$request->get('id'))->update($data);

        //原有标签视频减一
        $orignTagIds = DB::table('other_tag')->where(['source_id'=>$request->get('id'),'source_type'=>'3'])->pluck('tag_id');
        if(!empty($orignTagIds))
        {
            DB::table('tags')
                ->whereIn('id', $orignTagIds)->decrement('videos',1);
        }
        //清除原有标签
        OtherTagModel::where(['source_id'=>$request->get('id'),'source_type'=>'3'])->delete();
        //tags不为空
        if(!empty($request->get('tags')))
        {
            //只取前5个标签存入
            $tmpArr = array_only($request->get('tags'),['0','1','2','3','4']);
            foreach($tmpArr as $tag)
            {
                //话题视频总数自增一
                DB::table("tags")->where('id',$tag)->increment("videos",1);
                OtherTagModel::updateOrCreate([
                    'source_id'=>$request->get('id'),
                    'tag_id'=>$tag,
                    'source_type'=>'3'
                ],[
                    'source_id'=>$request->get('id'),
                    'tag_id'=>$tag,
                    'source_type'=>'3'
                ]);
            }
        }
        //用户动态表
        if($request->get('status'))
        {
            DynamicModel::updateOrCreate([
                'uid'=>Auth::user()->id,
                'source_id'=>$videoId,
                'source_action'=>'3'
            ],[
                'uid'=>Auth::user()->id,
                'source_id'=>$videoId,
                'source_action'=>'3',
                'subject'=>trim($request->get('title'))
            ]);
        }else{
            DynamicModel::where([
                'uid'=>Auth::user()->id,
                'source_id'=>$videoId,
                'source_action'=>'3'
            ])->delete();
        }
        return redirect('/video');
    }


    //视频删除
    public function del(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:videos,id'
        ]);
        $result = DB::table('videos')->where([
            'id'=>$request->get('id'),
            'user_id'=>Auth::id()
        ])->delete();
        // 标签视频总数减一
        DB::table('tags')
            ->leftjoin('other_tag', 'other_tag.tag_id', '=', 'tags.id')
            ->where('other_tag.source_id','=',$request->get('id'))
            ->where('other_tag.source_type','=','3')
            ->where('tags.videos', '>', 0)
            ->decrement('videos',1);
        //清除该视频的标签
        OtherTagModel::where(['source_id'=>$request->get('id'),'source_type'=>'3'])->delete();
        if($result)
        {
            $data = [
                'code'=>'1',
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'code'=>'0',
                'msg'=>'删除失败'
            ];
        }
        return $data;
    }

    //视频收藏
    public function collect(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:videos,id'
        ]);
        //处理收藏
        if(empty(Auth::id()))
        {
            $data = [
                'code'=>'2',
                'msg'=>'收藏失败，请先登录'
            ];
            return $data;
        }
        if(!CollectionModel::where(['user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'2'])->exists())
        {
            CollectionModel::updateOrCreate(
                array('user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'3'),
                array('user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'3')
            );
            $data = [
                'code'=>'1',
                'msg'=>'收藏成功'
            ];
            return $data;
        }
        $data = [
            'code'=>'0',
            'msg'=>'已收藏过该文章'
        ];
        return $data;
    }

    //取消收藏
    public function collectCancel(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:videos,id'
        ]);
        CollectionModel::where(['user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'3'])->delete();
        $data = [
            'code'=>'1',
            'msg'=>'取消收藏'
        ];
        return $data;
    }

    //添加评论
    public function commentCreate(Request $request)
    {
        $this->validate($request, [
            'comment'=>'required|min:1',
            'video_id'=>'required|exists:videos,id',
            'to_user_id'=>'sometimes|exists:comments,user_id',
            'comment_id'=>'sometimes|exists:comments,id',
            'user_id'=>'required|exists:users,id'
        ],[
            'required'=>':attribute 不能为空'
        ],[
            'comment'=>'评论内容'
        ]);
        $result = CommentModel::create([
            'user_id'=>$request->get('user_id'),
            'source_id'=>$request->get('video_id'),
            'source_type'=>'3',     //3视频
            'content'=>$request->get('comment'),
            'to_user_id'=>$request->get('to_user_id')
        ]);
        //评论数加一
        VideoModel::where('id','=',$request->get('video_id'))->increment("comments");
        if($result)
        {
            return redirect()->action('Front\VideoController@detail',['id'=>$request->get('video_id')]);
        }else{
            return redirect()->back();
        }
    }
}
