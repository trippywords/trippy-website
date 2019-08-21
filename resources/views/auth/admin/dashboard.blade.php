@extends('admin.layouts.app')	





@section('content')



<div class="animated fadeIn">



    <div class="row">

        <div class="col-md-12">

            <div class="card card-pm-summary bg-theme">

                <div class="card-body">



<!--                    <div class="clearfix">

                        <div class="float-left">

                            <div class="h3 text-white">

                                <strong>Overview</strong>

                            </div>

                            <small class="text-white">4031 TOTAL</small>

                        </div>



                        <div class="float-right">

                            <button class="btn btn-dark">New Post</button>

                        </div>

                    </div>-->

                    <!-- end clearfix -->



                    <div class="row">

                        <div class="col-md-2">

                            <div class="card-body">

                                <div class="widget-pm-summary">

                                    <i class="mdi mdi-checkbox-multiple-marked-outline"></i>

                                    <div class="widget-text">

                                        <div class="h2 text-white">{{  $user_count  }}</div>

                                        <small class="text-white">Total Users</small>

                                    </div>

                                    <!-- end widget-text -->

                                </div>

                                <!-- end widget-pm-simmary -->

                            </div>

                            <!-- end card-body -->

                        </div>

                        <!-- end inside-col -->



                        <div class="col-md-2">

                            <div class="card-body">

                                <div class="widget-pm-summary">

                                    <i class="mdi mdi-google-circles"></i>

                                    <div class="widget-text">

                                        <div class="h2 text-white">{{ $total_blog_count }}</div>

                                        <small class="text-white">Total Blogs</small>

                                    </div>

                                    <!-- end widget-text -->

                                </div>

                                <!-- end widget-pm-simmary -->

                            </div>

                            <!-- end card-body -->

                        </div>

                        <!-- end inside-col -->



                        <div class="col-md-2">

                            <div class="card-body">

                                <div class="widget-pm-summary">

                                    <i class="mdi mdi-chart-pie"></i>

                                    <div class="widget-text">

                                        <div class="h2 text-white">{{ $publish_blog_count }}</div>

                                        <small class="text-white">Successfull Blogs</small>

                                    </div>

                                    <!-- end widget-text -->

                                </div>

                                <!-- end widget-pm-simmary -->

                            </div>

                            <!-- end card-body -->

                        </div>

                        <!-- end inside-col -->



                        <div class="col-md-2">

                            <div class="card-body">

                                <div class="widget-pm-summary">

                                    <i class="mdi mdi-file-tree"></i>

                                    <div class="widget-text">

                                        <div class="h2 text-white">{{ $draft_blog_count }}</div>

                                        <small class="text-white">Unpublished Blogs</small>

                                    </div>

                                    <!-- end widget-text -->

                                </div>

                                <!-- end widget-pm-simmary -->

                            </div>

                            <!-- end card-body -->

                        </div>

                        <!-- end inside-col -->

                    </div>

                    <!-- end inside row -->



                </div>

                <!-- end card-body -->

            </div>

            <!-- end card -->

        </div>

        <!-- end col -->

    </div>

    <!-- end row -->

    <div class="row">

        <div class="col-md-6">

            <div class="row">

                <div class="col-md-6">

                    <div class="card card-accent-danger">

                        <div class="card-body">

                            <div class="clearfix">

                                <div class="float-right">

                                    <div class="h2 text-danger">50</div>

                                </div>

                            </div>

                            <div class="float-left">

                                <div class="h3 card-content">

                                    <strong>Published</strong>

                                </div>

                                <div class="h6 text-danger"> Blogs </div>

                            </div>

                        </div>

                        <!-- end card-body -->

                    </div>

                    <!-- end card -->

                </div>

                <!-- end inside col -->

                <div class="col-md-6">

                    <div class="card card-accent-success">

                        <div class="card-body">

                            <div class="clearfix">

                                <div class="float-right">

                                    <div class="h2 text-success">10</div>

                                </div>

                            </div>

                            <div class="float-left">

                                <div class="h3 card-content">

                                    <strong>Under Moderation</strong>

                                </div>

                                <div class="h6 text-success"> Blogs </div>

                            </div>

                        </div>

                        <!-- end card-body -->

                    </div>

                    <!-- end card -->

                </div>

                <!-- end inside col -->

            </div>

            <!-- end inside row -->



            <div class="row">

                <div class="col-md-6">

                    <div class="card card-accent-primary">

                        <div class="card-body">

                            <div class="clearfix">

                                <div class="float-right">

                                    <div class="h2 text-primary">700</div>

                                </div>

                            </div>

                            <div class="float-left">

                                <div class="h3 card-content">

                                    <strong>Keywords</strong>

                                </div>

                                <div class="h6 text-primary"> Work </div>

                            </div>

                        </div>

                        <!-- end card-body -->

                    </div>

                    <!-- end card -->

                </div>

                <!-- end inside col -->

                <div class="col-md-6">

                    <div class="card card-accent-warning">

                        <div class="card-body ">

                            <div class="clearfix">

                                <div class="float-right">

                                    <div class="h2 text-warning">160</div>

                                </div>

                            </div>

                            <div class="float-left">

                                <div class="h3 card-content">

                                    <strong>Hours</strong>

                                </div>

                                <div class="h6 text-warning"> Coffe </div>

                            </div>

                        </div>

                        <!-- end card-body -->

                    </div>

                    <!-- end card -->

                </div>

                <!-- end inside col -->



            </div>

            <!-- end inside row -->

        </div>

        <!-- end col -->



        <div class="col-md-6">

            <div class="card card-accent-theme">

                <div class="card-body">

                    <div class="h5 ">

                        <strong>Blog Statistics</strong>

                    </div>

                    <small class="text-theme">BASED ON LAST 30 DAYS</small>

                    <canvas class="chart-canvas" id="earning-chart-success"></canvas>

                </div>

                <!-- end card-body -->

            </div>

            <!-- end card -->

        </div>

        <!-- end col -->

    </div>

    <!-- end row -->



    <div class="row">



        <div class="col-md-6">

            <div class="card  card-accent-theme">

                <div class="message-widget">

                    <h1> New Blogs

                        <i class="fa fa-comments-o float-right"></i>

                    </h1>



                    <ul id="messageList">

                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification online"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Natalie Wall</strong>

                                        </div>

                                        <p class="text-muted">Anyways i would like just do it</p>



                                    </div>

                                </div>

                                <small class="float-right">2 minuts ago</small>

                            </a>

                        </li>







                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification offline"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Steve johns</strong>

                                        </div>

                                        <p class="text-muted">There is Problem inside the Application</p>



                                    </div>

                                </div>

                                <small class="float-right">10 minuts ago</small>

                            </a>

                        </li>



                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification away"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Tim Johns</strong>

                                        </div>

                                        <p class="text-muted">Anyways i would like just do it</p>



                                    </div>

                                </div>

                                <small class="float-right">10 minuts ago</small>

                            </a>

                        </li>

                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification offline"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Steve johns</strong>

                                        </div>

                                        <p class="text-muted">There is Problem inside the Application</p>



                                    </div>

                                </div>

                                <small class="float-right">10 minuts ago</small>

                            </a>

                        </li>

                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification buzy"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Taniya Jan</strong>

                                        </div>

                                        <p class="text-muted">Please Checkout The Attachment</p>



                                    </div>

                                </div>

                                <small class="float-right">2 Days ago</small>

                            </a>

                        </li>





                    </ul>

                </div>

                <!-- end card-body -->

                <div class="card-footer text-center">

                    <a href="" class="text-theme">

                        <strong>See all Blogs (150) </strong>

                    </a>



                </div>

                <!-- end card-footer -->

            </div>

            <!-- end card -->

        </div>

        <!-- end col -->



        <div class="col-md-6">

            <div class="card  card-accent-theme">

                <div class="message-widget">

                    <h1> Blogs for Moderation 

                        <i class="fa fa-comments-o float-right"></i>

                    </h1>



                    <ul id="messageList">

                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification online"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Natalie Wall</strong>

                                        </div>

                                        <p class="text-muted">Anyways i would like just do it</p>



                                    </div>

                                </div>

                                <small class="float-right">2 minuts ago</small>

                            </a>

                        </li>







                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification offline"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Steve johns</strong>

                                        </div>

                                        <p class="text-muted">There is Problem inside the Application</p>



                                    </div>

                                </div>

                                <small class="float-right">10 minuts ago</small>

                            </a>

                        </li>



                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification away"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Tim Johns</strong>

                                        </div>

                                        <p class="text-muted">Anyways i would like just do it</p>



                                    </div>

                                </div>

                                <small class="float-right">10 minuts ago</small>

                            </a>

                        </li>

                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification offline"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Steve johns</strong>

                                        </div>

                                        <p class="text-muted">There is Problem inside the Application</p>



                                    </div>

                                </div>

                                <small class="float-right">10 minuts ago</small>

                            </a>

                        </li>

                        <li class="clearfix">

                            <a href="#" class="dropdown-item">

                                <div class="message-box ">

                                    <div class="u-img float-left">

                                        <img src="http://via.placeholder.com/100x100" alt="user" />

                                        <span class="notification buzy"></span>

                                    </div>

                                    <div class="u-text float-left">

                                        <div class="u-name">

                                            <strong>Taniya Jan</strong>

                                        </div>

                                        <p class="text-muted">Please Checkout The Attachment</p>



                                    </div>

                                </div>

                                <small class="float-right">2 Days ago</small>

                            </a>

                        </li>





                    </ul>

                </div>

                <!-- end card-body -->

                <div class="card-footer text-center">

                    <a href="" class="text-theme">

                        <strong>See all Blogs (150) </strong>

                    </a>



                </div>

                <!-- end card-footer -->

            </div>

            <!-- end card -->

        </div>

        <!-- end col -->

        <!-- end col -->



    </div>

    <!-- end row -->

</div>



@endsection



@section('footer_script')





<!-- dashboard-pm -example -->

<script src="{{ url('/public/admin-assets/js/dashboard-pm-example.js') }}"></script>



@endsection