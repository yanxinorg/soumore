<?php

namespace App\Http\Controllers\Sou;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	protected $s;
	public function __construct(Request $request)
	{
		$this->s = $request->get('s');
		view()->composer('layouts/sou', function ($view) {
			$view->with('s',$this->s);
		});
	}
	
    public function index()
    {
    	return view('sou.index');
    }
    
    public function result(Request $request)
    {
    	$this->validate($request, [
    		's'=>'required'
    	]);
    	return view('sou.result');
    }
}
