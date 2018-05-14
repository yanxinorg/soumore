<?php

namespace App\Http\Controllers\Front;

use App\Models\Common\CategoryModel;
use App\Models\Common\OtherTagModel;
use App\Models\Common\TagModel;
use App\Models\Common\VideoModel;
use App\Models\Front\CollectionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        //今日话题
        $todayTag = TagModel::orderBy('created_at','desc')->limit(1)->get()->toArray();
        //话题分类
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        return view('ask.video.index',['videos'=>$videos,'todayTag'=>$todayTag[0],'cates'=>$cates,'cid'=>'']);
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
        //今日话题
        $todayTag = TagModel::orderBy('created_at','desc')->limit(1)->get()->toArray();
        return view('ask.video.index',['videos'=>$videos,'todayTag'=>$todayTag[0],'cates'=>$cates,'cid'=>$request->get('cid')]);
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
            'thumb.0'=>'required|image|max:2048',
            'excerpt'=>'required|min:10',
            'local_video'=>$request->file('local_video')?'required|mimetypes:video/avi,video/mpeg,video/quicktime,video/x-m4v':'',
            'third_video'=>$request->get('third_video') ?'required|url':'',
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
            'thumb.0'=>'头图',
            'excerpt'=>'简介',
            'local_video'=>'视频',
            'third_video'=>'地址',
            'status'=>'状态',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //存储视频头图
        $filePath = $request->file('thumb');
        $filePath = $filePath[0];
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
        //视频是否存在
        if(!empty($request->file('local_video')))
        {
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
            $videoPath = $request->get('third_video');
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
                    'videos_id'=>$videoId->id,
                    'tags_id'=>$tag
                ],[
                    'videos_id'=>$videoId->id,
                    'tags_id'=>$tag
                ]);
            }
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
            ->leftjoin('tags', 'other_tag.tags_id', '=', 'tags.id')
            ->where('other_tag.videos_id','=',$request->get('id'))
            ->select(
                'tags.name as name',
                'tags.id as id'
            )
            ->orderBy('tags.created_at','desc')
            ->paginate('5');
        //评论内容
        $comments = DB::table('comments')
            ->leftjoin('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.video_id','=',$request->get('id'))
            ->where('comments.status','=','1')
            ->select('comments.id as comment_id',
                'comments.user_id as user_id',
                'comments.video_id as video_id',
                'comments.excerpt as excerpt',
                'comments.to_user_id as to_user_id',
                'comments.created_at as created_at',
                'comments.status as status',
                'users.name as commentator',
                'users.avator as avator')
            ->orderBy('comments.created_at','asc')
            ->paginate('10');

        //是否收藏
        if(!empty(Auth::id()))
        {
            if(CollectionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'3'])->exists())
            {
                $isCollected = true;
            }else{
                $isCollected = false;
            }
        }else{
            $isCollected = false;
        }
        return view('ask.video.detail',['datas'=>$datas[0],'tagss'=>$tagss,'comments'=>$comments,'id'=>$request->get('id'),'isCollected'=>$isCollected]);
    }

}
