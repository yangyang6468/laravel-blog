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
        $user_id = Auth::user() ? Auth::user()->id : '';

        if(!$user_id){
            $article->iscollect = -1;
        }else{
            DB::enableQueryLog();
            $iscollect = DB::table("cmf_user_collect")
                            ->where(["article_id"=>$article->id , "user_id"=>$user_id])
                            ->value("iscollect");
            DB::getQueryLog();
            $article->iscollect = $iscollect ? $iscollect : -1;
        }
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
        $rules = ["content"=>"bail|required|min:5"];
        $messages = ["content.required"=>"评论内容不可以为空！","content.min"=>"评论内容不可以少于5个字！"];
        $this->validate($request , $rules , $messages);

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

    /**
     * 收藏
     * @author yy
     * @Date 2018/7/26
     * @return array json信息
     */
    public function collect(){
        $id = (request('id')); //文章id
        $userid = Auth::user()->id;
        if(!$userid){
            return ["code"=>-6 , "msg"=>"用户未登录"];
        }

        $collect = DB::table("cmf_user_collect")->where(["article_id"=>$id , "user_id"=>$userid])->select('id','iscollect')->first();

        DB::beginTransaction();
        if(isset($collect->iscollect) && $collect->iscollect > 0){
           $saveRes = DB::update("update cmf_user_collect set iscollect=-1 , update_time=".time()." where id=" . $collect->id );
           $article =Article::find($id);
           $setRes = $article->decrement("collect_count");

            if($saveRes && $setRes){
                DB::commit();
                return ["code"=> 2 , "msg" => '取关成功' ,'num' =>$article->collect_count];
            }else{
                DB::commit();
                return ["code"=> -2 , "msg" => '取关失败'];
            }

        }else{
            if(!isset($collect->iscollect)){
                $insertData["article_id"] = $id;
                $insertData["user_id"] = $userid;
                $insertData["create_time"] = time();
                $insertData["iscollect"] = 1;
                $saveRes = DB::table("cmf_user_collect")->insert($insertData);
            }elseif(isset($collect->iscollect) && $collect->iscollect < 0){
                $saveRes = DB::update("update cmf_user_collect set iscollect=1 , update_time=".time()." where id=" . $collect->id );
            }

            $article =Article::find($id);
            $setRes = $article->increment("collect_count");

            if($saveRes && $setRes){
                DB::commit();
                return ["code"=> 1 , "msg" => '关注成功' , 'num' =>$article->collect_count];
            }else{
                DB::commit();
                return ["code"=> -1 , "msg" => '关注失败'];
            }
        }


    }

    /**
     * 对文章评论进行点赞
     * @author yy
     * @Date 2018/7/26
     * @return array json信息
     */
    public function praise(){
        $id = (request('id')); //文章id
        $userid = Auth::user()->id;
        if(!$userid){
            return ["code"=>-6 , "msg"=>"用户未登录"];
        }

        $praise = DB::table("cmf_user_like")->where(["comment_id"=>$id , "user_id"=>$userid])->select('id','islike')->first();

        DB::beginTransaction();
        if(isset($praise->islike) && $praise->islike > 0){
            $saveRes = DB::update("update cmf_user_like set islike=-1 , update_time=".time()." where id=" . $praise->id );
            $comments =Comment::find($id);
            $setRes = $comments->decrement("like_count");

            if($saveRes && $setRes){
                DB::commit();
                return ["code"=> 2 , "msg" => '取点成功' ,'num' =>$comments->like_count];
            }else{
                DB::commit();
                return ["code"=> -2 , "msg" => '取点失败'];
            }

        }else{
            if(!isset($praise->islike)){
                $insertData["comment_id"] = $id;
                $insertData["user_id"] = $userid;
                $insertData["create_time"] = time();
                $insertData["islike"] = 1;
                $saveRes = DB::table("cmf_user_like")->insert($insertData);
            }elseif(isset($praise->islike) && $praise->islike < 0){
                $saveRes = DB::update("update cmf_user_like set islike=1 , update_time=".time()." where id=" . $praise->id );
            }

            $comment =Comment::find($id);
            $setRes = $comment->increment("like_count");

            if($saveRes && $setRes){
                DB::commit();
                return ["code"=> 1 , "msg" => '点赞成功' , 'num' =>$comment->like_count];
            }else{
                DB::commit();
                return ["code"=> -1 , "msg" => '点赞失败'];
            }
        }


    }

}
