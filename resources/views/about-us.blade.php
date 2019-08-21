@extends('layouts.app')

@section('title','About Us')

@section('content')



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

                                                <li class="font-secondary">Login</li>

                                                <li>/</li>

                                                <li>SignUp</li>

                                            </ul>

                                        </div>

                                        <form>

                                            <div class="login_signup_form">

                                                <div class="form-group">

                                                    <div class="input-group">

                                                        <input type="text" class="form-control login_signup_input" name="user_id" placeholder="Email">

                                                        <div class="input-group-btn">

                                                            <div>

                                                                <i class="icon-contact"></i>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <div class="input-group">

                                                        <input type="text" class="form-control login_signup_input" name="user_id" placeholder="Password">

                                                        <div class="input-group-btn">

                                                            <div>

                                                                <i class="icon-locked"></i>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <div class="text-right">

                                                        Forget <a href="javascript:;" title="Forget Password">

                                                            password?

                                                        </a>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="button_section">

                                                <div class="row">

                                                    <div class="col-md-3">

                                                        <div class="login_signup_button">

                                                            <button class="btn">LOGIN</button>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-9">

                                                        <div class="social_icon_section">

                                                            <div class="title">Or login with</div>

                                                            <a href="javascript:;" title="Facebook" class="icon facebook_icon">

                                                                <i class="fa fa-facebook"></i>

                                                            </a>

                                                            <a href="javascript:;" title="Twitter" class="icon twitter_icon">

                                                                <i class="fa fa-twitter"></i>

                                                            </a>

                                                            <a href="javascript:;" title="Google Plus" class="icon google_icon">

                                                                <i class="fa fa-google-plus"></i>

                                                            </a>

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

                                                <li>Login</li>

                                                <li class="font-secondary">/</li>

                                                <li class="font-secondary">SignUp</li>

                                            </ul>

                                        </div>

                                        <form>

                                            <div class="login_signup_form">

                                                <div class="form-group">

                                                    <div class="input-group">

                                                        <input type="text" class="form-control login_signup_input" name="user_id" placeholder="Your Name">

                                                        <div class="input-group-btn">

                                                            <div>

                                                                <i class="icon-user"></i>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <div class="input-group">

                                                        <input type="text" class="form-control login_signup_input" name="user_id" placeholder="Email">

                                                        <div class="input-group-btn">

                                                            <div>

                                                                <i class="icon-contact"></i>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <div class="input-group">

                                                        <input type="text" class="form-control login_signup_input" name="user_id" placeholder="Password">

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

                                                            <button class="btn">SIGNUP</button>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-9">

                                                        <div class="social_icon_section">

                                                            <div class="title">Or login with</div>

                                                            <a href="javascript:;" title="Facebook" class="icon facebook_icon">

                                                                <i class="fa fa-facebook"></i>

                                                            </a>

                                                            <a href="javascript:;" title="Twitter" class="icon twitter_icon">

                                                                <i class="fa fa-twitter"></i>

                                                            </a>

                                                            <a href="javascript:;" title="Google Plus" class="icon google_icon">

                                                                <i class="fa fa-google-plus"></i>

                                                            </a>

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

        <!-- Login - Modal E -->

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

                                <div id="how_its_works" class="tabcontent" style="display: none">

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



@endsection

