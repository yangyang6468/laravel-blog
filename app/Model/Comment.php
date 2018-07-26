<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Comment extends Model
{
    protected $table = "cmf_comments";

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'delete_time';

    protected $dateFormat = 'U';
    public $timestamps = true;

    public function user(){
        return $this->belongsTo("App\model\Userinfo" , "user_id");
    }



    /**
     * 获取某篇文章下的评论/或子级评论
     * @author yy
     * @Date 2018/7/25
     * @param $articleid 文章id
     * @param $parentid 评论的父级id
     * @param int $limit 不为空则取对应条数
     * @param bool $isShowAll
     */
    public function getComments($articleid , $parentid , $limit=''){
        $where[] = ["article_id" , "=" , $articleid];
        $where[] = ["isdelete" , "=" , 0];
        $where[] = ["parent_id" , "=" , $parentid];

        if($limit){
            $relult = $this->where($where)->orderBy("id" ,"desc")->paginate($limit);
        }else{
            $relult = $this->where($where)->orderBy("id" ,"desc")->get();
        }

        foreach ($relult as $k=>$v){
            $user_id = Auth::user()->id;
            if(!$user_id){
                $v->islike = -1;
            }else{
                $islike = DB::table("cmf_user_like")->where(["user_id"=>$user_id , "comment_id"=>$v->id])->value('islike');
                $v->islike = $islike ? $islike : -1;
            }
        }

        return $relult;
    }



}
