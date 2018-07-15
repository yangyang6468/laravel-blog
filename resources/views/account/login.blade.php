{{-- 遮罩层 --}}
<div class="login-form-mask"></div>

{{--登录弹层start--}}
<div class="login-form">
    <div class="login-header">
        <a href="javascript:closeMask()" title="关闭" class="login-close close">×</a>
        <h3 class="loginlabel">用户登录</h3>
    </div>
    <hr>
    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        <form class="form-horizontal">
            <div class="form-group has-feedback">
                <div class="username">
                    <span class="fa fa-user-circle-o fa-2x form-control-feedback"></span>
                    <input type="text" class="form-control" id="inputPassword" placeholder="电话号码|邮箱">
                </div>
            </div>
            <div class="form-group pwd-top has-feedback">
                <div class="password">
                    <span class="fa fa-unlock-alt fa-2x form-control-feedback"></span>
                    <input type="password" class="form-control" id="inputPassword" placeholder="密码">
                </div>
            </div>
            <div class="form-group  ">
                <input type="text" class="form-control" id="inputPassword" style="width: 200px;display: inline-block" placeholder="验证码">
                <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
            </div>
            <div class="form-group">
                <div class="checkbox  col-sm-4 col-md-4 col-lg-4">
                    <label><input type="checkbox"> 记住密码</label>
                </div>
                <label class=" col-md-4  control-label forget-pass"><a href="javascript:;">忘记密码</a></label>
                <label class=" col-md-4  control-label register"><a href="javascript:showRegister()">注册</a></label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-md btn-block">登    录</button>
            </div>
        </form>
        <hr>
        <div class="threeLogin"><span class="text-center">其他方式登录</span>
            <a class="nqq" href="javascript:;"></a>
            <a class="nwx" href="javascript:;"></a>
        </div>
    </div>
</div>
{{--登录弹层end--}}

{{--注册弹层start--}}
<div class="register-form">
    <div class="login-header">
        <a href="javascript:closeMask()" title="关闭" class="login-close close">×</a>
        <h3 class="loginlabel">注册</h3>
    </div>
    <hr>
    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        <form class="form-horizontal">
            <div class="form-group has-feedback">
                <div class="username">
                    <span class="fa fa-envelope-o fa-2x form-control-feedback"></span>
                    <input type="text" class="form-control" id="inputPassword" placeholder="邮箱">
                </div>
            </div>
            <div class="form-group pwd-top has-feedback">
                <div class="password">
                    <span class="fa fa-unlock-alt fa-2x form-control-feedback"></span>
                    <input type="password" class="form-control" id="inputPassword" placeholder="密码">
                </div>
            </div>
            <div class="form-group pwd-top has-feedback">
                <div class="password">
                    <span class="fa fa-unlock-alt fa-2x form-control-feedback"></span>
                    <input type="password" class="form-control" id="inputPassword" placeholder="确认密码">
                </div>
            </div>
            <div class="form-group  ">
                <input type="text" class="form-control" id="inputPassword" style="width: 200px;display: inline-block" placeholder="验证码">
                <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-md btn-block">立即注册</button>
            </div>
        </form>
        <hr>
        <h5 ><span>已有账号   </span><a href="javascript:showLogin()">立即登录>></a></h5>
    </div>
</div>
{{--注册弹层end--}}


<script>
    //设置登录页面弹出效果
    function showLogin(){
        $('.login-form-mask').fadeIn(100);
        $('.login-form').slideDown(200);
        $('.register-form').slideUp(100);
    }

    function closeMask(){
        $('.login-form-mask').fadeOut(100);
        $('.login-form').slideUp(200);
        $('.register-form').slideUp(200);
    }

    function showRegister(){
        $('.login-form-mask').fadeIn(100);
        $('.login-form').slideUp(100);
        $('.register-form').slideDown(200);
    }


</script>
