<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //关于首页
    public function about()
    {
        return view('ask.index.about');
    }

    //下载
    public function download()
    {
        return view('ask.download.index');
    }

    //文档
    public function docs()
    {
        return view('ask.docs.index');
    }
}
