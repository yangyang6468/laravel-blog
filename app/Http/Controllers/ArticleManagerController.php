<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Article;


class ArticleManagerController extends BaseController
{

    function __construct(){
        $this->middleware('user');
    }

    /**
     * 我的文章列表
     * @author yy
     * @Date 2018/8/12
     */
    public function index(Request $request){
        $user_id = $request->user()->id;

        $articleList = Article::where(["userid"=>$user_id])->paginate(10);
        //设置导航类型
        $navType = 2;
        return view("article_manager/index" , compact("articleList" , 'navType'));
    }


    /**
     * 添加/编辑文章
     * @author yy
     * @Date 2018/8/12
     */
    public function add($id=0){
        //设置导航类型
        $navType = 2;

        return view('article_manager/add' , compact('navType'));
    }

}
