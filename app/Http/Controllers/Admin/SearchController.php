<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //用户搜索
    public function userSearch(Request $request)
    {
        if($request->get('wd'))
        {
            $datas = UserModel::search($request->get('wd'))->paginate('16');
            return view('admin.user.index',['users'=>$datas,'wd'=>$request->get('wd')?$request->get('wd'):'']);
        }else{
            return redirect('/back/user/list');
        }
    }
}
