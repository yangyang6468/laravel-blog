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

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <link href="{{ asset('plug/layui/css/layui.css') }}" rel="stylesheet">
    <script src="{{ asset('plug/layui/layui.js') }}"></script>
</head>

<body>
