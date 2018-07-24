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
        .icon div i{color:red; font-size: 20px;cursor: pointer}
        .icon div .num{line-height: 54px ;font-size: 16px}

        .layui-input{width:89%;display: inline-block;height: 40px}
        .comment{ margin-top: 20px }
         hr{ margin-bottom: 20px;border-top: 1px solid #eee;}
        .breadcrumb{ line-height: 16px;margin: 20px 20px}
        .breadcrumb span a{font-size: 16px;}

        /*评论*/
        .com{border: 1px solid #CCCCCC ; background-color: #f5f8fa; margin-bottom: 10px}
        .com:hover{box-shadow:2px 2px 10px #909090;transform: 0.3}
        .com p img{ width: 50px ; height: 50px ;margin: 10px 20px}
        .com p .name{ font-size: 16px;line-height: 50px}
        .com .content{ font-size: 16px ; line-height: 1.5em;width: 90%;margin:0px 10px 10px 10%;}
        .com .icon{position:absolute ; left: 90%;top:25px ;display: inline-block}
        .com .icon i{ font-size: 20px;cursor: pointer}

        .com .parent{position: relative}
        .com .children{width: 89%;margin-left: 10% }
        .com .children .icon{margin-left: 50%;display: inline-block}
        .com hr{ margin-bottom: 0px}
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
                    <i class="layui-icon layui-icon-rate" ></i>
                    <span class="num">{{ $article->collect_count }}</span>
                </div>
                <div>
                    <i class="layui-icon layui-icon-fire" ></i>
                    <span class="num">{{ $article->click_count }}</span>
                </div>
                <div>
                    <i class="layui-icon layui-icon-dialogue" ></i>
                    <span class="num">{{ $article->comment_count }}</span>
                </div>
            </div>


            <div>
                <h3 class="comment">评论</h3><hr>
                <form >
                    <div class="layui-form-item">
                        <input type="text" name="title"  placeholder="请输入评论" autocomplete="off" class="layui-input" >
                        <span class="layui-btn layui-btn-normal">评论</span>
                    </div>
                </form>

                {{--评论--}}
                @if(count($comments))
                    @foreach($comments as $k=>$vo)
                        <div class="com">

                            <div class="parent">
                                <p>
                                    <img src="http://www.think.cn/upload/admin/20180710/6192b606362f5d1f6ae6a026ec9ab42b.jpg" class="img-circle">
                                    <span class="name">@if($vo->nickname) {{ $vo->nickname->nickname }} @else 匿名@endif</span>
                                    <span class="time">1天前</span>
                            <span class="icon">
                                <i class="layui-icon-praise layui-icon"></i><span>(0)</span>
                            </span>
                                </p>
                                <p class="content">
                                    {{ $vo->content }}
                                </p>
                            </div>

                            {{--子评论--}}
                            @if($vo->children)
                            <hr>
                            <div class="children">
                                <p>
                                    <img src="http://www.think.cn/upload/admin/20180710/6192b606362f5d1f6ae6a026ec9ab42b.jpg" class="img-circle">
                                    <span class="name">nickname</span>
                                    <span class="time">1天前</span>
                            <span class="icon">
                                <i class="layui-icon-praise layui-icon"></i><span>(0)</span>
                            </span>
                                </p>
                                <p class="content">
                                    这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容
                                    这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容这是测是的内容
                                </p>
                            </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
@endsection

