{{--评论--}}
@if(count($comments))
    @foreach($comments as $k=>$vo)
        <div class="com">

            <div class="parent">
                <p>
                    <img src="http://www.think.cn/upload/admin/20180710/6192b606362f5d1f6ae6a026ec9ab42b.jpg" class="img-circle">
                    <span class="name">@if($vo->user) {{ $vo->user->nickname }} @else 匿名@endif</span>
                    <span class="time">{{ tranTime($vo->create_time) }}</span>
                            <span class="icon">
                                <i class="layui-icon-praise layui-icon @if($vo->islike>0) red @endif" onclick="praise('{{$vo->id}}',this)"></i>(<span class="num">{{ $vo->like_count }}</span>)
                            </span>
                </p>
                <p class="content">
                    {{ $vo->content }}
                </p>
            </div>

            {{--子评论--}}
            @if($vo->children)
                @foreach($vo->children as $key =>$value)
                    <hr>
                    <div class="children">
                        <p>
                            <img src="http://www.think.cn/upload/admin/20180710/6192b606362f5d1f6ae6a026ec9ab42b.jpg" class="img-circle">
                            <span class="name">@if($value->user) {{ $value->user->nickname }} @else 匿名@endif</span>
                            <span class="time">{{ tranTime($value->create_time) }}</span>
                            <span class="icon">
                                 <i class="layui-icon-praise layui-icon @if($value->islike>0) red @endif" onclick="praise('{{$value->id}}',this)"></i>(<span class="num">{{ $value->like_count }}</span>)
                             </span>
                        </p>
                        <p class="content">{{ $value->content }}</p>

                    </div>
                @endforeach
            @endif
        </div>

    @endforeach
    <div class="page">{{ $comments->links('page/page') }}</div>
@endif

{{--评论--}}