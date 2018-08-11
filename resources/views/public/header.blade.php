<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- 字体图标 -->
    <link href="{{ asset('css/font/css/font-awesome.min.css') }}" rel="stylesheet">
    {{-- 登录样式--}}
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    {{--返回顶部样式--}}
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    {{-- jayui包 --}}
    <link href="{{ asset('plug/layui/css/layui.css') }}" rel="stylesheet">
    <script src="{{ asset('plug/layui/layui.js') }}"></script>
    {{--jquery包--}}
    <script src="{{ asset("js/jquery-1.7.2.min.js") }}"></script>


</head>

<body id="top">
<p id="back-to-top"><a href="#top" title="回到顶部"><i class="fa-5x fa fa-arrow-circle-up "></i></a></p>