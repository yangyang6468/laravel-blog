<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\model\Article;
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
        //查找轮播图
        $slide = DB::table("cmf_slide")->where(['isdelete'=>0])
                       ->orderBy("list_order","desc")->limit(3)
                        ->select('title','image','url')
                        ->get();

        //文章查找
        $articles = Article::where(["isdelete"=>0])
                            ->orderBy("id","desc")->paginate(10);
        foreach($articles as $k=>$v){
            $articles[$k]->name = $v->nickname->nickname;
            $articles[$k]->label = $v->category_id;
        }

        return view('index.index',compact('slide' , 'articles'));
    }
}
