@extends('layouts.app')

@section("content")
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    {{--轮播图--}}
    @if(count($slide) > 0 )
        <div class="row">
            <div class="layui-carousel" id="test1">
                <div carousel-item>
                    @foreach($slide as $k=>$v)
                        <div><a href="{{ $v->url }}"> <img src="{{ config('app.manager') }}/{{ $v->image }}"/></a></div>
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
                        <i><a href="{{ url('detail' ,["id"=>$v->id]) }}"><img src="{{ setHeadimage($v->photo , $v->flag) }}"></a></i>
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

