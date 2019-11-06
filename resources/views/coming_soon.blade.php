@extends('admin.layouts.app')
@section('content')
 <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<style>
            .html1, .body1 {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height1 {
                height: 100vh;
            }

            .flex-center1 {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content1 {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

       
            .m-b-md {
                margin-top: 30px;
            }
        </style>
 <div class="content1">
                <div class="title  html1">
                    Coming Soon
                   
                    </br></br>
                    <img class="img-thumbnail" height="500px" width="500px" src="{{ asset('/') }}public/admin-assets/img/coming_soon.jpeg">
                </div>
            </div>
                
            </div>

@endsection
@section('footer_script')