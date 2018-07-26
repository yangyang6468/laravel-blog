@extends('layouts.app')

@section("content")
    <style>
        a{text-decoration: none!important;}
        a:hover{color: #00a0e9}
        .detail{  display: block;  margin: 20px;  }
        .article-img img{ width:100% ; height: 200px;margin-bottom: 20px}
        .headimage{ width: 50px;height: 50px ;margin:auto 20px}
        .author{ margin: 40px auto ; background-color: #eee}
        .time{ margin:auto 20px;display: inline-block}
        .icon{height: 54px;display: block}
        .icon div{display: inline-block;margin:auto 20px ;float: right}
        .icon div i{font-size: 20px;cursor: pointer}
        .icon div .num{line-height: 54px ;font-size: 16px}

        .layui-input{width:89%;display: inline-block;height: 40px}
        .comment{ margin-top: 20px }
         hr{ margin-bottom: 20px;border-top: 1px solid #eee;}
        .breadcrumb{ line-height: 16px;margin: 20px 20px}
        .breadcrumb span a{font-size: 16px;}

        /*评论*/
        .com{border: 1px solid #CCCCCC ; background-color: #f5f8fa; margin-bottom: 10px}
        .com:hover{box-shadow:2px 2px 10px #909090;transition: all 0.3s}
        .com p img{ width: 50px ; height: 50px ;margin: 10px 20px}
        .com p .name{ font-size: 16px;line-height: 50px;color: #0000F0}
        .com .content{ font-size: 16px ; line-height: 1.5em;width: 90%;margin:0px 10px 10px 10%;}

        .com .parent{position: relative}
        .com .children{position: relative}
        .com .parent .icon{position:absolute ; left: 90%;top:25px ;display: inline-block}
        .com .children .icon{position:absolute ; left: 40%;top:25px ;display: inline-block}
        .com .icon i{ font-size: 20px;cursor: pointer}


        .com .children{width: 89%;margin-left: 10% }
        .com .children .icon{margin-left: 50%;display: inline-block}
        .com hr{ margin-bottom: 0px}

        /*分页*/
        .page{text-align: center}
        .pageination{display: inline-block;}
        /*加载图标*/
        .loading{position:fixed; top:40% ; left:37%;font-size: 50px;display: none;}
        .img-circle:hover{transform:rotate(360deg);  transition:all 1s ; }
        .red { color: red}


    </style>

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
        {{--正文--}}
        <div class="col-md-7 col-sm-offset-1">
            <h2>{{ $article->title }}</h2>
            <p class="author">
                <a href="" ><img class="headimage img-circle" src="{{ setHeadimage($article->nickname->headimage) }}"></a>
                <span>作者:<a href="">{{ $article->nickname->nickname }}</a></span>
                <span class="time">时间:{{ date('Y-m-d H:i' , $article->nickname->createtime)  }}</span>
            </p>
            @if($article->photo)
                <p class="article-img">
                    <img src="{{ config('app.index').$article->photo }}">
                </p>
            @endif
            <p class="content">{!! htmlspecialchars_decode($article->info) !!}</p>
            <div class="icon">
                <div>
                    <i class="layui-icon @if($article->iscollect > 0) layui-icon-rate-solid @else layui-icon-rate @endif " onclick="collect('{{ $article->id }}'  ,this)"><span class="num">{{ $article->collect_count }}</span></i>
                </div>
                <div>
                    <i class="layui-icon layui-icon-fire" ><span class="num" >{{ $article->click_count }}</span></i>
                </div>
                <div>
                    <i class="layui-icon layui-icon-reply-fill" ><span class="num" id="comment">{{ $article->comment_count }}</span></i>
                </div>
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

    <i class="loading layui-icon layui-icon-loading  layui-anim-rotate layui-anim-loop"></i>
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
            $.ajax({
                url  : "{{ url('comment') }}",
                data : {'article_id':id , '_token':_token ,'content':content },
                type : "post",
                dataType : "html",
                success:function(redata) {
                    $("#add").html(redata).hide();
                    $("#add").fadeIn(3000);
                    $("#comment").text(comment++);
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




    </script>



@endsection

