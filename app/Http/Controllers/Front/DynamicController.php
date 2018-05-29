<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DynamicController extends Controller
{
    //动态首页
    public function index(Request $request)
    {
        return view('ask.dynamic.index');
    }
}
