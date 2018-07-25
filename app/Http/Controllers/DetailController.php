<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\model\Article;
use App\model\Comment;
use Auth;
class DetailController extends BaseController
{
    /**
     * 文章详情页
     * @author yy
     * @Date 2018/7/25
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id){

        $article = Article::find($id);

        //用户进入增加热度
        $article->increment("click_count");

        $commentsObj = new Comment();
        $comments = $commentsObj->getComments($id , 0 , 5);
        foreach ($comments as $k=>$v){
            $v->children = $commentsObj->getComments($id , $v->id);
        }


        return view('detail/index' , compact('article' , 'comments'));
    }

    /**
     * 评论
     * @author yy
     * @Date 2018/7/25
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function comment(Request $request){
        $data = $request->input();
        //验证
        $this->validate($request ,
                        ["content"=>"bail|required|min:5"],
                        [   "content.required"=>"评论内容不可以为空！",
                            "content.min"=>"评论内容不可以少于5个字！",
                        ]
        );



        $commentsObj = new Comment();

        $commentsObj->user_id =  Auth::user() ? Auth::user()->id : 0 ;
        $commentsObj->article_id =  $data["article_id"] ;
        $commentsObj->content =  $data["content"] ;
        $commentsObj->parent_id =  isset($data["parent_id"]) && !empty($data["parent_id"]) ? $data["parent_id"] : 0 ;
        $commentsObj->status =  1 ;

        // 开启事务
        DB::beginTransaction();
        $res = $commentsObj->save();
        //评论成功 评论量+1
        $incNum = DB::table("cmf_articles")->where(["id"=>$data["article_id"]])->increment("comment_count");

        if($res && $incNum) {
            DB::commit();
        }else{
            DB::rollBack();
        }

        $comments = $commentsObj->getComments($data["article_id"] , 0 , 5);

        foreach ($comments as $k=>$v){
            $v->children = $commentsObj->getComments($data["article_id"] , $v->id);
        }

//        dd($comments->toArray());
        return view("detail/comment" , ["comments"=>$comments]);
    }

    /**
     * 分页
     * @author yy
     * @Date 2018/7/25
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page(Request $request){
        $page = $request->input("page" , 1);
        $id = $request->input("id");

        $commentsObj = new Comment();
        $comments = $commentsObj->getComments($id , 0 , 5);

        foreach ($comments as $k=>$v){
            $v->children = $commentsObj->getComments($id , $v->id);
        }

        return view("detail/comment" , ["comments"=>$comments]);
    }
}
