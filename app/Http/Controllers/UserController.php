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
        $user = Userinfo::find($userid);
        $province = DB::table("cmf_provinces")->select('provinceid','province')->get();
        return view("user/basicProfile"  , compact("user" , 'province'));
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

    /**
     * 图片上传
     * @author yy
     * @Date 2018/8/5
     */
    public function uploadify(){
        $requeest = Request::instance();
        dd($requeest->input());
    }

}
