@extends('layouts.app')

@section("content")
    <style>
        .layui-input-block{  margin-left: 0px;  }
    </style>
    <div class="row" style="margin: 20px;">
        {{-- 左边-菜单 --}}
        @include("public/userNav")


        {{-- 右边-主体 --}}
        <div class="col-md-8 right-tab" >
            <div class="editForm" style="margin: 10px ">
                <form class="layui-form" action="">
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <span id="photo" style="position: relative">
                                <img src="" style="width: 300px;height: 100px">
                               <span style="position: absolute;top:50%;left:50%"><i class="fa fa-plus"> 上传封面</i></span>
                            </span>

                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <script id="editor" type="text/plain" style=";height:300px;"></script>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-inline" style="width: 120px">
                            <select name="city" lay-verify="required">
                                <option value=""></option>
                                <option value="0">北京</option>
                                <option value="1">上海</option>
                                <option value="2">广州</option>
                                <option value="3">深圳</option>
                                <option value="4">杭州</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="formDemo">提交</button>
                            <a href="{{ url('articlelist') }}" class="layui-btn layui-btn-primary" style="text-decoration: none">返回</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

    {{--加载百度编辑器内容--}}
    <script type="text/javascript" charset="utf-8" src="{{ asset('plug/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ asset('plug/ueditor/ueditor.all.min.js') }}"></script>
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{ asset('plug/ueditor/lang/zh-cn/zh-cn.js') }}"></script>

    <script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');


    </script>

    <script>
        //Demo
        layui.use(['form' , 'upload'], function(){
            var form = layui.form;
            var upload = layui.upload;

            //上传
            var uploadInst = upload.render({
                elem: '#photo' //绑定元素
                ,url: '/upload/' //上传接口
                ,done: function(res){
                    //上传完毕回调
                }
                ,error: function(){
                    //请求异常回调
                }
            });
        });
    </script>

@endsection


