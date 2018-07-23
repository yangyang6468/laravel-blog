<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\model\article;

use Illuminate\Support\Facades\DB;
class DetailController extends BaseController
{
    public function index(Request $request , $id){
        //用户进入增加热度
        $article = article::find($id);
        
        return view('detail/index' , compact('article'));
    }
}
