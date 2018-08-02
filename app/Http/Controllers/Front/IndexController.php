<?php

namespace App\Http\Controllers\Front;

use App\Models\Common\NoticeModel;
use App\Models\Common\PostModel;
use App\Models\Common\TagModel;
use App\Models\Common\TorrentModel;
use App\Models\Common\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //关于首页
    public function index()
    {
        //推荐文章
        $recomPost =  DB::table('posts')
            ->leftjoin('users', 'posts.user_id', '=', 'users.id')
            ->leftjoin('category', 'posts.cate_id', '=', 'category.id')
            ->select(
                'users.name as author',
                'users.avator as avator',
                'users.id as user_id',
                'category.id as cate_id',
                'category.name as cate_name',
                'posts.id as post_id',
                'posts.title as title',
                'posts.excerpt as excerpt',
                'posts.content as content',
                'posts.thumb as thumb',
                'posts.created_at as created_at',
                'posts.comments as countcomment',
                'posts.hits as hits',
                'posts.supports as supports',
                'posts.status as status'
            )->where(['posts.status'=>'1'])->orderBy('posts.supports','desc')->limit('5')->get();
        //热门文章
        $hotPost = DB::table('posts')
            ->leftjoin('users', 'posts.user_id', '=', 'users.id')
            ->leftjoin('category', 'posts.cate_id', '=', 'category.id')
            ->select(
                'users.name as author',
                'users.avator as avator',
                'users.id as user_id',
                'category.id as cate_id',
                'category.name as cate_name',
                'posts.id as post_id',
                'posts.title as title',
                'posts.excerpt as excerpt',
                'posts.content as content',
                'posts.thumb as thumb',
                'posts.created_at as created_at',
                'posts.comments as countcomment',
                'posts.hits as hits',
                'posts.status as status'
            )->where(['posts.status'=>'1'])->orderBy('posts.hits','desc')->limit('5')->get();
        //最新问答
        $latestQuestions = DB::table('questions')
            ->leftjoin('users', 'users.id', '=', 'questions.user_id')
            ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
            ->select(
                'users.id as user_id',
                'users.avator as avator',
                'users.name as author',
                'category.id as cate_id',
                'category.name as cate_name',
                'questions.title as title',
                'questions.id as question_id',
                'questions.comments as comments',
                'questions.views as views',
                'questions.content as content',
                'questions.created_at as created_at'
            )->orderBy('questions.created_at','desc')
            ->limit('5')->get();
        //热门问答
        $hotQuestions = DB::table('questions')
            ->leftjoin('users', 'users.id', '=', 'questions.user_id')
            ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
            ->select(
                'users.id as user_id',
                'users.avator as avator',
                'users.name as author',
                'category.id as cate_id',
                'category.name as cate_name',
                'questions.title as title',
                'questions.id as question_id',
                'questions.comments as comments',
                'questions.views as views',
                'questions.content as content',
                'questions.created_at as created_at'
            )->orderBy('questions.likes','desc')
            ->limit('5')->get();
        //最新资源
        $btDatas = TorrentModel::orderBy('create_time','desc')->paginate('5');
        $hotDatas = TorrentModel::orderBy('requests','desc')->paginate('5');

        //热门话题
        $hotTags = TagModel::orderBy('watchs','desc')->limit('15')->get();
        //热门用户
        $hotUsers = UserModel::limit('15')->get();
        //公告
        $notice = NoticeModel::orderBy('created_at','desc')->limit("1")->get();
        return view('ask.index.index',[
            'recomPost'=>$recomPost,
            'hotPost'=>$hotPost,
            'latestQuestions'=>$latestQuestions,
            'hotQuestions'=>$hotQuestions,
            'btDatas'=>$btDatas,
            'hotDatas'=>$hotDatas,
            'notice'=>$notice[0],
            'hotTags'=>$hotTags,
            'hotUsers'=>$hotUsers
        ]);
    }


}
