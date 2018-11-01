<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Common\CommonController;
use App\Models\Common\CategoryModel;
use App\Models\Common\UserModel;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //用户搜索
    public function userSearch(Request $request)
    {
        if($request->get('wd'))
        {
            if($request->get('wd') == '启用')
            {
                $datas = UserModel::where('status','1')->paginate('16');
            }elseif ($request->get('wd') == '禁用')
            {
                $datas = UserModel::where('status','0')->paginate('16');
            }else{
                $datas = UserModel::search($request->get('wd'))->paginate('16');
            }
            $roles = Role::all();
            return view('admin.user.index',['users'=>$datas,'roles'=>$roles,'wd'=>$request->get('wd')?$request->get('wd'):'']);
        }else{
            return redirect('/back/user/list');
        }

    }

    //分类搜索
    public function cateSearch(Request $request)
    {
        if($request->get('wd'))
        {
            $datas = DB::table('category') ->where('name', 'like','%'. $request->get('wd').'%') ->get();
            return view('admin.cate.result',['cates'=>$datas,'wd'=>$request->get('wd')?$request->get('wd'):'']);
        }else{
            return redirect('/back/cate/list');
        }
    }

    //文章搜索
    public function postTitleSearch(Request $request)
    {
        if($request->get('wd'))
        {
            $posts = DB::table('posts')
                ->leftjoin('users', 'posts.user_id', '=', 'users.id')
                ->leftjoin('category', 'posts.cate_id', '=', 'category.id')
                ->where('posts.title', 'like','%'. $request->get('wd').'%')
                ->select('users.id as user_id', 'category.name as cate_name','posts.id as post_id','posts.publish_time as publish_time','posts.title as title','posts.thumb as thumb','posts.author as author', 'posts.status as status','posts.created_at as created_at','posts.deleted_at as deleted_at')
                ->orderBy('posts.created_at','desc')
                ->paginate('15');
            return view('admin.post.index',['posts'=>$posts,'wd'=>$request->get('wd')?$request->get('wd'):'']);
        }else{
            return redirect('/back/post/list');
        }
    }

    //话题搜索
    public function topicTitleSearch(Request $request)
    {
        if($request->get('wd'))
        {
            $tags = DB::table('tags') ->where('name', 'like','%'. $request->get('wd').'%')->orderBy('created_at','desc')->paginate('15');
            return view('admin.topic.index',['tags'=>$tags,'wd'=>$request->get('wd')?$request->get('wd'):'']);
        }else{
            return redirect('/back/topic/list');
        }
    }


}
