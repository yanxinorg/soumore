<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\PostModel;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    //问答列表
    public function index()
    {
    	$questions = DB::table('questions')
    	->leftjoin('users', 'questions.user_id', '=', 'users.id')
    	->select('users.name as author','users.id as user_id', 'questions.id as question_id','questions.title as title','questions.created_at as created_at','questions.deleted_at as deleted_at')
    	->orderBy('questions.created_at','desc')
    	->paginate('15');
    	return view('admin.question.index',['questions'=>$questions]);
    }
    
    //删除问答
    public function delete(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:questions,id'
    	]);
        $result = DB::table('questions')->where('id','=',$request->get('id'))->delete();
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

}
