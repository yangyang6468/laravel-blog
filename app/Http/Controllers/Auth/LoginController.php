<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Request;
use App\User;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        $request = Request::instance();
        if(strpos($request->input("email") , "@")){
            return "email";
        }else{
            return "nickname";
        }
    }

    /**
     * 重写登录方法
     * @author yy
     * @Date 2018/8/11
     * @param \Illuminate\Http\Request $request
     * @return int
     */
    public function login(\Illuminate\Http\Request $request){

        $this->validateLogin($request);
        if(strpos($request->input("email") , "@")){
            if(Auth::attempt(['email' => $request->input("email"), 'password' => $request->input("password")])){
               $user_id =  Auth::user()->id;
                $user = User::find($user_id);
                $user->lastlogindate = time();
                $user->ip = $request->ip();
                $user->save();

                return 1;
            }else{
                return -1;
            }
        }else{
            if(Auth::attempt(['nickname' => $request->input("nickname"), 'password' => $request->input("password")])){
                $user_id =  Auth::user()->id;
                $user = User::find($user_id);
                $user->lastlogindate = time();
                $user->ip = $request->ip();
                $user->save();

                return 1;
            }else{
                return -1;
            }
        }
    }


}
