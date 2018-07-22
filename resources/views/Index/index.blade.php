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
                    <i><a href="/"><img src="{{ $v->photo }}"></a></i>
                    @endif
                    <h3><a href="/">{{ $v->title }}</a></h3>
                    <p> {{ mb_substr(strip_tags(htmlspecialchars_decode($v->info)) , 0 , 300 ,"utf-8") }}</p>
                </li>
            @endforeach

                <li><i><a href="/"><img src="images/2.jpg"></a></i>
                    <h3><a href="/">爱情没有永远，地老天荒也走不完</a></h3>
                    <p>也许，爱情没有永远，地老天荒也走不完，生命终结的末端，苦短情长。站在岁月的边端，那些美丽的定格，心伤的绝恋，都被四季的掩埋，一去不返。徒剩下这荒芜的花好月圆，一路相随，流离天涯背负了谁的思念？</p>
                </li>
                <li><i><a href="/"><img src="images/3.jpg"></a></i>
                    <h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
                    <p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
                </li>
                <li><i><a href="/"><img src="images/4.jpg"></a></i>
                    <h3><a href="/">擦肩而过</a></h3>
                    <p>《擦肩而过》文/清河鱼 编绘/天朝羽打开一扇窗，我不曾把你想得平常。看季节一一过往。你停留的那个地方，是否依然花儿开放？在夜里守靠着梦中的，想那仿佛前世铭刻进心肠的</p>
                </li>
                <li>
                    <h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
                    <p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
                </li>
                <li><i><a href="/"><img src="images/5.jpg"></a></i>
                    <h3><a href="/">擦肩而过</a></h3>
                    <p>《擦肩而过》文/清河鱼 编绘/天朝羽打开一扇窗，我不曾把你想得平常。看季节一一过往。你停留的那个地方，是否依然花儿开放？在夜里守靠着梦中的，想那仿佛前世铭刻进心肠的</p>
                </li>
                <li><i><a href="/"><img src="images/6.jpg"></a></i>
                    <h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
                    <p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
                </li>
                <li><i><a href="/"><img src="images/7.jpg"></a></i>
                    <h3><a href="/">你是什么人便会遇上什么人</a></h3>
                    <p>有时就为了一句狠话，像心头一口毒钉，永远麻痺着亲密感情交流。恶言，真要慎出，平日多誠心爱语，乃最简易之佈施。</p>
                </li>
                <li><i><a href="/"><img src="images/8.jpg"></a></i>
                    <h3><a href="/">爱情没有永远，地老天荒也走不完</a></h3>
                    <p>也许，爱情没有永远，地老天荒也走不完，生命终结的末端，苦短情长。站在岁月的边端，那些美丽的定格，心伤的绝恋，都被四季的掩埋，一去不返。徒剩下这荒芜的花好月圆，一路相随，流离天涯背负了谁的思念？</p>
                </li>
                <li><i><a href="/"><img src="images/9.jpg"></a></i>
                    <h3><a href="/">擦肩而过</a></h3>
                    <p>《擦肩而过》文/清河鱼 编绘/天朝羽打开一扇窗，我不曾把你想得平常。看季节一一过往。你停留的那个地方，是否依然花儿开放？在夜里守靠着梦中的，想那仿佛前世铭刻进心肠的</p>
                </li>
                <li><i><a href="/"><img src="images/1.jpg"></a></i>
                    <h3><a href="/">你是什么人便会遇上什么人</a></h3>
                    <p>有时就为了一句狠话，像心头一口毒钉，永远麻痺着亲密感情交流。恶言，真要慎出，平日多誠心爱语，乃最简易之佈施。</p>
                </li>
                <li><i><a href="/"><img src="images/2.jpg"></a></i>
                    <h3><a href="/">爱情没有永远，地老天荒也走不完</a></h3>
                    <p>也许，爱情没有永远，地老天荒也走不完，生命终结的末端，苦短情长。站在岁月的边端，那些美丽的定格，心伤的绝恋，都被四季的掩埋，一去不返。徒剩下这荒芜的花好月圆，一路相随，流离天涯背负了谁的思念？</p>
                </li>
                <li><i><a href="/"><img src="images/3.jpg"></a></i>
                    <h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
                    <p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
                </li>
                <li><i><a href="/"><img src="images/4.jpg"></a></i>
                    <h3><a href="/">擦肩而过</a></h3>
                    <p>《擦肩而过》文/清河鱼 编绘/天朝羽打开一扇窗，我不曾把你想得平常。看季节一一过往。你停留的那个地方，是否依然花儿开放？在夜里守靠着梦中的，想那仿佛前世铭刻进心肠的</p>
                </li>
                <li>
                    <h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
                    <p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
                </li>
                <li><i><a href="/"><img src="images/5.jpg"></a></i>
                    <h3><a href="/">擦肩而过</a></h3>
                    <p>《擦肩而过》文/清河鱼 编绘/天朝羽打开一扇窗，我不曾把你想得平常。看季节一一过往。你停留的那个地方，是否依然花儿开放？在夜里守靠着梦中的，想那仿佛前世铭刻进心肠的</p>
                </li>
                <li><i><a href="/"><img src="images/6.jpg"></a></i>
                    <h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
                    <p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
                </li>
                <li><i><a href="/"><img src="images/7.jpg"></a></i>
                    <h3><a href="/">你是什么人便会遇上什么人</a></h3>
                    <p>有时就为了一句狠话，像心头一口毒钉，永远麻痺着亲密感情交流。恶言，真要慎出，平日多誠心爱语，乃最简易之佈施。</p>
                </li>
                <li><i><a href="/"><img src="images/8.jpg"></a></i>
                    <h3><a href="/">爱情没有永远，地老天荒也走不完</a></h3>
                    <p>也许，爱情没有永远，地老天荒也走不完，生命终结的末端，苦短情长。站在岁月的边端，那些美丽的定格，心伤的绝恋，都被四季的掩埋，一去不返。徒剩下这荒芜的花好月圆，一路相随，流离天涯背负了谁的思念？</p>
                </li>
                <li><i><a href="/"><img src="images/9.jpg"></a></i>
                    <h3><a href="/">擦肩而过</a></h3>
                    <p>《擦肩而过》文/清河鱼 编绘/天朝羽打开一扇窗，我不曾把你想得平常。看季节一一过往。你停留的那个地方，是否依然花儿开放？在夜里守靠着梦中的，想那仿佛前世铭刻进心肠的</p>
                </li>

        </div>
        @endif


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
                ,height: '400px'
            });
        });
    </script>
@endsection

