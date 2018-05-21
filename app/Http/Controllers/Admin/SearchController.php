<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\UserModel;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //用户搜索
    public function userSearch(Request $request)
    {
        $this->validate($request,[
            'roleid'=>empty($request->get('roleid'))?'numeric|min:-1':'',
            'statusid'=>empty($request->get('statusid'))?'numeric|min:-1"max:2':''
        ]);
        if($request->get('wd'))
        {
            $datas = UserModel::search($request->get('wd'))->paginate('16');
            $roles = Role::all();
            return view('admin.user.index',['users'=>$datas,'roles'=>$roles,'wd'=>$request->get('wd')?$request->get('wd'):'']);
        }else{
            return redirect('/back/user/list');
        }
    }
}
