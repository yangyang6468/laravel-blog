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

    /**
     * 个人中心首页
     * @author yy
     * @Date 2018/8/12
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        //默认展示我的资料数据
        $userid = Auth::user()->id;
        //显示用户资料
        $user = Userinfo::find($userid);
        //编辑用户资料
        $editUser = DB::table("cmf_userinfos")->select("gender","city","province")->find($userid);
        //城市选择
        $city =  DB::table("cmf_city")->select("cityid","city")->where(["provinceid"=>$editUser->province])->get();
        //省份选择
        $province = DB::table("cmf_provinces")->select('provinceid','province')->get();
        //默认图像选择
        $default_headiamge = DB::table("cmf_icon")->where(['status'=>1,'type'=>1])->pluck("icon");
        //设置导航类型
        $navType = 1;
        return view('user/index' , compact("user" , 'editUser' , 'province' , 'city' , 'default_headiamge' , 'navType'));
    }

    /**
     * 编辑资料
     * @author yy
     * @Date 2018/8/11
     */
    public function editFile(\App\Http\Requests\UserEdit $request){

        $data = $request->except(['file',"_token"]);

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
