<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "cmf_comments";

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    public $timestamps = true;

    public function nickname(){
        return $this->belongsTo("App\model\Userinfo" , "user_id");
    }



}
