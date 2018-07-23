@extends('layouts.app')

@section("content")
    <style>
        .r_box li { background: rgba(236, 227, 227,0.8);margin :10px 20px; padding: 15px; overflow: hidden; color: #797b7c;height: 100%; margin-bottom: 20px }
        .r_box li h3 { font-size: 16px; line-height: 25px; text-shadow: #FFF 1px 1px 1px }
        .r_box li h3 a { color: #222 }
        .r_box li h3 a:hover { color: #7073f1!important; text-decoration: none }
        .r_box li img { float: right; clear: right; width: 100%;height: 180px; -webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all 0.5s;vertical-align: middle;display: inline-block;margin-top: 50px  }
        .r_box li i { width: 300px; display: block;  float: right; margin-left: 20px }
        .r_box li p { font-size:16px; margin: 20px 0 0 0; line-height: 32px; height: 200px;overflow: hidden; text-overflow: ellipsis; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2; }
        .r_box li:hover img { transform: scale(1.05) }
        .r_box li:hover h3 a { color: #19585d; }
    </style>
    {{--轮播图--}}
    @if(count($slide) > 0 )
        <div class="row">
            <div class="layui-carousel" id="test1">
                <div carousel-item>
                    @foreach($slide as $k=>$v)
                        <div><a href="{{ $v->url }}"> <img src="{{ $v->image }}"/></a></div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{--正文--}}
    <div class="row">
        @if(count($articles) > 0)
            <div class="col-md-8 r_box">
                @foreach($articles as $k=>$v)
                    <li>
                        @if($v->photo)
                        <i><a href="{{ url('detail' ,["id"=>$v->id]) }}"><img src="{{ $v->photo }}"></a></i>
                        @endif
                        <h3><a href="{{ url('detail' ,["id"=>$v->id]) }}">{{ $v->title }}</a></h3>
                        <p> {{ mb_substr(strip_tags(htmlspecialchars_decode($v->info)) , 0 , 300 ,"utf-8") }}</p>
                    </li>
                @endforeach
            </div>
        @endif
            <div class="col-md-4">

            </div>

    </div>

    <script>
        layui.use('carousel', function(){
            var carousel = layui.carousel;
            //建造实例
            carousel.render({
                elem: '#test1'
                ,width: '100%' //设置容器宽度
                ,arrow: 'always' //始终显示箭头
//                ,anim: 'fade' //切换动画方式
                ,height: '200px'
            });
        });
    </script>
@endsection

