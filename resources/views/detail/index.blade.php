@extends('layouts.app')

@section("content")
    <link href="{{ asset('css/article.css') }}" rel="stylesheet">

    <div class="row detail" >
        {{--面包屑--}}
        <div class="breadcrumb">
            <span class="layui-breadcrumb" lay-separator="/">
              <a href="{{ url('/') }}">首页</a>
              <a href="">国际新闻</a>
              <a href="">亚太地区</a>
              <a><cite>正文</cite></a>
            </span>
        </div>
        <hr style="margin-bottom: 20px ; margin-top: -10px">
        {{--正文--}}
        <div class="col-md-7 col-sm-offset-1">
            {{--标题--}}
            <h2>{{ $article->title }}</h2>

            {{--作者--}}
            <p class="author">
                <a href="" ><img class="headimage img-circle" src="{{ setHeadimage($article->nickname->headimage , $article->flag) }}"></a>
                <span>作者:<a href="">{{ $article->nickname->nickname }}</a></span>
                <span class="time">时间:{{ date('Y-m-d H:i' , $article->nickname->createtime)  }}</span>
            </p>
            @if($article->photo)
                <p class="article-img">
                    <img src="{{ config('app.index').$article->photo }}">
                </p>
            @endif

            {{--文章内容--}}
            <p class="content">{!! htmlspecialchars_decode($article->info) !!}</p>

            {{--小图标--}}
            <div class="icon">
                <div><i class="layui-icon @if($article->iscollect > 0) layui-icon-rate-solid @else layui-icon-rate @endif " onclick="collect('{{ $article->id }}'  ,this)" title="收藏"><span class="num">{{ $article->collect_count }}</span></i></div>
                <div><i class="layui-icon layui-icon-fire" title="热度"><span class="num" >{{ $article->click_count }}</span></i></div>
                <div><i class="layui-icon layui-icon-reply-fill" title="评论"><span class="num" id="comment">{{ $article->comment_count }}</span></i></div>
                <div><i class="layui-icon layui-icon-share share" title="分享"><span class="num" ></span></i></div>
            </div>

            {{--分享插件--}}
            <div class="bdsharebuttonbox ">
                <a class="bds_weixin" data-cmd="weixin" title="分享到微信" ></a>
                <a class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                <a class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                <a class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
            </div>

            <div>
                <h3 class="comment">评论</h3><hr>
                <form >
                    <div class="layui-form-item">
                        <input type="text" id="content"  placeholder="请输入评论" autocomplete="off" class="layui-input" >
                        <span class="layui-btn layui-btn-normal" onclick="comment()">评论</span>
                    </div>
                </form>


                <div class="allComments" id="add">
                    {{--评论--}}
                    @include("detail/comment")
                    {{--评论--}}
                </div>

            </div>

        </div>
    </div>

    {{--加载的图标--}}
    <i class="loading layui-icon layui-icon-loading  layui-anim-rotate layui-anim-loop"></i>

    {{--分享js--}}
    <script>
        window._bd_share_config={
            "common":{
                "bdSnsKey":{},
                "bdText":"{{ $article->title }}",
                "bdMini":"2",
                "bdMiniList":false,
                "bdPic":"","bdStyle":"1","bdSize":"32"
            },
            "share":{},
            "image":{
                "viewList":["weixin","qzone","tsina","sqq"],
                "viewText":"分享到：","viewSize":"16"
            },
            "selectShare":{
                "bdContainerClass":null,
                "bdSelectMiniList":["weixin","qzone","tsina","sqq"]
            }
        };
        with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
    </script>

    <script>
        //判断用户当前登录状态
        var user = 1;
        @guest user = 0; @endguest

        //评论
        function comment(){
            var id = '{{ request('id') }}';
            var _token = '{{ csrf_token() }}';
            var content = $("#content").val();

            var comment = parseInt($("#comment").text());
            comment++;
            $.ajax({
                url  : "{{ url('comment') }}",
                data : {'article_id':id , '_token':_token ,'content':content },
                type : "post",
                dataType : "html",
                success:function(redata) {
                    $("#add").html(redata).hide();
                    $("#add").fadeIn(3000);
                    $("#comment").text(comment);
                    $("#content").val('');
                    alertMsg('已评论成功！！！');
                },
                error:function(msg){
                    var json=JSON.parse(msg.responseText);
                    json = json.errors;
                    for ( var item in json) {
                        for ( var i = 0; i < json[item].length; i++) {
                            alertMsg(json[item][i])
                            return ; //遇到验证错误，就退出
                        }
                    }
                }
            })
        }

        //提示弹窗
        function alertMsg(msg){
            layui.use(["layer"] ,function(){
                var layer = layui.layer;
                layer.msg(msg);
            })
        }


        //分页
        function page(p){
            $(".loading").show();
            var id = '{{ request('id') }}';
            var _token = "{{ csrf_token() }}";
            $.get("{{url('comment/page')}}" , {'page':p , _token : _token , "id" :id } , function (redata){
                $(".loading").hide();
                $("#add").html(redata).hide().fadeIn(1000);
            })
        }

        //收藏
        function collect(id , obj){
            var _token = '{{ csrf_token() }}';
            if( user > 0 ){
                $.post("{{ url('collect') }}" ,{'id':id ,"_token":_token } ,function(redata){
                    if(redata.code == 1){
                        $(obj).removeClass("layui-icon-rate ");
                        $(obj).addClass("layui-icon-rate-solid");
                        $(obj).find('.num').text(redata.num);

                    }else if(redata.code == 2){
                        $(obj).addClass("layui-icon-rate ");
                        $(obj).removeClass("layui-icon-rate-solid");
                        $(obj).find('.num').text(redata.num);

                    }else if(redata.code == -6){
                        showLogin();
                    }
                    alertMsg(redata.msg);

                })
            }else{
                showLogin();
            }
        }

        //评论点赞
        function praise(id , obj){
            var _token = '{{ csrf_token() }}';
            if( user > 0 ){
                $.post("{{ url('praise') }}" ,{'id':id ,"_token":_token } ,function(redata){
                    if(redata.code == 1){
                        $(obj).addClass("red");
                        $(obj).next().text(redata.num);

                    }else if(redata.code == 2){
                        $(obj).removeClass("red");
                        $(obj).next().text(redata.num);

                    }else if(redata.code == -6){
                        showLogin();
                    }
                    alertMsg(redata.msg);

                })
            }else{
                showLogin();
            }
        }

        //显示分享的弹出层
        var isshow = 0 ;
        $(".share").on("click" ,function(){
            if(isshow==0){
                $(".bdsharebuttonbox").fadeIn(2000);
                isshow = 1;
                setTimeout(function(){
                    $(".bdsharebuttonbox").fadeOut(2000);
                    isshow = 0;
                } , 3000)
            }else{
                $(".bdsharebuttonbox").fadeOut(2000);
                isshow = 0;
            }

        })

        //显示子级评论框+子级评论
        function showComentDialog(parentid){
            layui.use(['layer'] , function(){
                var layer = layui.layer;
                layer.prompt({title: '回复', formType: 2}, function(content, index){
                    var id = '{{ request('id') }}';
                    var _token = '{{ csrf_token() }}';

                    var comment = parseInt($("#comment").text());
                    comment++;
                    $.ajax({
                        url  : "{{ url('comment') }}",
                        data : {'article_id':id , '_token':_token ,'content':content , "parent_id" :parentid },
                        type : "post",
                        dataType : "html",
                        success:function(redata) {
                            $("#add").html(redata).hide();
                            $("#add").fadeIn(3000);
                            $("#comment").text(comment);
                            $("#content").val('');
                            layer.close(index);
                            alertMsg('已评论成功！！！');
                        },
                        error:function(msg){
                            var json=JSON.parse(msg.responseText);
                            json = json.errors;
                            for ( var item in json) {
                                for ( var i = 0; i < json[item].length; i++) {
                                    alertMsg(json[item][i])
                                    return ; //遇到验证错误，就退出
                                }
                            }
                        }
                    })




                });
            })
        }

    </script>


@endsection

