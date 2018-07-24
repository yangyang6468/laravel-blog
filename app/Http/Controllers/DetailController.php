<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\model\Article;
use App\model\Comment;

class DetailController extends BaseController
{
    public function index(Request $request , $id){

        $article = Article::find($id);

        //用户进入增加热度
        $article->increment("click_count");

        $where[] = ["article_id" , "=" ,$id];
        $where[] = ["parentid" , "=" , 0];
        $comments = Comment::where(["article_id"=>$id , "parent_id"=>0])
                        ->orderBy('id' , 'desc')
                        ->limit(5)
                        ->get();
        return view('detail/index' , compact('article' , 'comments'));
    }
}
