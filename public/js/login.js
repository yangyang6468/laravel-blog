
//设置登录页面弹出效果
function showLogin(){
    refreshCaptcha("loginCaptcha")
    $('.login-form-mask').fadeIn(100);
    $('.login-form').slideDown(200);
    $('.register-form').hide();
}

function closeMask(){
    $('.login-form-mask').fadeOut(100);
    $('.login-form').slideUp(200);
    $('.register-form').slideUp(200);
}

function showRegister(){
    refreshCaptcha("registerCaptcha")
    $('.login-form-mask').fadeIn(100);
    $('.login-form').hide();
    $('.register-form').slideDown(200);
}

//提交注册信息
function  doRegister(){
    $.ajax({
        url : registerUrl,
        data : $("#registerForm").serialize(),
        type : "post",
        dataType : "json",
        success:function(redata){

        },
        error:function(msg){
            if(msg.status == 200){
                alertDialog("登陆成功");
                window.location.reload()
            }

            var json=JSON.parse(msg.responseText);
            json = json.errors;
            for ( var item in json) {
                for ( var i = 0; i < json[item].length; i++) {
                    alertDialog(json[item][i]);
                    refreshCaptcha("registerCaptcha")
                    return ; //遇到验证错误，就退出
                }
            }
        }
    })
}

function doLogin(){
    $("#nickname").val($("#email").val());
    $.ajax({
        url : loginUrl,
        data : $("#loginForm").serialize(),
        type : "post",
        dataType : "json",
        success:function(redata){

        },
        error:function(msg){
            if(msg.status == 200){
                alertDialog("登陆成功");
                window.location.reload()
            }
            var json=JSON.parse(msg.responseText);
            json = json.errors;
            for ( var item in json) {
                for ( var i = 0; i < json[item].length; i++) {
                    alertDialog(json[item][i]);
                    refreshCaptcha("loginCaptcha")
                    return ; //遇到验证错误，就退出
                }
            }
        }
    })
}

//退出
function logout(){
    $.post( logoutUrl , {"_token" : _token },function(){
        alertDialog("退出成功")
        window.location.reload()
    })
}


//提示弹出层
function alertDialog(msg) {
    //一般直接写在一个js文件中
    layui.use(['layer'], function () {
        var layer = layui.layer;
        layer.msg(msg,{time:3000,anim : 4});
    });
}

//验证码刷新 img标签的id
function refreshCaptcha(id){
    var src = $("#"+id).attr("src");
    $("#"+id).attr("src" , src + Math.random());
    $("#"+id).prev("input").val('');
}

