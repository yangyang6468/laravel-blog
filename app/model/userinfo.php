<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Userinfo extends Model
{
    protected $table = 'cmf_userinfos';

    public function articles(){
        return $this->hasMany("App\model\article" , "userid");
    }

    //设置生日
    public function getBirthdayAttribute($value){
        return date("Y-m-d" , $value);
    }

    //设置省份
    public function getProvinceAttribute($value){
        $province = DB::table("cmf_provinces")->where(["provinceid"=>$value])->value('province');
        return $province ? $province : "未知";
    }

    public function getCityAttribute($value){
        $city = DB::table("cmf_city")->where(["cityid"=>$value])->value('city');
        return $city ? $city : "未知";
    }

    public function getSignatureAttribute($value){
       return $value ? $value : "你在说什么，我听不见。。。";
    }

    public function getGenderAttribute($value){
        $data = ['fa-genderless' , 'fa-mars' , 'fa-venus'];
        return $data[$value];
    }

}
