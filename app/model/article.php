<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $table = 'cmf_articles';

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';
    public $timestamps = false;
    protected $dates = [
        'created_at',
    ];

    //模型关联
    public function nickname(){
        return $this->belongsTo("App\model\userinfo" , "userid");
    }

    //读取器
    public function getCategoryIdAttribute($value){
        return DB::table("cmf_category")->where(["id"=>$value])->value("name");
    }

}
