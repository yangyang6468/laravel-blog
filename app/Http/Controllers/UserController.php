<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Userinfo ;
use DB;
use Illuminate\Support\Facades\Request;

class UserController extends BaseController
{
    //构造函数
    public function __construct()
    {
        return $this->middleware("user");
    }

    public function index(){
        return view('user/index');
    }

    /**
     * 个人基本资料
     * @author yy
     * @Date 2018/8/5
     */
    public function basicProfile(){
        $userid = Auth::user()->id;
        //显示用户资料
        $user = Userinfo::find($userid);
        //编辑用户资料
        $editUser = DB::table("cmf_userinfos")->select("gender","city","province")->find($userid);
        //城市选择
        $city =  DB::table("cmf_city")->select("cityid","city")->where(["provinceid"=>$editUser->province])->get();
        //省份选择
        $province = DB::table("cmf_provinces")->select('provinceid','province')->get();

        return view("user/basicProfile"  , compact("user" , 'editUser' , 'province' , 'city'));
    }

    /**
     * 编辑资料
     * @author yy
     * @Date 2018/8/11
     */
    public function editFile(\App\Http\Requests\UserEdit $request){

        $data = $request->except(['file',"_token"]);

        $data["flag"] = 1;
        $data["updatetime"] = time();
        $data["birthday"] = strtotime($data["birthday"]);

        $res = DB::table('cmf_userinfos')->where(['id'=>$request->user()->id])->update($data);
        if($res){
            return ['code'=>1 , 'info'=>'修改成功'];
        }else{
            return ['code'=>-1 , 'info'=>'修改失败'];
        }

    }


    /**
     * 二级联动获取城市信息
     * @author yy
     * @Date 2018/8/5
     */
    public function city(){
        $requert = Request::instance();
        $province = $requert->input("province");
        $city = DB::table("cmf_city")->where(["provinceid"=>$province])->select('cityid', 'city')->get();
        $str='';
        foreach($city as $v){
            $str.="<option value='$v->cityid'>$v->city</option>";
        }
        echo $str;
    }


}
