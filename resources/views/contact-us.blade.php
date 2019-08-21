@extends('layouts.app')
@section('title','Contact Us')
<script src='https://www.google.com/recaptcha/api.js'></script>

@section('content')



<!-- main.css | /* Banner Section S */ -->





<!-- main.css | /* About TrippyWords Section S */ __ custom.js | /* Tab Content Section - About TrippyWords S */ -->

<section>

    <div class="section-gap-half-padding about_trippywords_section contact_page blockuser_page">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="about_trippywords">

                        <h2 class="title">Contact Us</h2>

                        

                        <form method="post" id="frmcontactus" action="{{ route('contactussend') }}">

                            @csrf

                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">



                                    <div class="form-group">



                                        <strong>Full Name:</strong>

                                        {!! Form::text('fullname', null, array('placeholder' => 'Fullname', 'class' => 'form-control')) !!}

                                        @if ($errors->has('fullname'))

                                            <div style="color: red; font-size: 15px;  margin-top: 10px">{{ $errors->first('fullname') }}</div>

                                        @endif

                                    </div>

                                    

                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">



                                    <div class="form-group">



                                        <strong>Email:</strong>

                                        {!! Form::email('email', null, array('placeholder' => 'Email Address','class' => 'form-control')) !!}

                                        @if ($errors->has('email'))

                                            <div style="color: red; font-size: 15px;  margin-top: 10px">{{ $errors->first('email') }}</div>

                                        @endif

                                    </div>

                                    

                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">



                                    <div class="form-group">



                                        <strong>Message:</strong>

                                        {!! Form::textarea('message', null, array('placeholder' => 'Message','class' => 'form-control','required'=>'required','rows'=>'3')) !!}

                                        @if ($errors->has('message'))

                                            <div style="color: red; font-size: 15px;  margin-top: 10px">{{ $errors->first('message') }}</div>

                                        @endif

                                    </div>



                                </div>

                                <!-- <div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="g-recaptcha" data-sitekey="6LfRlF0UAAAAAPOD40v5qivrG4NpOvEog6WTptl7"></div> 

                                     @if ($errors->has('g-recaptcha-response'))

                                            <div style="color: red; font-size: 15px;  margin-top: 10px">{{ $errors->first('g-recaptcha-response') }}</div>

                                     @endif

                                </div> -->

                                

                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <button class="btn btn-primary" id="btn_submit" type="submit" name="btnsubmit">Submit</button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="about_trippywords_image">

                        <img src="public/assets/image/about-img.png" alt="About TrippyWords">

                    </div>

                </div>

            </div>

        </div>

    </div>

    

</section>

 <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function(){

        

        $("#btn_submit").click(function(){

            

            $("#frmcontactus").validate({

                rules: {

                    fullname: {

                        required: true

                    },

                   email: {

                        required: true

                    },

                

                    message: {

                        required: true

                    }

                },

                messages: {

                   fullname: "Please enter name",

                    email: "Please enter email",

                    message: "Please  enter message ",

                },

            });

        });

    });

</script>



@endsection

