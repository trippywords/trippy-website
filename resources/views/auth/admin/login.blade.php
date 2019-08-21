<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Trippy Words Admin</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../img/favicon/manifest.json">
    <link rel="mask-icon" href="../../img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

    <!-- fonts -->
    <link rel="stylesheet" href="admin-assets/fonts/md-fonts/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="admin-assets/libs/animate.css/animate.min.css">

     <!-- jquery-loading -->
     <link rel="stylesheet" href="admin-assets/libs/jquery-loading/dist/jquery.loading.min.css">
    <!-- octadmin main style -->
    <link id="pageStyle" rel="stylesheet" href="admin-assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>
    <section class="container-pages">
       
        <div class="brand-logo float-left"><a class="" href="{{ route("admin") }}"> Trippy Words Admin</a></div>
              
        <div class="pages-tag-line text-white">  
            <div class="h4">Let's Get Started .!</div>
            <small> most powerfull most selling Admin Panel In The World</small>
        </div>

        <div class="card pages-card col-lg-4 col-md-6 col-sm-6">
            <div class="card-body ">
                <div class="h4 text-center text-theme"><strong>Login</strong></div>
                <div class="small text-center text-dark"> Login to Account </div>
               
                    <form method="POST" id="frmadminlogin" action="{{ route('checkLogin') }}">
                        <div class="form-group">
                            <div class="input-group">
                                 <span class="input-group-addon text-theme"><i class="fa fa-user"></i> 
                                </span>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>                               
                                 
                            </div>                           
                            @if ($errors->has('email'))
                                 <span class="invalid-feedback" style="display: block;margin-left:40px">
                                        <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                                @endif
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon text-theme"><i class="fa fa-asterisk"></i></span>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                 
                                

                            </div>
                            @if ($errors->has('password'))
                                
                                    <span class="invalid-feedback" style="display: block;margin-left:40px">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                            
                        </div>
                        <div class="form-group form-actions">
                            <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            <input type="hidden" value="admin" name="is_admin" />
                            <button type="submit" class="btn  btn-theme login-btn ">   Login   </button>
                        </div>
                        {{ csrf_field() }}
                    </form>

<!--                    <div class="text-center">
                        <small>Don't you have an account ? Please
                            <a href="pages-signup.html" class="text-theme">Signup</a>
                        </small>
                    </div>-->
              
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </section>
    <!-- end section container -->
    <div class="half-circle"></div>
    <div class="small-circle"></div>

    
         <!-- end mybutton -->

    <div id="copyright"><a href="#" > Trippy Word Admin</a> &copy; 2018. </div>
   
         <!-- Bootstrap and necessary plugins -->
    <script src="admin-assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="admin-assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="admin-assets/libs/Bootstrap/bootstrap.min.js"></script>
    <script src="admin-assets/libs/PACE/pace.min.js"></script>
    <script src="admin-assets/libs/chart.js/dist/Chart.min.js"></script>
    <script src="admin-assets/libs/nicescroll/jquery.nicescroll.min.js"></script>

    <script src="admin-assets/libs/jquery-knob/dist/jquery.knob.min.js"></script>

        
    <!-- jquery-loading -->
    <script src="admin-assets/libs/jquery-loading/dist/jquery.loading.min.js"></script>
    <!-- octadmin Main Script -->
    <script src="admin-assets/js/app.js"></script>

</body>

</html>
