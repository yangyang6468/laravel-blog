<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class userinfo extends Model
{
    protected $table = 'cmf_userinfos';

    public function articles(){
        return $this->hasMany("App\model\article" , "userid");
    }
}
