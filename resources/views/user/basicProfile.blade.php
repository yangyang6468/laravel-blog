<link href="{{ asset('css/editUser.css') }}?20180810" rel="stylesheet">

{{--个人资料显示--}}
<div class="basic col-md-4">
    <img class="img-circle"  src="{{ setHeadimage(Auth::user()->headimage , Auth::user()->flag) }}">
    <p title="昵称">
        <span class="nickname">{{ $user->nickname }}</span>
        <span class="gender"><i class="fa {{ $user->gender }}"></i></span>
        <span><i class="fa fa-pencil-square-o" ></i></span>
    </p>
    <p title="邮箱">{{ $user->email }}</p>
    <p title="电话号码">{{ $user->phone }}</p>
    <p title="生日">{{ $user->birthday }}</p>
    <p title="省份">{{ $user->province }} - {{ $user->city }}</p>
    <p title="个性签名">{{ $user->signature }}</p>
</div>
{{--编辑个人资料--}}
<div class="edit col-md-7" >
    <form class="layui-form" lay-filter="userForm">
        <div class="layui-form-item">
            <label class="layui-form-label">昵称</label>
            <div class="layui-input-block">
                <input type="text" name="nickname"  placeholder="请输入昵称" class="layui-input" value="{{ $user->nickname }}">
            </div>
        </div>
        <div class="layui-form-item headimage">
            <label class="layui-form-label">图像</label>
            <div class="layui-input-inline">
                <input type="hidden" name="headimage" id="headimage" value="{{ Auth::user()->headimage }}">
                <img title="点击修改图像" id="upload" src="{{ setHeadimage(Auth::user()->headimage , Auth::user()->flag) }}" >
                <span class="btn btn-success checkImgBtn" onclick="choseHeadImage()">选择图像</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">电话</label>
            <div class="layui-input-block">
                <input type="text" name="phone" required  lay-verify="required" placeholder="请输入电话号码" class="layui-input" value="{{ $user->phone }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">省</label>
            <div class="layui-input-inline" style="margin-left: 30px;width:120px">
                <select name="province" id="province" lay-filter="province">
                    <option value="">--请选择--</option>
                    <option value="0">未知</option>
                    @foreach($province as $v)
                        <option value="{{ $v->provinceid }}">{{ $v->province }}</option>
                    @endforeach
                </select>
            </div>
            <div class="layui-input-inline" style="width:120px">
                <select name="city" id="city">
                    <option value="">--请选择--</option>
                    <option value="0">未知</option>
                    @foreach($city as $k=>$v)
                        <option value="{{ $v->cityid }}">{{ $v->city }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">生日</label>
            <div class="layui-input-block">
                <input type="text" name="birthday" id="birthday" required  lay-verify="required"  class="layui-input" value="{{ $user->birthday }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">单选框</label>
            <div class="layui-input-block">
                <input type="radio" name="gender" value="0" title="保密" checked>
                <input type="radio" name="gender" value="1" title="男">
                <input type="radio" name="gender" value="2" title="女" >
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">个性签名</label>
            <div class="layui-input-block">
                <textarea name="signature" placeholder="请输入个性签名" class="layui-textarea signature">{{ $user->signature }}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="btn btn-primary" lay-submit="" lay-filter="go">确定</button>
                <button class="btn btn-danger">返回</button>
            </div>
        </div>
    </form>

    {{--form表单--}}
    <script>

        $(".basic").css("height" , $(".basic").parent().height());
        layui.use(['form','laydate','upload','layer'], function(){
            var form = layui.form;
            var laydate = layui.laydate;
            var upload = layui.upload;
            var laryer = layui.layer;

            //执行一个laydate实例 日期插件
            laydate.render({
                elem: '#birthday', //指定元素
            });

            //执行实例  上传插件
            var _token = '{{ csrf_token() }}';
            var uploadInst = upload.render({
                elem: '#upload' ,//绑定元素
                url: '{{ url('public/upload') }}', //上传接口
                data:{'_token' : _token},
                done: function(res){
                    //上传完毕回调
                    if(res.code == 1){
                        $("#upload").attr("src" , res.filename);
                        $("#headimage").val(res.file);
                    }else{
                        layer.msg(res.msg);
                    }
                },
                error: function(){
                    //请求异常回调
                    layer.msg("上传失败");
                }
            });


            //监控省的下拉列表
            form.on('select(province)', function(data){
                var province = data.value;
                var _token = '{{ csrf_token() }}';
                if(province > 0){
                    $.post("{{ url("user/city") }}" , {"province":province,"_token":_token},function(data){
                        $("#city").append(data);
                        form.render();
                    })
                }

            });


            //监听提交
            form.on('submit(go)', function(data){
                var postData = data.field;
                postData._token = "{{ csrf_token() }}";
                console.log(postData);
                $.ajax({
                    url : "{{ url('user/editFile') }}",
                    data : postData,
                    dataType : "json",
                    type : 'post',
                    success:function(res){
                        if(res.code == 1){

                        }
                        layer.msg(res.info, {time: 2000});
                    },
                    error:function(res){
                        var json=JSON.parse(res.responseText);
                        $.each(json.errors, function(idx, obj) {
                            layer.msg(obj[0] , {time:1000});
                            return false;
                        });
                    }
                })
                return false; //layui阻止表单提交
            });

            //设置默认值
            form.val("userForm", {
                "province": "{{ $editUser->province }}",
                "city" : '{{ $editUser->city }}',
                "gender": '{{ $editUser->gender }}',

            })
        });


        //选择图像
        function choseHeadImage(){
            layui.use(['layer'],function () {
                var layer = layui.layer;
                layer.open({
                    type:1,//类型
                    area:['720px'],//定义宽和高
                    title:'选择图像',//题目
                    shadeClose:false,//点击遮罩层关闭
                    content: $('#showImage'),//打开的内容
                    btn: ['确定', '取消'],
                });
            })
        }

    </script>

</div>

<style>
    #showImage{
        width: 720px;
        display: none
    }
    /*默认图片的div*/
    .defaultIcon {
        display: inline-block;
        width:120px;
        height: 120px;
        margin: 10px;
        line-height: 120px;
        text-align: center;
    }
    /*默认图片的样式*/
    .defaultIcon  img{
        width: 80px;
        height: 80px;
        border-radius: 50%;
        cursor: pointer;
    }
    .defaultIcon  img:hover{
        border: 2px solid #a94442;
        transition: border 0.8s;
    }
</style>
{{--选择默认图像模板start--}}
<div id="showImage" >
    @foreach($default_headiamge as $v)
        <div class="defaultIcon"  onclick="chooseIcon(this)">
            <input type="hidden" value="{{ $v }}" class="icon">
            <img src="{{ config('app.manager') }}{{$v}}" class="iconImg text-danger">
        </div>
    @endforeach
</div>
{{--选择默认图像end--}}

<script>
    {{--选择图像--}}
    function chooseIcon(obj){
        $(".iconImg").animate({width:'80px',height:'80px'})
        $(obj).children("img").animate({width:'120px',height:'120px'})
    }

</script>