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

        .layui-input{width:85%;display: inline-block;height: 40px}
        .comment{ margin-top: 20px }
        hr{ margin-bottom: 20px;border-top: 1px solid #eee;}
    </style>

    <div class="row detail" >
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
                    <i class="layui-icon layui-icon-praise" ></i>
                    <span class="num">{{ $article->collect_count }}</span>
                </div>
            </div>

            <h3 class="comment">评论</h3><hr>
            <form >
                <div class="layui-form-item">
                    <input type="text" name="title"  placeholder="请输入评论" autocomplete="off" class="layui-input" >
                    <span class="layui-btn layui-btn-normal">评论</span>
                </div>
            </form>
        </div>
    </div>
@endsection

