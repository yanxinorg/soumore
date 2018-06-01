<?php

namespace App\Http\Controllers\Front;

use App\Models\Common\SupportModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    //文章点赞
    public function post(Request $request)
    {
        $this->validate($request, [
            'post_id'=>'required|numeric|exists:posts,id',
            'user_id'=>'required|numeric|exists:users,id'
        ]);
        if($request->get('user_id') != Auth::id())
        {
            return redirect()->back();
        }else{
            if(SupportModel::where(['user_id' =>$request->get('user_id'),'source_id'=>$request->get('post_id'),'source_type'=>'1','rating'=>'1'])->exists())
            {
                SupportModel::updateOrCreate([
                    'user_id'=>$request->get('user_id'),
                    'source_id'=>$request->get('post_id'),
                    'source_type'=>'1'
                ],[
                    'source_type'=>'1',
                    'rating'=>'0'
                ]);
            }else{
                SupportModel::updateOrCreate([
                    'user_id'=>$request->get('user_id'),
                    'source_id'=>$request->get('post_id'),
                    'source_type'=>'1'
                ],[
                    'source_type'=>'1',
                    'rating'=>'1'
                ]);
            }

            return redirect()->back();
        }
    }

    //问答点赞
    public function question(Request $request)
    {
        $this->validate($request, [
            'question_id'=>'required|numeric|exists:questions,id',
            'user_id'=>'required|numeric|exists:users,id'
        ]);
        if($request->get('user_id') != Auth::id())
        {
            return redirect()->back();
        }else{
            if(SupportModel::where(['user_id' =>$request->get('user_id'),'source_id'=>$request->get('question_id'),'source_type'=>'2','rating'=>'1'])->exists())
            {
                SupportModel::updateOrCreate([
                    'user_id'=>$request->get('user_id'),
                    'source_id'=>$request->get('question_id'),
                    'source_type'=>'2'
                ],[
                    'rating'=>'0'
                ]);
            }else{
                SupportModel::updateOrCreate([
                    'user_id'=>$request->get('user_id'),
                    'source_id'=>$request->get('question_id'),
                    'source_type'=>'2'
                ],[
                    'rating'=>'1'
                ]);
            }
            return redirect()->back();
        }
    }

    //视频点赞
    public function video(Request $request)
    {
        $this->validate($request, [
            'video_id'=>'required|numeric|exists:videos,id',
            'user_id'=>'required|numeric|exists:users,id'
        ]);
        if($request->get('user_id') != Auth::id())
        {
            return redirect()->back();
        }else{
            if(SupportModel::where(['user_id' =>$request->get('user_id'),'source_id'=>$request->get('video_id'),'source_type'=>'3','rating'=>'1'])->exists())
            {
                SupportModel::updateOrCreate([
                    'user_id'=>$request->get('user_id'),
                    'source_id'=>$request->get('video_id'),
                    'source_type'=>'3'
                ],[
                    'rating'=>'0'
                ]);
            }else{
                SupportModel::updateOrCreate([
                    'user_id'=>$request->get('user_id'),
                    'source_id'=>$request->get('video_id'),
                    'source_type'=>'3'
                ],[
                    'rating'=>'1'
                ]);
            }
            return redirect()->back();
        }
    }
}
