<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\TagModel;
use App\Models\Common\CategoryModel;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Support\Facades\Validator;
use Qiniu\Storage\UploadManager;

class TopicController extends Controller
{
    //话题列表
    public function index() 
    {
        $tags = TagModel::orderby('created_at','desc')->get();
        return view('admin.topic.index',['tags'=>$tags]);
    }
    
    //新增话题
    public function add(Request $request) 
    {
    	$cates = CategoryModel::all();
    	return view('admin.topic.add',['cates'=>$cates]);
    }
    
    //保存话题
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'cateid'=>'required|numeric',
            'name'=>'required',
            'status'=>'required|numeric|between:0,1',
            'thumb'=>$request->file('thumb')?'image|max:2048':''
        ],[
            'required'=>':attribute为必填项',
            'numeric'=>'数字',
            'unique'=>':attribute已存在',
            'image'=>'图片格式错误'
        ],[
            'cateid'=>'话题分类',
            'name'=>'话题名称',
            'thumb'=>'缩略图',
            'status'=>'话题状态',
        ]);
        
        if(!$validator->fails())
        {
            //编辑更新保存
            if(!empty($request->get('id')))
            {
                //图片不为空
                if($request->file('thumb'))
                {
                    $imgPath = CommonController::ImgStore($request->file('thumb'),'topic');
                    TagModel::where('id','=',$request->get('id'))->update([
                        'cate_id'=>$request->get('cateid'),
                        'name'=>$request->get('name'),
                        'status'=>$request->get('status'),
                        'desc'=>$request->get('desc'),
                        'thumb'=>$imgPath
                    ]);
                }else{
                    //无缩略图
                    TagModel::where('id','=',$request->get('id'))->update([
                        'cate_id'=>$request->get('cateid'),
                        'name'=>$request->get('name'),
                        'status'=>$request->get('status'),
                        'desc'=>$request->get('desc')
                    ]);
                }
                return redirect('/back/topic/list');
            }else{
                //创建保存
                $tag = new TagModel();
                $tag->cate_id = $request->get('cateid');
                $tag->name = $request->get('name');
                $tag->status = $request->get('status');
                $tag->desc = $request->get('desc');
                $imgPath = '';
                if($request->file('thumb'))
                {
                    $imgPath = CommonController::ImgStore($request->file('thumb'),'topic');
                }
                $tag->thumb = $imgPath;
                if($tag->save())
                {
                    return redirect('/back/topic/list');
                }
            }
        }
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    //编辑话题
    public function edit(Request $request) 
    {
        $this->validate($request, [
    			'id'=>'required|numeric|exists:tags,id'
    	]);
    	$cates = CategoryModel::all();
    	$topic = TagModel::where('id','=',$request->get('id'))->get();
    	return view('admin.topic.edit',[
    			'cates'=>$cates,
    	        'topic'=>$topic[0]
    	]);
    }
    
    //删除话题
    public function delete(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:tags,id'
        ]);
        $result = TagModel::where('id','=',$request->get('id'))->delete();
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
    
    //更改状态
    public function status(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:tags,id'
        ]);
        if(TagModel::where(['id'=>$request->get('id'),'status'=>'1'])->update(['status'=>'0']) || TagModel::where(['id'=>$request->get('id'),'status'=>'0'])->update(['status'=>'1']))
        {
            $data = [
                'code'=>'1',
                'msg'=>'更新成功!'
            ];
        }else{
            $data = [
                'code'=>'0',
                'msg'=>'更新失败!'
            ];
        }
        return $data;
    }

}
