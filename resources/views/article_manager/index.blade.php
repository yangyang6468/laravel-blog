@extends('layouts.app')

@section("content")
    <style>
        /*文章列表div*/
        .articlelist .one{
            height: 50px;
            line-height: 50px;
            border-bottom: 1px solid #b3aaaa;
            margin-bottom: 10px;
        }
        /*文章列表公用样式*/
        .articlelist .one span{
            display: inline-block;
        }
        /*文章列表标题*/
        .articlelist .one .title{
            width: 38%;
            font-size:18px;
            font-family: Georgia, "宋体";
        }
        /*文章时间*/
        .articlelist .one .time,.label{
            margin-left: 10px;
            font-size: 18px;
        }

        .articlelist .one .count,.action{
            display: inline-block;
            margin-left: 10px;
        }

        /*统计数量样式*/
        .articlelist .one .count .fa{
            width: 60px;
            margin-left: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        /*删除+编辑图标样式*/
        .articlelist .one .action .fa{
            margin-left: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        /*暂无数据样式*/
        .nodata{
            height: 500px;
            line-height: 500px;
            text-align: center;
        }
        /*添加数据按钮*/
        .add {
            background-color: #d1d1d1;
            height: 50px;
            line-height: 50px;
            margin: 5px 0;
            opacity: .6
        }

        .add button{
            margin:10px 0 10px 90%
        }

    </style>
    <div class="row" style="margin: 20px;">
        {{-- 左边-菜单 --}}
        @include("public/userNav")

        {{-- 右边-主体 --}}

        <div class="col-md-8 right-tab">

            <div class="add" style="">
                <a href="{{ url('articleShow') }}" ><button class="btn btn-success" ><i class="fa fa-plus" >添加</i></button></a>
            </div>
            @if(count($articleList) > 0)
                <div class="articlelist" >

                    <a href="javascript:;">
                        <div class="one" >
                            <span class="title">这是标题这是标题这是标题这是标题</span>
                            <span class="time">2018-10-10 10:10</span>
                            <span class="btn-sm btn-primary label" >php</span>
                            <div class="count">
                                <i class="fa fa-eye click_count" title="阅读量">10</i>
                                <i class="fa fa-star-o collect_count" title="收藏量">10</i>
                                <i class="fa fa-comment-o comment_count" title="评论量">10</i>
                            </div>
                            <div class="action">
                                <i class="fa fa-trash-o delete" title="删除" style="color: red;"></i>
                                <i class="fa fa-edit" title="编辑" style="color: red;margin-left: 5px"></i>
                            </div>

                        </div>
                    </a>

                </div>
            @else
                <div class="nodata"><span >暂无数据</span></div>
            @endif
        </div>
    </div>

@endsection