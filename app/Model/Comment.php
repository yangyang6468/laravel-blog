<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

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
            return $this->where($where)->orderBy("id" ,"desc")->paginate($limit);
        }else{
            return $this->where($where)->orderBy("id" ,"desc")->get();
        }

    }



}
