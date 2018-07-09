<?php

namespace App\Http\Controllers\Front;

use App\Models\Common\TorrentModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TorrentController extends Controller
{
    //首页
    public function index()
    {
        $datas = TorrentModel::paginate('30');
        return view('ask.torrent.index',['datas'=>$datas]);
    }

    //详情页
    public function detail(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:torrent,id'
        ]);
        $datas = TorrentModel::where('id',$request->get('id'))->get();
        return view('ask.torrent.detail',['datas'=>$datas[0]]);
    }
}
