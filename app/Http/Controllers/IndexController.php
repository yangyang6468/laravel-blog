<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

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
