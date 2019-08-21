@extends('layouts.app')
@section('content')

<!-- main.css | /* Banner Section S */ -->


<!-- main.css | /* About TrippyWords Section S */ __ custom.js | /* Tab Content Section - About TrippyWords S */ -->
<section>
    <div class="section-gap-half-padding about_trippywords_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about_trippywords">
                        <h2 class="title">Account Activation</h2>
                        @if($status==1)
                        <h1 style="color:green">your account activated  <a href="{{ url('/') }}">click here to login</a></h1>
                        @else
                        <h1 style="color:red">your account not activated token expired</h1>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about_trippywords_image">
                        <img src="{{ asset('public/assets/image/about-img.png')}}" alt="About TrippyWords">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
