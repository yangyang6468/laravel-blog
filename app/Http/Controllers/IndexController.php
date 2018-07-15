<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class IndexController extends BaseController
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Auth::user()->nickname);
        return view('index.index');
    }
}
