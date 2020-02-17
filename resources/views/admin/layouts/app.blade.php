<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="description" content="Admin, Dashboard, Bootstrap" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />



    <title>TrippyWords - Admin Panel</title>

    <link rel="icon" href="{{ asset('/public/assets/image/favicon.ico') }}" type="image/x-icon"/>

    <link rel="apple-touch-icon" sizes="180x180" href="../../img/favicon/apple-touch-icon.png">

<!--    <link rel="icon" type="image/png" sizes="32x32" href="../../img/favicon/favicon-32x32.png">

    <link rel="icon" type="image/png" sizes="16x16" href="../../img/favicon/favicon-16x16.png">-->

    <link rel="manifest" href="../../img/favicon/manifest.json">

    <link rel="mask-icon" href="../../img/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <meta name="theme-color" content="#ffffff">



    <!-- fonts -->

    <link rel="stylesheet" href="{{ url('/public/admin-assets/fonts/md-fonts/css/materialdesignicons.min.css') }}">

    <link rel="stylesheet" href="{{ url('/public/admin-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <!-- animate css -->

    <link rel="stylesheet" href="{{ url('/public/admin-assets/libs/animate.css/animate.min.css') }}">



     <!-- jquery-loading -->

     <link rel="stylesheet" href="{{ url('/public/admin-assets/libs/jquery-loading/dist/jquery.loading.min.css') }}">



    <!-- octadmin main style -->
    <link id="pageStyle" rel="stylesheet" href="{{ url('/public/admin-assets/css/dashboard-custome.css') }}">
    <link id="pageStyle" rel="stylesheet" href="{{ url('/public/admin-assets/css/style.css') }}">



    @yield('header_css')



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->



</head>



<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed">

    

    @include('admin.partials.header')



    <div class="app-body">

        @include('admin.partials.sidebar')



        <main class="main">

            <!-- Breadcrumb -->

            <ol class="breadcrumb bc-colored bg-theme" id="breadcrumb">

                <li class="breadcrumb-item ">

                    <a href="{{ route('admin-panel') }}">Home</a>

                </li>

                <li class="breadcrumb-item active">

                    <a href="{{ route('admin-panel') }}">Dashboards</a>

                </li>

                <li class="breadcrumb-item active">

                    <a href="">{{ ucfirst(Request::segment(2)) }}</a>

                </li>

                

            </ol>



            <div class="container-fluid">

                @yield('content')

              

                <!-- end animated fadeIn -->

            </div>

            <!-- end container-fluid -->



        </main>

        <!-- end main -->





       

        <!-- end aside -->



    </div>

    <!-- end app-body -->

    

    <footer class="app-footer">

        <!-- <a href="#" class="text-theme">TrippyWords</a> &copy; 2020  -->
        <a href="#" class="text-theme">TrippyWords</a> &copy; <script>document.write(new Date().getFullYear())</script>
  </span>
        </div>

    </footer>

    <script type="text/javascript">

        var ADMIN_URL = "{{ URL('/adminpanel/') }}";

    </script>

    <!-- Bootstrap and necessary plugins -->

    <script src="{{ url('/public/admin-assets/libs/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ url('/public/admin-assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>

    <script src="{{ url('/public/admin-assets/libs/Bootstrap/bootstrap.min.js') }}"></script>

    <script src="{{ url('/public/admin-assets/libs/PACE/pace.min.js') }}"></script>

    <script src="{{ url('/public/admin-assets/libs/chart.js/dist/Chart.min.js') }}"></script>

    <script src="{{ url('/public/admin-assets/libs/nicescroll/jquery.nicescroll.min.js') }}"></script>



   <!-- jquery-loading -->


   <script src="{{ url('/public/admin-assets/libs/jquery-loading/dist/jquery.loading.min.js') }}"></script>

   



    @yield('footer_script')


    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <!-- octadmin Main Script -->

    <script src="{{ url('/public/admin-assets/js/app.js') }}"></script>



</body>



</html>