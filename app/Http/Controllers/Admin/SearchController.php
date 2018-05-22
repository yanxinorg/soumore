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

}
