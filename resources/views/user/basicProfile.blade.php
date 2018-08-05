<link rel="stylesheet" type="text/css" href="{{ asset('plug/uploadify/uploadify.css') }}">
<style>
    .basic{
        margin:3% 10px;
        height: 90%;
        border: 1px dotted  #fff3cd ;
        background-color: #f1e9e9;
        line-height: 32px;
    }
    .basic p{
        width: 100%;
        margin:10px auto;
        line-height: 32px;
        font-size: 16px;
        color: #666;
        text-align: center;
        cursor: pointer;
    }
    .basic img{
        display: table-cell;
        margin-left: 36%;
        width:80px;
        height:80px;
        margin-top: 10px
    }
    .basic p span .fa{
        font-size:20px;
        margin-left:10px;
    }
    .basic p .gender .fa-mars{
        color: #00a0e9
    }
    .basic p .gender .fa-venus{
        color: deeppink;
    }
    .basic p .gender .fa-genderless{
        color: black;
    }
    .basic p span .fa-pencil-square-o{
        color: #00a0e9
    }

    .uploadify{display: inline-block!important;margin-left: 30%;margin-top: 10px}
</style>
{{--个人资料显示--}}
<div class="basic col-md-4">
    <img  src="{{ setHeadimage(Auth::user()->headimage , Auth::user()->flag) }}">
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
<div class="edit col-md-7" style="margin:3% 10px;">
    <form class="layui-form" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">昵称</label>
            <div class="layui-input-block">
                <input type="text" name="nickname " required  lay-verify="required" placeholder="请输入昵称" class="layui-input" value="{{ $user->nickname }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="line-height: 80px">图像</label>
            <div class="layui-input-block">
                <img src="{{ setHeadimage(Auth::user()->headimage , Auth::user()->flag) }}" width="80px" height="80px" style="margin-left: 35%">
                {{--<form>--}}
                    {{--<div id="queue"></div>--}}
                    {{--<input id="file_upload" name="file_upload" type="file" >--}}
                {{--</form>--}}

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
            <div class="layui-input-block">
                <select name="province" id="province" lay-filter="province">
                    <option value="">--请选择--</option>
                    <option value="0">未知</option>
                    @foreach($province as $v)
                        <option value="{{ $v->provinceid }}">{{ $v->province }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">市</label>
            <div class="layui-input-block">
                <select name="city" id="city">
                    <option value="">--请选择--</option>
                    <option value="0">未知</option>
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
                <input type="radio" name="sex" value="0" title="保密" checked>
                <input type="radio" name="sex" value="1" title="男">
                <input type="radio" name="sex" value="2" title="女" >
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">个性签名</label>
            <div class="layui-input-block">
                <textarea name="desc" placeholder="请输入个性签名" class="layui-textarea">{{ $user->signature }}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn">确定</button>
                <button type="reset" class="layui-btn layui-btn-primary">返回</button>
            </div>
        </div>
    </form>

    <script src="{{ asset('plug/uploadify/jquery.uploadify.min.js') }}" type="text/javascript"></script>

    {{--form表单--}}
    <script>
        layui.use(['form','laydate'], function(){
            var form = layui.form;
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#birthday', //指定元素
            });

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
        });
    </script>

    {{--uploadify控件--}}
    <script type="text/javascript">
        <?php $timestamp = time();?>

        var swfUrl = "{{ asset('plug/uploadify/uploadify.swf') }}";
        {{--$(function() {--}}
            {{--$('#file_upload').uploadify({--}}
                {{--'formData'     : {--}}
                    {{--'timestamp' : '<?php echo $timestamp;?>',--}}
                    {{--'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'--}}
                {{--},--}}
                {{--'swf'      : swfUrl,--}}
                {{--'uploader' : "{{ url("user/uploadify") }}",--}}
            {{--});--}}
        {{--});--}}
    </script>
</div>


