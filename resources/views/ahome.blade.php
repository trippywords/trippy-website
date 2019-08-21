@extends('layouts.app')

@section('content')
<style>
    .error{            
            color: red;
    }
</style>
    
<!-- main.css | /* Banner Section S */ -->
    <section>
        <div class="banner_section">
            <div class="owl-carousel owl-theme">
                <div class="item banner_one">
                    <div class="container">
                        <div class="row custom-row">
                            <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 custom-col">
                                <div class="banner_content">
                                    <h1 class="banner_content_title wow fadeInUp">Modern & Creative Writers we have <span class="custom_color">something</span> for you.</h1>
                                    <div class="top-gap-half-padding"></div>
                                    <?php if(!Auth::user()): ?>
                                    @if (\Session::has('facebooksignupmsg'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! \Session::get('facebooksignupmsg') !!}</li>
                                        </ul>
                                    </div>
                                    @endif
                                    @if (\Session::has('facebooksigninerr'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{!! \Session::get('facebooksigninerr') !!}</li>
                                        </ul>
                                    </div>
                                    @endif
                                    
                                    <div class="banner_section_buttons">
                                        <a href="javascript:;" title="Login" class="btn btn-default" data-toggle="modal" data-target="#login_modal" style="cursor: pointer;">Login</a>
                                        <a href="javascript:;" title="Sign Up" class="btn btn-default signup" data-toggle="modal" data-target="#signup_modal" style="cursor: pointer;">Sign Up</a>
                                    </div>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                            <div class="col-xl-4 offset-xl-2 col-lg-5 col-md-4 col-sm-3 custom-padding">
                                <img src="public/assets/image/type-with-coffee.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login - Modal S -->
        <div class="login_signup_modal modal fade" id="login_modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form_modal">
                            <div class="row">
                                <div class="col-md-6 col-sm-5 form_details_grid">
                                    <div class="form_details">
                                        <h2 class="login_form_details_title">Login Form</h2>
                                        <ul>
                                            <li>
                                                Ut mattis mattis bibendum
                                            </li>
                                            <li>
                                                Nullam rutrum sagittis interdum
                                            </li>
                                            <li>
                                                Nam cursus eros sed elit
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-7 form_section_grid">
                                    <div class="form_section">
                                        <div class="form_breadcrumbs">
                                            <ul>
                                                <li class="font-secondary" style="cursor: pointer;">Login</li>
                                                <li>/</li>
                                                <li id="show_registration" style="cursor: pointer;">SignUp</li>
                                            </ul>
                                        </div>
                                        <form method="POST" id="loginForm" action="{{ URL('/login') }}">
                                            @csrf
                                            <span style="color:green;display: none;margin-top: 15px" id="success_message"><b>Please check your email</b></span>
                                            <span style="color:red;display: none;margin-top: 15px" id="error_message">Invalid Login Credentials</span>
                                            <span style="color:red;display: none;margin-top: 15px" id="error_message_verify">Please verify your Account is Disabled</span>
                                            <div class="login_signup_form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input id="email" type="email" class="form-control login_signup_input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-contact"></i>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                    <div id="error_signin_email"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">                                                        
                                                        <input id="password" type="password" class="form-control login_signup_input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-locked"></i>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                    <div id="error_signin_password"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="text-right">
                                                        Forget <a id="showforgetpass" title="Forget Password" style="color:#007bff;cursor: pointer;">
                                                            password?
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button_section">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="login_signup_button">
                                                            <button type="submit" id="btn_login" class="btn">
                                                                {{ __('Login') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="social_icon_section">
                                                            <div class="title">Or login with</div>
                                                            <a href="{{ route("fblogin") }}" title="Facebook" class="icon facebook_icon">
                                                                <i class="fa fa-facebook"></i>
                                                            </a>
<!--                                                            <a href="javascript:;" title="Twitter" class="icon twitter_icon">
                                                                <i class="fa fa-twitter"></i>
                                                            </a>
                                                            <a href="javascript:;" title="Google Plus" class="icon google_icon">
                                                                <i class="fa fa-google-plus"></i>
                                                            </a>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="login_signup_modal modal fade" id="signup_modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form_modal">
                            <div class="row">
                                <div class="col-md-6 col-sm-5 form_details_grid">
                                    <div class="form_details">
                                        <h2 class="login_form_details_title">Login Form</h2>
                                        <ul>
                                            <li>
                                                Ut mattis mattis bibendum
                                            </li>
                                            <li>
                                                Nullam rutrum sagittis interdum
                                            </li>
                                            <li>
                                                Nam cursus eros sed elit
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-7 form_section_grid">
                                    <div class="form_section">
                                        <div class="form_breadcrumbs">
                                            <ul>
                                                <li id="show_login" style="cursor: pointer;">Login</li>
                                                <li class="font-secondary">/</li>
                                                <li class="font-secondary" style="cursor: pointer;">SignUp</li>
                                            </ul>
                                        </div>
                                        <form id="frmsignup" method="post" action="{{ route('signup') }}">
                                            <span style="color:green;display: none;margin-top: 15px" id="signup_success_message"><b>Signup Successfully.Please check your email</b></span>
                                            <span style="color:red;display: none;margin-top: 15px" id="error_signup_message"><b>Invalid details Signup</b></span>
                                            <span style="color:red;display: none;margin-top: 15px" id="error_useremail_message"><b>User Email Already Registered</b></span>
                                            <div class="login_signup_form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control login_signup_input" id="first_name" name="first_name" placeholder="First Name" required="">
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="error_first_name"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control login_signup_input" id="last_name" name="last_name" placeholder="Last Name" required="">
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="error_last_name"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control login_signup_input" id="user_name" name="name" placeholder="User Name" required="">
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="error_user_name"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="email" class="form-control login_signup_input" id="signup_email" name="email" placeholder="Email" required="">
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-contact"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="error_signup_email"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control login_signup_input" id="signup_password" name="password" placeholder="Password" required="">
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-locked"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="error_signup_password"></div>
                                                </div>
                                            </div>
                                            <div class="button_section">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="login_signup_button">
                                                            <button class="btn" id="btnsignup" type="button">SIGNUP</button>                                                            
                                                        </div>                                                        
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="social_icon_section">
                                                            <div class="title">Or login with</div>
                                                            <a href="{{ route("fblogin") }}" title="Facebook" class="icon facebook_icon">
                                                                <i class="fa fa-facebook"></i>
                                                            </a>
<!--                                                            <a href="{{ route("twitterlogin") }}" title="Twitter" class="icon twitter_icon">
                                                                <i class="fa fa-twitter"></i>
                                                            </a>
                                                            <a href="javascript:;" title="Google Plus" class="icon google_icon">
                                                                <i class="fa fa-google-plus"></i>
                                                            </a>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login - Modal E -->
        
        <div class="login_signup_modal modal fade" id="forgetpass_modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form_modal">
                            <div class="row">
                                <div class="col-md-6 col-sm-5 form_details_grid">
                                    <div class="form_details">
                                        <h2 class="login_form_details_title">Forget Password</h2>
<!--                                        <ul>
                                            <li>
                                                Ut mattis mattis bibendum
                                            </li>
                                            <li>
                                                Nullam rutrum sagittis interdum
                                            </li>
                                            <li>
                                                Nam cursus eros sed elit
                                            </li>
                                        </ul>-->
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-7 form_section_grid">
                                    <div class="form_section">                                        
                                        <form method="POST" id="forgetpassForm" action="{{ URL('/forgetpass') }}">
                                            @csrf
                                            <span style="color:green;display: none;margin-top: 15px" id="fsuccess_message"><b>Please check your email</b></span>
                                            <span style="color:red;display: none;margin-top: 15px" id="ferror_message">User not exist</span>                                            
                                            <div class="login_signup_form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input id="forgetpassemail" type="email" class="form-control login_signup_input" name="forgetpassemail" value="" required autofocus placeholder="Email Address">
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-contact"></i>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </div>                                                                                              
                                            </div>
                                            <div class="button_section">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="login_signup_button">
                                                            <button type="submit" id="btn_forgetpass" class="btn">
                                                                {{ __(' Submit ') }}
                                                            </button>
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="login_signup_modal modal fade" id="resetpass_modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form_modal">
                            <div class="row">
                                <div class="col-md-6 col-sm-5 form_details_grid">
                                    <div class="form_details">
                                        <h2 class="login_form_details_title">Reset Password</h2>
<!--                                        <ul>
                                            <li>
                                                Ut mattis mattis bibendum
                                            </li>
                                            <li>
                                                Nullam rutrum sagittis interdum
                                            </li>
                                            <li>
                                                Nam cursus eros sed elit
                                            </li>
                                        </ul>-->
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-7 form_section_grid">
                                    <div class="form_section">                                        
                                        <form method="POST" id="resetpassForm" action="{{ URL('/updatepass') }}">
                                            @csrf
                                            <span style="color:green;display: none;margin-top: 15px" id="rsuccess_message"><b>Password changed successfully</b></span>
                                            <span style="color:red;display: none;margin-top: 15px" id="rerror_message">Verification code not match</span>                                            
                                            <span style="color:red;display: none;margin-top: 15px" id="rerror_message_passmatch">Password not match</span>
                                            <div class="login_signup_form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input id="resetpassemail" type="hidden" name="resetpassemail">
                                                        <input id="key_code" type="hidden" name="key_code">
                                                        <input id="newpassword" type="password" class="form-control login_signup_input" name="newpassword"  required autofocus placeholder="New Password">                                                        
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-locked"></i>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </div>    
                                                 <div class="form-group">
                                                    <div class="input-group">
                                                        <input id="confirmpassword" type="password" class="form-control login_signup_input" name="confirmpassword"  required autofocus placeholder="Confirm Password">
                                                        <div class="input-group-btn">
                                                            <div>
                                                                <i class="icon-locked"></i>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button_section">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="login_signup_button">
                                                            <button type="submit" id="btn_resetpass" class="btn">
                                                                {{ __(' Update ') }}
                                                            </button>
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- main.css | /* About TrippyWords Section S */ __ custom.js | /* Tab Content Section - About TrippyWords S */ -->
    <section>
        <div class="section-gap-half-padding about_trippywords_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about_trippywords">
                            <h2 class="title">About TrippyWords</h2>
                            <p class="details">
                                We strongly believe that '<span class="font-bold">Content is the King</span>'. We realised that there is a need for a <span class="font-bold">customised</span> and <span class="font-bold">structured</span> platform where people can <span class="font-bold">promote</span> their quality content.
                            </p>
                            <div class="about_trippywords_tab_section">
                                <div class="tab">
                                    <div class="tablinks active" onclick="openCity(event, 'what_we_do')" id="defaultOpen">What we do?</div>
                                    <div class="tablinks" onclick="openCity(event, 'how_its_works')">How Its Works?</div>
                                </div>
                                <div id="what_we_do" class="tabcontent">
                                    <p class="desc">
                                        We strongly believe in shared economy and are on the track of building potential business channel for quality content writers through our platform.We help the content writers in finding good opportunities. We also promote your work through different marketing channels and provide the required exposure to get new projects and develop business for you.
                                    </p>
                                </div>
                                <div id="how_its_works" class="tabcontent" style="display: none;">
                                    <p class="desc">
                                        @We strongly believe in shared economy and are on the track of building potential business channel for quality content writers through our platform.We help the content writers in finding good opportunities. We also promote your work through different marketing channels and provide the required exposure to get new projects and develop business for you.
                                    </p> 
                                </div>
                            </div>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });    
    $("document").ready(function(){        
    	$("#show_login").click(function(){
            $("#signup_modal").modal('hide');
            $("#login_modal").modal('show');
            $("#forgetpass_modal").modal('hide');
            $("#resetpass_modal").modal('hide');
        });
        $("#show_registration").click(function(){
            $("#signup_modal").modal('show');
            $("#login_modal").modal('hide');
            $("#forgetpass_modal").modal('hide');
            $("#resetpass_modal").modal('hide');
        });
        $("#showforgetpass").click(function(){
            $("#signup_modal").modal('hide');
            $("#login_modal").modal('hide');
            $("#forgetpass_modal").modal('show');
            $("#resetpass_modal").modal('hide');
        });
        $("#loginForm").validate({
    // Specify validation rules
    rules: {      
      
      email: {
        required: true,        
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {      
      email: "Please enter a valid email address",
      password: {
        required: "Please enter a password",
        minlength: "Your password must be at least 5 characters long"
      }
      
    },errorPlacement: function (error, element) {
            var id = $(element).attr("id");
            error.appendTo($("#error_signin_" + id));
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        
    }
   
  });  
  $("#loginForm").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#btn_login").click();
    }
});
        $("#btn_login").click(function(){
            if($("#loginForm").valid()){
            var loginForm = $("#loginForm");
            loginForm.submit(function(e){
                e.preventDefault();
                var formData = loginForm.serialize();
                $.post($("#loginForm").attr('action'),{email:$("#email").val(),'password' : $("#password").val()},function(response){
                    
                       if(response == 1){
                        window.location.href= url+"/dashboard";
                       }else if(response == 2 ){                           
                           $("#error_message_verify").css('display','block');
                           $("#error_message").css('display','none');
                           return false;
                       }else{                           
                        $("#error_message").css('display','block');
                        $("#error_message_verify").css('display','none');
                           return false;
                       }
                });
                
            });
        }

        });
        $("#fsuccess_message").css('display','none');
        $("#btn_forgetpass").click(function(){    
            var forgetpassForm= $("#forgetpassForm");
            forgetpassForm.submit(function(e){
                e.preventDefault();
                var formData = forgetpassForm.serialize();
                $.post($("#forgetpassForm").attr('action'),{email:$("#forgetpassemail").val()},function(response){
                    
                       if(response == 1){                        
                            $("#fsuccess_message").css('display','block');
                            $("#ferror_message").css('display','none');
                            $("#forgetpassemail").val("");
                            
                            return false;
                       }else{                           
                            $("#ferror_message").css('display','block');
                            $("#fsuccess_message").css('display','none');
                            return false;
                       }
                });
                
            });

        });
        
         $("#btn_resetpass").click(function(){    
            var resetpassForm= $("#resetpassForm");
            resetpassForm.submit(function(e){
                e.preventDefault();
                var formData = resetpassForm.serialize();
                $.post($("#resetpassForm").attr('action'),{email:$("#resetpassemail").val(),key_code:$("#key_code").val(),newpass:$("#newpassword").val(),confirm:$("#confirmpassword").val()},function(response){
                    
                       if(response == 1){                        
                            $("#rsuccess_message").css('display','block');
                            $("#rerror_message").css('display','none');
                            $("#rerror_message_passmatch").css('display','none');
                            //alert("1");                            
                            $("#newpassword").val('');
                            $("#confirmpassword").val('');
                            return false;
                       }else if(response == 2){
                            $("#rsuccess_message").css('display','none');
                            $("#rerror_message").css('display','none');
                            $("#rerror_message_passmatch").css('display','block');
                            //alert("2");
                            $("#newpassword").val('');
                            $("#confirmpassword").val('');
                            return false;
                       }else{                           
                            
                            $("#rsuccess_message").css('display','none');
                            $("#rerror_message").css('display','block');
                            $("#rerror_message_passmatch").css('display','none');                            
                            //alert("0");
                            $("#newpassword").val('');
                            $("#confirmpassword").val('');
                            return false;
                       }
                });
                
            });

        });
        
         $("#frmsignup").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      first_name: "required",
      last_name: "required",
      name: "required",
      email: {
        required: true,        
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      first_name: "Please enter your firstname",
      last_name: "Please enter your lastname",
      name: "Please enter your username",
      email: "Please enter a valid email address",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      }
      
    },errorPlacement: function (error, element) {
            var id = $(element).attr("id");
            error.appendTo($("#error_" + id));
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        
    }
   
  });   
  $("#frmsignup").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#btnsignup").click();
    }
});

         $("#btnsignup").click(function(){                
                    
  if($("#frmsignup").valid()){
  
  $.ajax({
    type:'POST',
    data:{name:$("#user_name").val(),
        first_name:$("#first_name").val(),
        last_name:$("#last_name").val(),
        email:$("#signup_email").val(),
        password:$("#signup_password").val()},
    url:'{{ route('signup')}}',
    success:function(response) {
                    if(response == 1){
                        $("#signup_success_message").css('display','block');
                        $("#error_signup_message").hide();
                        $("#error_useremail_message").hide();
                        document.getElementById("frmsignup").reset(); 
                        return false;
                       }else if(response==2){
                        $("#error_useremail_message").css('display','block');                           
                        $("#error_signup_message").hide();
                        $("#signup_success_message").hide(); 
                        
                       }else{
                        $("#signup_success_message").hide();   
                        $("#error_useremail_message").hide();
                        $("#error_signup_message").css('display','block');
                        return false;
                       }
    }
  });
  }
  
           

//                $.post($("#frmsignup").attr('action'),{
//                                                       name:$("#user_name").val(),     
//                                                       first_name:$("#first_name").val(),
//                                                       last_name:$("#last_name").val(),     
//                                                       email:$("#signup_email").val(),
//                                                       password:$("#signup_password").val()
//                
//                },function(response){
//                    
//                    
//                });
                
            

        });
        
        
        @if (\Session::has('forget_status')=='1' && \Session::get('key_code')!='') 
            
            $("#resetpassemail").val('<?php echo \Session::get('user_email')?>');
            
            $("#key_code").val('<?php echo \Session::get('key_code')?>');
            if($("#key_code").val()!='' && $("#resetpassemail").val()!='')
            {
                $("#resetpass_modal").modal('show');
            }
        @else
            $("#rsuccess_message").css('display','none');
            $("#rerror_message").css('display','block');
            $("#rerror_message_passmatch").css('display','none'); 
             if($("#key_code").val()!='' && $("#resetpassemail").val()!='')
            {
                $("#resetpass_modal").modal('show');
            }
        @endif
        
        
        $("#defaultOpen").click(function(){
            
        });
    });
        setTimeout(function() {
        $('.alert').fadeOut('fast');        
    }, 3000); // <-- time in milliseconds
       
        
        

        
</script>
@endsection
    