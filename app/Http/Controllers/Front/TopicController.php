<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\TagModel;
use App\Models\Common\AttentionModel;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    //首页
    public function index(Request $request)
    {
    	$tags = TagModel::paginate('20');
    	return view('ask.topic.index',['tags'=>$tags]);
    }
    
    public function hot()
    {
    	$tags = TagModel::orderBy('watchs','desc')->paginate('20');
    	return view('wenda.topic.hot',['tags'=>$tags]);
    }
    
    //话题详情
    public function detail(Request $request) 
    {
        $this->validate($request, [
    			'id'=>'required|numeric|exists:tags,id'
    	]);
        $datas = TagModel::where('id',$request->get('id'))->get();
        //相关话题
        $attenCateId = TagModel::where('id',$request->get('id'))->pluck('cate_id');
        $relateAttens = TagModel::where('cate_id',$attenCateId)->get();
        //关注该话题的人
        $attenUser = DB::table('attentions')
    		->leftjoin('users', 'attentions.user_id', '=', 'users.id')
    		->where('attentions.source_id','=',$request->get('id'))
    		->where('attentions.source_type','=','3')
    		->select('users.id as user_id',
    				'users.name as name',
    		        'users.avator as thumb'
    		    )
    		->orderBy('users.created_at','asc')
    		->limit('15')->get()->toArray();
        //关注该话题的总人数
        $attenCount = DB::table('attentions')->where('source_type','3')->where('source_id',$request->get('id'))->count();
        return view('ask.topic.detail',['datas'=>$datas[0],'relateAttens'=>$relateAttens,'attenUsers'=>$attenUser,'attenCount'=>$attenCount]);
    }
}
