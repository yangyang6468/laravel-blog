@extends('layouts.app')

@section("content")
    <link rel="stylesheet" href="{{ asset('css/circle.css') }}">
    <style>
        .right-tab{border: 1px dashed #ccc;background-color: #fff ; border-radius: 5px}
    </style>
    <div class="row" style="margin: 20px;">
        @include("public/userNav")

        <div class="col-md-8 right-tab">

        </div>



    </div>

    <script>
        function checkTab(i){
            var url = '{{ url("user/basicProfile") }}';
            $.get(url , {} , function(redata){
                $(".right-tab").html(redata);
            })
        }

        checkTab(1);
    </script>

@endsection

