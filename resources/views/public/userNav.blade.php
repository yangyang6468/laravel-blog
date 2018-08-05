<div class="left col-md-4 " >

    <link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/circle.css') }}">

    <div class="holderCircle">

        <div class="dotCircle">
            @for($i=1 ; $i<=10 ; $i++)
                <span class="itemDot  itemDot{{ $i }}" data-tab="{{ $i }}">
                <span class="forActive">
                    <a href="javascript:checkTab('{{$i}}');">
                        @switch($i)
                            @case(1)
                                我的资料
                            @break
                            @case(2)
                                我的文章
                            @break
                            @case(3)
                                我的收藏
                            @break
                            @case(4)
                                我的关注
                            @break
                            @default
                                ...
                        @endswitch
                    </a>
                </span>
            </span>
            @endfor
        </div>
        <div class="contentCircle">
            <div class="CirItem CirItem1">
                个人中心
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-1.7.2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/circle.js') }}"></script>
