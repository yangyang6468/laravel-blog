<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{

    /**
     * Notes: 微信登录
     * User: yy
     * Date: 2018/12/29 0029
     * Time: 10:38
     * @param Request $request
     */
    public function wxLogin(Request $request){
        $appid = "wx8b8a898f13a7440b";
        $redirect_uri = urlEncode('http://test.bangbangbang.wang/account/wxResult');
        return redirect("https://open.weixin.qq.com/connect/qrconnect?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect");
    }

    /**
     * Notes:微信登录回调(获取用户数据 通过code换取用户信息)
     * User: yy
     * Date: 2018/12/29 0029
     * Time: 11:43
     * @param Request $request
     */
    public function wxResult(Request $request){
        $code = $request->input('code');
        // 获取用户的access_token
        $result = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=$code&grant_type=authorization_code");

        // 通过access_token 获取用户的基本信息

    }


}

