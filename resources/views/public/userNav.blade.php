<link rel="stylesheet" href="{{ asset('css/circle.css') }}?2018">
<div class="left col-md-4 " style="margin-top: 10%" >
    <div class="holderCircle">

        <div class="dotCircle">
            @for($i=1 ; $i<=10 ; $i++)
                <span class="itemDot  itemDot{{ $i }}" data-tab="{{ $i }}" >
                    <span class="forActive">
                            @switch($i)
                        @case(1)
                        <a href="{{ url("user/index") }}">我的资料</a>
                        @break
                        @case(2)
                        <a href="{{ url('articlelist') }}">我的文章</a>
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
                    </span>
                </span>
            @endfor
        </div>
        <div class="contentCircle">
            <div class="CirItem CirItem1">
                @if($navType == 1)
                    我的资料
                @elseif($navType == 2)
                    我的文章
                @else
                    我的资料
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/circle.js') }}?20180812"></script>
<script>
    var i = '{{ $navType }}';
    $(".itemDot").removeClass('active');
    $(".itemDot"+i).addClass('active');


</script>