<?php

namespace App\Http\Controllers\Front;

use App\Models\Common\VideoModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\PostModel;
use App\Models\Common\TagModel;
use App\Models\Common\QuestionModel;
use App\Models\Common\UserModel;

class SearchController extends Controller
{
    protected $wd;
    protected $postCount;
    protected $questionCount;
    protected $tagCount;
    protected $videoCount;
    protected $userCount;

    public function __construct(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'wd' =>'required|min:1|max:128',
        ]);
        if ($validator->fails())
        {
            return redirect()->back();
        }
        $this->wd = $request->get('wd');
        view()->composer('layouts/ask', function ($view) {
        	$view->with('wd',$this->wd);
        });
        //文章个数
        $this->postCount = count(PostModel::search($request->get('wd'))->get());
        //问答个数
        $this->questionCount = count(QuestionModel::search($request->get('wd'))->get());
        //话题个数
        $this->tagCount = count(TagModel::search($request->get('wd'))->get());
        //用户个数
        $this->userCount = count(UserModel::search($request->get('wd'))->get());
        //视频个数
        $this->videoCount = count(VideoModel::search($request->get('wd'))->get());
    }
    //默认是文章
    public function index(Request $request)
    {
        $datas = PostModel::search($request->get('wd'))->paginate(10);
    	return view('ask.search.post',['datas'=>$datas,'postCount'=>$this->postCount,'questionCount'=>$this->questionCount,'tagCount'=>$this->tagCount,'userCount'=>$this->userCount,'videoCount'=>$this->videoCount,'wd'=>$this->wd]);
    }
    
    //文章搜索
    public function post(Request $request)
    {
    	$datas = PostModel::search($request->get('wd'))->paginate(10);
        return view('ask.search.post',['datas'=>$datas,'postCount'=>$this->postCount,'questionCount'=>$this->questionCount,'tagCount'=>$this->tagCount,'userCount'=>$this->userCount,'videoCount'=>$this->videoCount,'wd'=>$this->wd]);
    }

    //视频搜索
    public function video(Request $request)
    {
        $datas = VideoModel::search($request->get('wd'))->paginate(10);
        return view('ask.search.video',['datas'=>$datas,'postCount'=>$this->postCount,'questionCount'=>$this->questionCount,'tagCount'=>$this->tagCount,'userCount'=>$this->userCount,'videoCount'=>$this->videoCount,'wd'=>$this->wd]);
    }


    //问答搜索
    public function wenda(Request $request)
    {
    	$datas = QuestionModel::search($request->get('wd'))->paginate(10);
        return view('ask.search.question',['datas'=>$datas,'postCount'=>$this->postCount,'questionCount'=>$this->questionCount,'tagCount'=>$this->tagCount,'userCount'=>$this->userCount,'videoCount'=>$this->videoCount,'wd'=>$this->wd]);
    }
    
    //话题搜索
    public function topic(Request $request)
    {
    	$datas = TagModel::search($request->get('wd'))->paginate(10);
        return view('ask.search.topic',['datas'=>$datas,'postCount'=>$this->postCount,'questionCount'=>$this->questionCount,'tagCount'=>$this->tagCount,'userCount'=>$this->userCount,'videoCount'=>$this->videoCount,'wd'=>$this->wd]);
    }
    
    //用户搜索
    public function user(Request $request)
    {
    	$datas = UserModel::search($request->get('wd'))->paginate(10);
        return view('ask.search.user',['datas'=>$datas,'postCount'=>$this->postCount,'questionCount'=>$this->questionCount,'tagCount'=>$this->tagCount,'userCount'=>$this->userCount,'videoCount'=>$this->videoCount,'wd'=>$this->wd]);
    }
}
