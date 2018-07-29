<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class UserController extends BaseController
{
    //构造函数
    public function __construct()
    {
        return $this->middleware("user");
    }

    public function index(){
        return view('user/index');
    }

}
