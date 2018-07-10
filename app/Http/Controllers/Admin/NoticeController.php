<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\NoticeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    //公告列表
    public function index()
    {
        $datas = NoticeModel::orderBy('created_at','desc')->paginate('10');
        return view('admin.notice.index',['datas'=>$datas]);
    }
    //新增公告
    public function add()
    {
        return view('admin.notice.add');
    }

    //保存公告
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'content'=>'required',
        ],[
            'required'=>':attribute为必填项',
        ],[
            'title'=>'公告名称',
            'content'=>'广告内容',
        ]);

        if(!$validator->fails())
        {
            //编辑更新保存
            if(!empty($request->get('id')))
            {
                //更新
                NoticeModel::where('id','=',$request->get('id'))->update([
                    'title'=>$request->get('title'),
                    'content'=>$request->get('content'),
                ]);
                return redirect('/back/notice/list');
            }else{
                //创建保存
                $notice = new NoticeModel();
                $notice->title = $request->get('title');
                $notice->content = $request->get('content');
                if($notice->save())
                {
                    return redirect('/back/notice/list');
                }
            }
        }
        return redirect()->back()->withErrors($validator)->withInput();
    }

    //编辑公告
    public function edit(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:notice,id'
        ]);
        $notice =  NoticeModel::where('id','=',$request->get('id'))->get();
        return view('admin.notice.edit',[
            'data'=>$notice[0]
        ]);
    }

    //删除公告
    public function delete(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:notice,id'
        ]);
        $result = NoticeModel::where('id','=',$request->get('id'))->delete();
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
