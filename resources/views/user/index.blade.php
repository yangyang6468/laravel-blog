@extends('layouts.app')

@section("content")
    <style>
        .right-tab{border: 1px solid #ccc;background-color: #fff}
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

