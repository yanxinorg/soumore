<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DynamicController extends Controller
{

    //动态首页
    public function index(Request $request)
    {
        $datas = DB::table('attentions')
            ->leftjoin('users', 'attentions.source_id', '=', 'users.id')
            ->leftjoin('dynamic', 'attentions.source_id', '=', 'dynamic.uid')
            ->where('attentions.user_id','=',Auth::id())
            ->where('attentions.source_type','=','1')
            ->where('dynamic.uid','!=','')
            ->select(
                'users.id as user_id',
                'users.name as author',
                'users.avator as avator',
                'dynamic.source_id as source_id',
                'dynamic.source_action as source_action',
                'dynamic.subject as subject',
                'dynamic.created_at as created_at'
            )->orderBy('dynamic.created_at','desc')->paginate('15');
        return view('ask.dynamic.index',['datas'=>$datas]);
    }
}
