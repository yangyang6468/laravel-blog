<style>
    .navbar{margin-bottom:0px}
</style>
<div id="app">
    <nav class="navbar navbar-primary navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header" style="margin:0 20px">
                <a class="navbar-brand" href="{{ url('/') }}">首页</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav " >
                    @foreach($nav as $key =>$value)
                        @if(count($value->children)>0)
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle"
                                    data-toggle="dropdown" role="button" target="_blank"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ $value->name }}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" >
                                    @foreach( $value->children as $k=>$v )
                                        <li><a href="{{ url('/category', ["id"=>$v->id]) }}">{{ $v->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="active">
                                <a href="{{ url('/category', ["id"=>$v->id]) }}" target="_blank">{{ $value->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <form class="navbar-form navbar-left" style="margin-left: 400px">
                    <div class="form-group">
                        <input type="text" class="search form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-primary ">搜索</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="javascript:showLogin()" >登录</a></li>
                        <li><a href="javascript:showRegister()">注册</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->nickname }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" style="text-align: center;width: 20px">
                                <li><a href="#">个人资料</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Another action</a></li>
                                <li class="divider"></li>
                                <li><a href='javascript:logout()'>退出</a></li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>

