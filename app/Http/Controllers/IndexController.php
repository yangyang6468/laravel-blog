<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\model\article;
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
                        ->get()->toArray();
        foreach($slide as $k=>$v){
            $slide[$k]->image = config('app.index'). $v->image;
        }

        //文章查找
        $articles = article::where(["isdelete"=>0])
                            ->orderBy("id" , "desc")->paginate(10);
        foreach($articles as $k=>$v){
            if($v->photo){
                $articles[$k]->photo = config('app.index'). $v->photo;
            }
            $articles[$k]->name = $v->nickname->nickname;
            $articles[$k]->label = $v->category_id;
        }

        return view('index.index',compact('slide' , 'articles'));
    }
}
