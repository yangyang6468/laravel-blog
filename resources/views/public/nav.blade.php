<style>
    .layui-nav .layui-nav-item a {text-decoration: none}
    .layui-nav .layui-nav-item  {margin-right: 30px}
    .layui-nav * {  font-size: 16px;  }
    .layui-nav-child dd, dt {  line-height: 2.6;  }
    .nav-right{ float: right;margin-left: -40px}
</style>
<div id="app">
    <ul class="layui-nav" lay-filter="">
        <li class="layui-nav-item layui-this"><a href="{{ url('/') }}">BLOG</a></li>
        @if(count($nav) > 0)
            @foreach($nav as $k=>$v)
                @if(count($v->children) > 0)
                    <li class="layui-nav-item">
                        <a href="javascript:;">{{ $v->name }}</a>
                        <dl class="layui-nav-child"> <!-- 二级菜单 -->
                           @foreach($v->children as $key=>$value)
                            <dd><a href="">{{ $value->name }}</a></dd>
                            @endforeach
                        </dl>
                    </li>
                @else
                    <li class="layui-nav-item "><a href="">{{ $v->name }}</a></li>
                @endif
            @endforeach
        @endif

        @guest
            <li class="layui-nav-item nav-right"><a href="javascript:showLogin();">登录</a></li>
            <li class="layui-nav-item nav-right"><a href="javascript:showRegister();">注册</a></li>
        @else
            <li class="layui-nav-item nav-right">
                <a href="{{ url('user/index') }}">
                    <img width="40px" height="40px" class="img-circle" src="{{ setHeadimage(Auth::user()->headimage , Auth::user()->flag) }}">
                    {{ Auth::user()->nickname }}
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="{{ url('user/index') }}">个人中心</a></dd>
                    <dd><a href="javascript:logout();">退出</a></dd>
                </dl>
            </li>
        @endguest
    </ul>
</div>

<script>
    //注意：导航 依赖 element 模块，否则无法进行功能性操作
    layui.use('element', function(){
        var element = layui.element;


    });
</script>