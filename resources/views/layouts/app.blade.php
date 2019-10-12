<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> 
            @yield('title') - {{ config('APP_NAME', 'TrippyWords') }}
        </title>
        @yield('meta')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Twitter Meta S -->
            <meta name="twitter:card" content=""/>
            <meta name="twitter:title" content=""/>
            <meta name="twitter:url" content=""/>
            <meta name="twitter:description" content=""/>
            <meta name="twitter:image" content=""/>
        <!-- Twitter Meta E -->
        <!-- Favicon Icon S -->
            <link rel="icon" href="{{ asset('/public/assets/image/favicon.ico') }}" type="image/x-icon"/>
            <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/public/assets/image/apple-icon-144x144.png') }}"/>
            <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/public/assets/image/apple-icon-114x114.png') }}"/>
            <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/public/assets/image/apple-icon-72x72.png') }}"/>
            <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/public/assets/image/apple-icon-57x57.png') }}"/>
        <!-- Favicon Icon E -->
        <!-- Canonical Link S -->
            <link rel="canonical" href=""/>
        <!-- Canonical Link E -->
        <!-- Froala editor CSS start -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/froala_editor.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/froala_style.css') }}">
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/code_view.css')}}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/draggable.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/colors.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/emoticons.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/image_manager.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/image.css')}}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/line_breaker.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/line_breaker.min.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/table.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/char_counter.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/video.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/fullscreen.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/file.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/quick_insert.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/help.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/third_party/spell_checker.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/third_party/embedly.css') }}" />
            <link rel="stylesheet" href="{{URL::asset('public/assets/frola/css/plugins/special_characters.css') }}" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
        <!-- Froala editor CSS end -->
          <link rel="stylesheet" href="{{URL::asset('public/assets/bootstrap/css/bootstrap-tagsinput.css') }}" />
        <!-- Style Sheet Link S -->
            <!-- <link rel="stylesheet" href="{{ asset('/public/assets/css2/bootstrap-theme.css') }}"/>
 -->
           <!--  <link rel="stylesheet" href="{{ asset('/public/assets/css2/base.css') }}"/> -->

            <link rel="stylesheet" href="{{ asset('/public/assets/css/main.css') }}"/>

            <link rel="stylesheet" href="{{ asset('/public/assets/css/style.css') }}"/>
            
            <link rel="stylesheet" href="{{ asset('/public/assets/css/custom.css') }}"/>

            <link rel="stylesheet" href="{{ asset('/public/assets/css/lightbox.css') }}"/>
            @yield('css')  
            <style type="text/css">
                .ajax-load{
                    background: #e1e1e1;
                    padding: 10px 0px;
                    width: 100%;
                }
            </style>

            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110564124-1"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'UA-110564124-1');
            </script>


        <!-- Style Sheet Link E -->
        <!-- Java Script Link S -->
            <!-- <script type="text/javascript" src="{{ asset('/public/assets/libraries/jquery-3.2.1/js/jquery-3.2.1.min.js') }}"></script> -->
            <script src="{{ asset('/public/assets/js2/jquery.v2.1.3.js') }}"></script>
            <script type="text/javascript">
                /* Google Font API S */
                    var url = "{{URL::to('/')}}";
                    $(window).on("load", function() {
                        WebFontConfig = {
                            google: { families: ['Dosis:200,300,400,500,600,700,800'] }
                        };
                        (function() {
                            var wf = document.createElement('script');
                            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js';
                            wf.type = 'text/javascript';
                            wf.async = 'true';
                            var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(wf, s);
                        });
                    });
                /* Google Font API E */
            </script>
        <!-- Java Script Link E -->
    </head>
    <body class="<?php echo (strpos($_SERVER['SCRIPT_FILENAME'],'first_time_page.php'))?' body-profile-page':''; ?>">
        <!-- Scroll To Top S -->
            <div id="back_top" title="Scroll To Top" style="display: none;">
                <i class="icon fa fa-caret-up"></i>
            </div>
        <!-- Scroll To Top E -->
        @include('partials.header')
        <div id="wrapper">
            <div class="calc_height">
              @yield('content')  
            </div>
            <!-- Login - Modal S -->
            <div class="login_signup_modal modal fade" id="login_modal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="form_modal">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 form_section_grid">
                          <div class="form_section">
                            <div class="form_breadcrumbs">
                              <ul>
                                <li class="font-secondary" style="cursor: pointer;">Login</li>
                                <li>/</li>
                                <li id="show_registration" style="cursor: pointer;">SignUp</li>
                              </ul>
                            </div>
                            <form method="POST" id="loginForm" action="{{ URL('/login') }}">
                              <div class="login-page-error">
                                <span style="display: none;" class="login-success" id="success_message"><b>Please check your email</b></span>
                                <span style=";display: none;" class="login-danger" id="error_message1">User does not exist</span>
                                <span style=";display: none;" class="login-danger" id="error_message_verify">Please verify your Account</span>
                                <span style="display: none;" class="login-danger"  id="error_password_message">Password is wrong</span>
                                <span style="display: none;" class="login-danger"  id="error_token_expired" >Token is expired</span>
                                <span style="display: none;" class="login-success"  id="email_verification"></span>
                                <span style="display: none;" class="login-danger"  id="email_verification_error"></span>
                              </div>
                              @csrf                    
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
                                     <a id="showforgetpass" title="Forgot Password" style="color:#007bff;cursor: pointer;">
                                       Forgot password?
                                    </a>
                                  </div>
                                </div>
                              </div>
                              <input type="hidden" name="redirect_url" id="redirect_url" value="">
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
                                      <!--<a href="javascript:;" title="Twitter" class="icon twitter_icon">
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
            <!-- Signup - Modal S -->
            <div class="login_signup_modal modal fade" id="signup_modal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="form_modal">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 form_section_grid">
                          <div class="form_section">
                            <div class="form_breadcrumbs">
                              <ul>
                                <li id="show_login" style="cursor: pointer;">Login</li>
                                <li>/</li>
                                <li class="font-secondary" style="cursor: pointer;">SignUp</li>
                              </ul>
                            </div>
                            <form id="frmsignup" method="post" action="{{ route('signup') }}">
                              <div class="login-page-error">
                                <span style="display: none;" class="login-success" id="signup_success_message"><b>Signup Successfully, please verify your account.</b></span>
                                <span style="display: none;" class="login-danger" id="error_signup_message"><b>Invalid details Signup</b></span>
                                <span style="display: none;" class="login-danger"  id="error_useremail_message"><b>User Email Already Registered</b></span>
                                <span style="display: none;" class="login-danger"  id="error_username_message"><b>User Name Already Registered</b></span>
                              </div>
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
                                <div class="form-group signup-email-input">
                                  <div class="input-group">
                                    <input type="text" class="form-control login_signup_input" id="user_name" name="name" placeholder="User Name" required="">
                                    <div class="input-group-btn">
                                      <div>
                                        <i class="icon-user"></i>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="error_user_name" class="error alreadyemail">Username is associated with another user</div>
                                </div>
                                <div class="form-group signup-email-input">
                                  <div class="input-group">
                                    <input type="email" class="form-control login_signup_input" id="signup_email" name="email" placeholder="Email" required="">
                                    <div class="input-group-btn">
                                      <div>
                                        <i class="icon-contact"></i>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="error_signup_email" class="error alreadyemail">Email is associated with another user</div>
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
                                      <!--<a href="{{ route("twitterlogin") }}" title="Twitter" class="icon twitter_icon">
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
            <!-- Signup - Modal E -->
            <!-- Forget - Modal S -->
            <div class="login_signup_modal modal fade" id="forgetpass_modal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="form_modal">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 form_section_grid">
                          <div class="form_section">                                        
                            <form method="POST" id="forgetpassForm" action="{{ URL('/forgetpass') }}">
                              @csrf
                              <div class="login_signup_form">
                                <div class="form-group">
                                  <div class="input-group">
                                    <input id="forgetpassemail" type="email" class="form-control login_signup_input" name="forgetpassemail" value="" placeholder="Email">
                                    <div class="input-group-btn">
                                      <div>
                                        <i class="icon-contact"></i>
                                      </div>
                                    </div>                                                        
                                  </div>
                                </div>           
                              </div>
                              <div class="forgot-error">
                                <!-- <span style="display: none;" id="ferror_message">Please enter a valid email address</span> -->
                                <span style="display: none;" class="forgot-success" id="fsuccess_message"><b>Please check your email</b></span>
                                <span style="display: none;" class="forgot-danger" id="ferror_message">User does not exist</span>
                              </div>
                              <div class="button_section">
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="login_signup_button">
                                      <button type="button" id="btn_forgetpass" class="btn btn-forgot">
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
            <!-- Forget - Modal E -->
            <!-- Reset - Modal S -->
            <div class="login_signup_modal modal fade" id="resetpass_modal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="form_modal">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 form_section_grid">
                          <div class="form_section">                                        
                            <form method="POST" id="resetpassForm" name="resetpassForm" action="{{ URL('/updatepass') }}">
                              @csrf
                              <span style="color:green;display: none;margin-top: 15px" id="rsuccess_message"><b>Password changed successfully</b></span>
                              <span style="color:red;display: none;margin-top: 15px" id="rerror_message">Verification code not match</span>                                            
                              <span style="color:red;display: none;margin-top: 15px" id="rerror_message_passmatch">Password not match</span>
                              <div class="login_signup_form reset_form">
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
                                      <button type="button" id="btn_resetpass" class="btn" data-dismiss="modal">
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
            <!-- Reset - Modal E -->
         </div>
            @include('partials.footer')
        <!-- Java Script S -->
            <script src="{{ asset('/public/assets/libraries/bootstrap/js/popper.min.js') }}"></script>
            <!-- <script src="{{ asset('/public/assets/libraries/bootstrap/js/bootstrap.min.js') }}"></script> -->
            <script src="{{ asset('/public/assets/libraries/OwlCarousel2-2.2.1/js/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('/public/assets/libraries/wow/js/wow.min.js') }}"></script>
            <script src="{{ asset('/public/assets/libraries/back-top/js/back-top.js') }}"></script>
            <script src="{{ asset('/public/assets/js/custom.js') }}"></script> 
            

            <script src="{{ asset('/public/assets/js2/modernizr.min.js') }}"></script>
            <script src="{{ asset('/public/assets/js2/bootstrap.min.js') }}"></script>
            

            <script src="{{ asset('/public/assets/js/lightbox.js') }}"></script> 
            <!--  <script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
            <script src="{{url('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>    -->  
            <script src="<?php echo asset('/public'); ?>/js/sweetalert.min.js"></script>
            
        <!-- Java Script E -->
        <!-- Froala edior Scripts start -->
              <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
              <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/froala_editor.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/align.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/char_counter.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/code_beautifier.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/code_view.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/colors.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/draggable.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/emoticons.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/entities.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/file.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/font_size.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/font_family.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/fullscreen.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/image.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/image_manager.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/line_breaker.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/inline_style.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/link.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/lists.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/paragraph_format.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/paragraph_style.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/quick_insert.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/quote.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/table.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/save.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/url.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/video.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/help.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/print.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/third_party/spell_checker.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/special_characters.min.js') }}"></script>
              <script type="text/javascript" src="{{URL::asset('public/assets/frola/js/plugins/word_paste.min.js') }}"></script>

              


        <!-- Froala editor scripts end -->
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script>
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }); 
          /*Strat validation for login*/
          $(function () {

            <?php if (isset($status) && $status == 'verify') { ?>
              $('.loginPopup').trigger('click');
              $('#error_verify').show();
            <?php }elseif (isset($status) && $status == 'no-verify') { ?>
              $('.loginPopup').trigger('click');
              $('#error_token_expired').show();
            <?php } ?>

            $(document).on("hidden.bs.modal", "#login_modal", function () {
              $(this).find("#email").val(""); 
              var $alertas = $('#loginForm');
              $alertas.validate().resetForm();
              $alertas.find('.error').removeClass('error');
              });
          });
          $(function () {
            $(document).on("hidden.bs.modal", "#login_modal", function () {
              $(this).find("#password").val(""); 
              var $alertas = $('#loginForm');
              $alertas.validate().resetForm();
              $alertas.find('.error').removeClass('error');
              });
          });
          /*End validation for login*/

          /*Reset password popup close starts*/
           $('#resetpassForm').submit(function() {
                $('#btn_resetpass').modal('hide');
            });
          /*Reset password popup close ends*/

          /*Enter key validation for login Start*/
          $("#email").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btn_login").click();
              }
          });
          $("#password").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btn_login").click();
              }
          });
          /*Enter key validation for login end*/

            /*Forgot password enter key validation start*/
            $("#forgetpassemail").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btn_forgetpass").click();
              }
            });
            /*Forgot password enter key validation ends*/

            /*Forgot password form reset start*/
            $(function () {
              $(document).on("hidden.bs.modal", "#forgetpass_modal", function () {
                  $(this).find("#forgetpassemail").val(""); 
                  $("#ferror_message").css('display','none');
                  $("#fsuccess_message").css('display','none');
                  var $alertas = $('#resetpassForm');
                  $alertas.validate().resetForm();
                  $alertas.find('.error').removeClass('error');
                });
            });
            /*Forgot password form reset end*/

          $("#loginForm").validate({
              // Specify vaidation rules
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
              },
              errorPlacement: function (error, element) {
                var id = $(element).attr("id");
                error.appendTo($("#error_signin_" + id));
              },
              // Make sure the form is submitted to the destination defined
              // in the "action" attribute of the form when valid
              submitHandler: function(form) {}
            });

            $("#loginForm").keypress(function(event) {
              if (event.which == 13) {
                event.preventDefault();
                $("#btn_login").click();
              }
            });
            $("#btn_login").click(function(){
              $("#error_message1").css('display','none');
              $("#error_message_verify").css('display','none');
              $("#error_password_message").css('display','none');
              $("#email_verification").hide();
              $("#email_verification_error").hide();
              if($("#loginForm").valid()){
                var loginForm = $("#loginForm");
                loginForm.submit(function(e){
                  e.preventDefault();
                  var formData = loginForm.serialize();
                  $.post($("#loginForm").attr('action'),{
                    email:$("#email").val(),
                    'password' : $("#password").val()
                  },
                  function(response){
                    if(response == 0){
                      $("#error_message1").css('display','block');
                      $("#error_message_verify").css('display','none');
                      $("#error_password_message").css('display','none');
                      return false;
                    }else if(response == 1){
                      if(window.location == url+'/'){
                        window.location.href= url+"/dashboard";
                      }else{
                        window.location.reload();
                      }
                    } else if(response == 2 ) {                           
                      $("#error_message_verify").css('display','block');
                      $("#error_message1").css('display','none');
                      $("#error_password_message").css('display','none');
                      return false;
                    } else if(response == 3) {
                        $("#error_password_message").css('display','block');
                        $("#error_message_verify").css('display','none');
                        $("#error_message1").css('display','none');
                        return false;
                    } else {
                      $("#error_message1").css('display','block');
                      $("#error_message_verify").css('display','none');
                      $("#error_password_message").css('display','none');
                      return false;
                    }
                  });
                });
              }
            });
        </script>
        <script type="text/javascript">
             
          $("document").ready(function(){


            $(".modal").on('hidden.bs.modal', function(){
              if (!$('.modal').is(':visible')) {
              $("body").removeClass("modal-open_a");
              $("body").removeClass("modal-open_b");
              }
            });

            $("#show_registration").click(function(){
              $("body").removeClass("modal-open_a");
              $("body").addClass("modal-open_b");
            });

            $("#show_login").click(function(){
              $("body").addClass("modal-open_a");
              $("body").removeClass("modal-open_b");
            });

            // $("#show_registration").on('hidden.bs.modal', function() {
            //   $("body").removeClass("modal-open_b");
            // });
            // $("#login_modal").on('hidden.bs.modal',function(){
            //   $("body").removeClass("modal-open_a");
            //   $("body").removeClass("modal-open_b");
            // });
            // $("#signup_modal").on('hidden.bs.modal',function(){
            //   $("body").removeClass("modal-open_a");
            //   $("body").removeClass("modal-open_b");
            // });
            // $("#show_login").on('hidden.bs.modal', function() {
            //   $("body").removeClass("modal-open_a");
            // });
            
            
            
            $("#show_login").click(function(){
              $("#error_message1").css('display','none');
              $("#error_message_verify").css('display','none');
              $("#error_password_message").css('display','none');
              $("#signup_modal").modal('hide');
              $("#login_modal").modal('show');
              $("#forgetpass_modal").modal('hide');
              $("#resetpass_modal").modal('hide');
            });
            $("#show_registration").click(function(){
              $('#error_user_name').hide();
              $('#error_signup_email').hide();
              $("#signup_success_message").hide();   
              $("#error_useremail_message").hide();
              $("#error_username_message").hide();
              $("#error_signup_message").css('display','none');
              $("#signup_modal").modal('show');
              $("#login_modal").modal('hide');
              $("#forgetpass_modal").modal('hide');
              $("#resetpass_modal").modal('hide');
            });
            $("#showforgetpass").click(function(){
              $("#rsuccess_message").css('display','none');
              $("#rerror_message").css('display','none');
              $("#rerror_message_passmatch").css('display','none');
              $("#signup_modal").modal('hide');
              $("#login_modal").modal('hide');
              $("#forgetpass_modal").modal('show');
              $("#resetpass_modal").modal('hide');
            });
            $('#login_modal').on('hidden.bs.modal', function() {
              $("#error_message1").css('display','none');
              $("#error_message_verify").css('display','none');
              $("#error_password_message").css('display','none');
              var $alertas = $('#loginForm');
              $alertas.validate().resetForm();
              $alertas.find('.error').removeClass('error');
            });
            $('#signup_modal').on('hidden.bs.modal', function() {
              $('#error_user_name').hide();
              $('#error_signup_email').hide();
              $("#signup_success_message").hide();   
              $("#error_useremail_message").hide();
              $("#error_username_message").hide();
              $("#error_signup_message").css('display','none');
              var $alertas = $('#frmsignup');
              $alertas.validate().resetForm();
              $alertas.find('.error').removeClass('error');
            });
            $('#forgetpass_modal').on('hidden.bs.modal', function() {
              $("#rsuccess_message").css('display','none');
              $("#rerror_message").css('display','none');
              $("#rerror_message_passmatch").css('display','none');
              var $alertas = $('#resetpassForm');
              $alertas.validate().resetForm();
              $alertas.find('.error').removeClass('error');
            });


            $("#forgetpassForm").validate({
               rules: {
                      forgetpassemail: {
                            required: true,        
                            email: true,
                          }
                    },
               messages: {
                      email: "Please enter a valid email address"
                    },
            });
            
            $("#fsuccess_message").css('display','none');
            $("#btn_forgetpass").click(function(){    
              if ($('#forgetpassForm').valid()==true) {
                var forgetpassForm= $("#forgetpassForm");
                //forgetpassForm.submit(function(e){
                 // e.preventDefault();
                  var formData = forgetpassForm.serialize();
                  $.post($("#forgetpassForm").attr('action'),{
                    email:$("#forgetpassemail").val()
                  },
                  function(response){
                    if(response == 1){                        
                      $("#fsuccess_message").css('display','block');
                      $("#ferror_message").css('display','none');
                      $("#forgetpassemail").val("");
                      return false;
                    } else {                           
                      $("#ferror_message").css('display','block');
                      $("#fsuccess_message").css('display','none');
                      return false;
                    }
                  });
                //});
              }
            });

             $("#resetpassForm").keypress(function(event) {
              if (event.which == 13) {
                event.preventDefault();
                $("#btn_resetpass").click();
              }
            });

            $("#resetpassForm").validate({
               rules: {
                      newpassword: {
                          required: true
                      },
                      confirmpassword: {
                          required: true,        
                          equalTo:  newpassword
                      }
                    }
            });

            $("#btn_resetpass").click(function(){   
              if ($("#resetpassForm").valid()==true) {
                $("#rsuccess_message").css('display','none');
                $("#rerror_message").css('display','none');
                $("#rerror_message_passmatch").css('display','none');
                var resetpassForm= $("#resetpassForm");
                //resetpassForm.submit(function(e){
                //  e.preventDefault();
                  var formData = resetpassForm.serialize();
                  $.post($("#resetpassForm").attr('action'),{
                    email:$("#resetpassemail").val(),
                    key_code:$("#key_code").val(),
                    newpass:$("#newpassword").val(),
                    confirm:$("#confirmpassword").val()
                  },
                  function(response){
                    if(response == 1){                        
                      $("#rsuccess_message").css('display','block');
                      $("#rerror_message").css('display','none');
                      $("#rerror_message_passmatch").css('display','none');
                      //alert("1");                            
                      $("#newpassword").val('');
                      $("#confirmpassword").val('');
                      return false;
                    } else if(response == 2) {
                      $("#rsuccess_message").css('display','none');
                      $("#rerror_message").css('display','none');
                      $("#rerror_message_passmatch").css('display','block');
                      //alert("2");
                      $("#newpassword").val('');
                      $("#confirmpassword").val('');
                      return false;
                    } else {
                      $("#rsuccess_message").css('display','none');
                      $("#rerror_message").css('display','block');
                      $("#rerror_message_passmatch").css('display','none');
                      //alert("0");
                      $("#newpassword").val('');
                      $("#confirmpassword").val('');
                      return false;
                    }
                  });
                //});
              }  
            });
          /*  $("#frmsignup").validate({
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
              },
              errorPlacement: function (error, element) {
                var id = $(element).attr("id");
                error.appendTo($("#error_" + id));
              },
              // Make sure the form is submitted to the destination defined
              // in the "action" attribute of the form when valid
              submitHandler: function(form) {}
              });   */

               /*Registration validation start*/
              $("#btnsignup").click(function(){        
                  $("#frmsignup").validate({
                       rules: {
                              first_name: {
                                    required: true,
                                    customText:true
                                  },
                              last_name: {
                                    required: true,
                                    customText:true
                                  },
                              name: {
                                    required: true
                                  },
                              email: {
                                    required: true,        
                                    email: true,
                                  },
                              
                              password: {
                                required: true,
                                minlength: 5
                              }
                            },
                        messages: {
                              first_name: {
                                required: "Please enter your firstname",
                                customText: "Please enter letters only."
                              },
                              last_name: {
                                required: "Please enter your lastname",
                                customText: "Please enter letters only."
                              },
                              name: {
                                    required:"Please enter your username"
                                  },
                              email: "Please enter a valid email address",
                              password: {
                                required: "Please provide a password",
                                minlength: "Your password must be at least 5 characters long"
                              }
                            },
                  });
              });

              $.validator.addMethod("customText", 
                function(value, element) {
                    var re = /^[a-zA-Z]+$/;;
                    return re.test(value);
              });
              /*Registration validation ends*/  
              
            $("#frmsignup").keypress(function(event) {
              if (event.which == 13) {
                event.preventDefault();
                $("#btnsignup").click();
              }
            });
            $("#btnsignup").click(function(){
              $("#signup_success_message").hide();   
              $("#error_username_message").hide();
              $("#error_useremail_message").hide();
              $("#error_signup_message").css('display','none');
              if($("#frmsignup").valid()){
                var user_name = $('#user_name').val();
                $.ajax({
                  url: "username",
                  data: {
                    'username': user_name
                  },
                  success: function (result) {
                    if (result == 0) {
                      $('#error_user_name').show();
                      return false;
                    }else{
                      $('#error_user_name').hide();
                      var emailid = $('#signup_email').val();
                $.ajax({
                  url: "email",
                  data: {
                    'email': emailid
                  },
                  success: function (result) {
                    if (result == 0) {
                      $('#error_signup_email').show();
                      return false;
                    } else {
                        $('#error_signup_email').hide();
                        $.ajax({
                        type:'POST',
                        data:{
                          name:$("#user_name").val(),
                          first_name:$("#first_name").val(),
                          last_name:$("#last_name").val(),
                          email:$("#signup_email").val(),
                          password:$("#signup_password").val()
                        },
                        url:'{{ route('signup')}}',
                        success:function(response) {
                          if(response == 1){
                            $("#signup_success_message").css('display','block');          
                            $("#error_signup_message").hide();
                            $("#error_useremail_message").hide();
                            $("#error_username_message").hide();
                            document.getElementById("frmsignup").reset(); 
                            return false;
                          } else if(response==2) {
                            $("#error_useremail_message").css('display','block');
                            $("#error_signup_message").hide();
                            $("#signup_success_message").hide(); 
                            $("#error_username_message").hide(); 
                          } else if(response==3) {
                            $("#error_username_message").css('display','block');
                            $("#error_signup_message").hide();
                            $("#error_useremail_message").hide(); 
                            $("#signup_success_message").hide(); 
                          }else {
                            $("#signup_success_message").hide();   
                            $("#error_useremail_message").hide();
                            $("#error_username_message").hide();
                            $("#error_signup_message").css('display','block');
                            return false;
                          }
                        }
                        });
                      }
                    }
                });
                    }
                  },
                  error: function (result) {
                    //alert('error');
                  }
                });
                }
              // $.post($("#frmsignup").attr('action'),{
              // name:$("#user_name").val(),
              // first_name:$("#first_name").val(),
              // last_name:$("#last_name").val(),
              // email:$("#signup_email").val(),
              // password:$("#signup_password").val()
              // },function(response){
              // });
            });
            @if (\Session::has('forget_status')=='1' && \Session::get('key_code')!='') 
              $("#resetpassemail").val('<?php echo \Session::get('user_email')?>');
              $("#key_code").val('<?php echo \Session::get('key_code')?>');
              if($("#key_code").val()!='' && $("#resetpassemail").val()!='') {
                $("#resetpass_modal").modal('show');
              }
            @else
              $("#rsuccess_message").css('display','none');
              $("#rerror_message").css('display','block');
              $("#rerror_message_passmatch").css('display','none'); 
              if($("#key_code").val()!='' && $("#resetpassemail").val()!='') {
                $("#resetpass_modal").modal('show');
              }
            @endif
            $("#defaultOpen").click(function(){});
          });
          setTimeout(function() {
            $('.alert').fadeOut('fast');        
          }, 3000); // <-- time in milliseconds
        </script>

        <script>

        $(document).ready(function () {
        $(function () {
              $(document).on("hidden.bs.modal", "#login_modal", function () {
                $(this).find("#email").val(""); 
                var $alertas = $('#loginForm');
                $alertas.validate().resetForm();
                $alertas.find('.error').removeClass('error');
                });
            });
            $(function () {
          $(document).on("hidden.bs.modal", "#login_modal", function () {
            $(this).find("#password").val(""); 
            var $alertas = $('#loginForm');
            $alertas.validate().resetForm();
            $alertas.find('.error').removeClass('error');
          });
        });
            /*End validation for login*/
            /*Start validation for registration*/
            $(function () {
              $(document).on("hidden.bs.modal", "#signup_modal", function () {
                $('#error_user_name').hide();
                $('#error_signup_email').hide();
                $(this).find("#first_name").val(""); 
                $(this).find("#last_name").val(""); 
                $(this).find("#user_name").val(""); 
                $(this).find("#signup_email").val(""); 
                $(this).find("#signup_password").val(""); 
                var $alertas = $('#frmsignup');
                $alertas.validate().resetForm();
                $alertas.find('.error').removeClass('error');
                });
            });
            /*End validaion for registration*/

            /*Restriction for special characters start*/
            $('input').bind('keypress', function (event) {
                var regex = new RegExp("^[a-zA-Z0-9@_.]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                   event.preventDefault();
                   return false;
                }
            });

          $("#error_signup_email").hide();  
            $("#signup_email").blur(function () {
              var emailid = $('#signup_email').val();
            $.ajax({
              url: "email",
              data: {
                'email': emailid
              },
              success: function (result) {
                if (result == 0) {
                  $('#error_signup_email').show();
                  return false;
                }else{
                  $('#error_signup_email').hide();
                }
              },
              error: function (result) {
                //alert('error');
              }
            });
          });
            
            $("#error_user_name").hide();  
            $("#user_name").blur(function () {
              var user_name = $('#user_name').val();
            $.ajax({
              url: "username",
              data: {
                'username': user_name
              },
              success: function (result) {
                if (result == 0) {
                  $('#error_user_name').show();
                  return false;
                }else{
                  $('#error_user_name').hide();
                }
              },
              error: function (result) {
                //alert('error');
              }
            });
          });
          

          /*Enter key validation for registraion start*/
          $("#first_name").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btnsignup").click();
              }
          });
          $("#last_name").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btnsignup").click();
              }
          });
          $("#user_name").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btnsignup").click();
              }
          });
          $("#signup_email").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btnsignup").click();
              }
          });
          $("#signup_password").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btnsignup").click();
              }
          });
          /*Enter key validation for registration end*/

          /*Start validation for registration*/
          $(function () {
            $(document).on("hidden.bs.modal", "#signup_modal", function () {
              $('#error_user_name').hide();
              $('#error_signup_email').hide();
              $(this).find("#first_name").val(""); 
              $(this).find("#last_name").val(""); 
              $(this).find("#user_name").val(""); 
              $(this).find("#signup_email").val(""); 
              $(this).find("#signup_password").val(""); 
              var $alertas = $('#frmsignup');
              $alertas.validate().resetForm();
              $alertas.find('.error').removeClass('error');
              });
          });
          /*End validaion for registration*/

          /*Restriction for special characters start*/
          $('input').bind('keypress', function (event) {
              var regex = new RegExp("^[a-zA-Z0-9@_.]+$");    
              var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
              if (!regex.test(key)) {
                 event.preventDefault();
                 return false;
              }
          });
          /*Restriction for special characters end*/
        });

        </script>
        @yield('js')
    </body>
</html>