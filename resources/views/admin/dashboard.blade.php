@extends('admin.layouts.app')	
@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-pm-summary bg-theme">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="widget-pm-summary">
                                    <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
                                    <a href="{{ url('adminpanel/users') }}">
                                        <div class="widget-text">
                                            <div class="h2 text-white">{{  $user_count  }}</div>
                                            <small class="text-white">Total Users</small>
                                        </div>
                                    </a>
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
                                        <a href="{{ url('adminpanel/genre') }}">
                                            <div class="widget-text">
                                                <div class="h2 text-white">{{ $genre }}</div>
                                                <small class="text-white">Total Genres</small>
                                            </div>
                                        </a>
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
                                        <a href="{{ url('adminpanel/blog') }}">
                                            <div class="widget-text">
                                                <div class="h2 text-white">{{ $publish_blog_count }}</div>
                                                <small class="text-white">Published Blogs</small>
                                            </div>
                                        </a>
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
                                    <a href="{{ url('adminpanel/blog') }}">
                                        <div class="widget-text">
                                            <div class="h2 text-white">{{ $draft_blog_count }}</div>
                                            <small class="text-white">Unpublished Blogs</small>
                                        </div>
                                    </a>    
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
    <div class="row">
        <div class="col-md-6">
            <div class="card  card-accent-theme">
                <div class="message-widget">
                    <h1> New Users
                        <i class="fa fa-users float-right"></i>
                    </h1>
                    <ul id="messageList">
                        @if($users)
                            @foreach($users as $user)
                                <li class="clearfix">
                                    <a href="{{ url('profile/'.$user->name.'') }}" class="dropdown-item" target="_blank">
                                        <div class="message-box ">
                                            <div class="u-img float-left">
                                                <?php if(isset($user->profile_image) && $user->profile_image != null && file_exists(public_path() . '/user_img/' . $user->profile_image)){ ?>
                                                    <img src='{{ asset("public/user_img/".$user->profile_image) }}' />
                                                <?php }else{ ?>
                                                   <img src="{{ asset('/') }}public/assets/image/profile.png"  >
                                                <?php } ?>
                                                <span class="notification online"></span>

                                            </div>
                                            <div class="u-text float-left">
                                                <div class="u-name">
                                                    <strong>{{$user->first_name}} {{$user->last_name}}</strong>
                                                </div>
                                                <!-- <p class="text-muted">Anyways i would like just do it</p>
 -->
                                            </div>
                                        </div>
                                        <small class="float-right">{{getDays($user->created_at)}}</small>
                                    </a>
                                </li>
                            @endforeach
                        @endif    
                    </ul>
                </div>
                <!-- end card-body -->
                @if(isset($user_count) && $user_count > 5)
                <div class="card-footer text-center">
                    <a href="{{ url('adminpanel/users') }}" class="text-theme">
                        <strong>See all Users ({{  $user_count  }}) </strong>
                    </a>
                </div>
                @endif
                <!-- end card-footer -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-md-6">
            <div class="card  card-accent-theme">
                <div class="message-widget">
                    <h1> New Blogs
                        <i class="fa fa-th-large float-right"></i>
                    </h1>
                    <ul id="messageList">
                        @if($blogs)
                            @foreach($blogs as $blog)
                                <li class="clearfix">
                                    <a href="{{ url('blog/'.$blog->blog_slug.'') }}" class="dropdown-item" target="_blank">
                                        <div class="message-box ">
                                            <div class="u-img float-left">
                                                <?php if (isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image)) { ?>
                                                    <img src="{{ asset('/public/blog_img/'.$blog->blog_image) }}">
                                                <?php } else { ?>
                                                    <img src="{{ asset('/') }}public/blog_img/no_img.jpg" >
                                                <?php } ?>
                                                <span class="notification online"></span>

                                            </div>
                                            <div class="u-text float-left">
                                                <div class="u-name">
                                                    <strong>{{$blog->blog_title}}</strong>
                                                </div>
                                                <!-- <p class="text-muted">Anyways i would like just do it</p>
 -->
                                            </div>
                                        </div>
                                        <small class="float-right">{{getDays($blog->updated_at)}}</small>
                                    </a>
                                </li>
                            @endforeach
                        @endif    
                    </ul>
                </div>
                <!-- end card-body -->
                @if(isset($blogs_count) && $blogs_count > 5)
                <div class="card-footer text-center">
                    <a href="{{ url('adminpanel/blog') }}" class="text-theme">
                        <strong>See all Blogs ({{  $blogs_count  }}) </strong>
                    </a>
                </div>
                @endif
                <!-- end card-footer -->
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
                    <h1> New Comments
                        <i class="fa fa-comments-o float-right"></i>
                    </h1>
                    <ul id="messageList">

                        @if($comments)
                            @foreach($comments as $comment)
                                <li class="clearfix">
                                    <a href="{{ url('blog/'.$comment->blog_slug.'') }}" title="{{ $comment->blog_title }}" class="dropdown-item" target="_blank">
                                        <div class="message-box ">
                                            <div class="u-img float-left">
                                                <?php if (isset($comment->blog_image) && $comment->blog_image != null && file_exists(public_path() . '/blog_img/' . $comment->blog_image)) { ?>
                                                    <img src="{{ asset('/public/blog_img/'.$comment->blog_image) }}">
                                                <?php } else { ?>
                                                    <img src="{{ asset('/') }}public/blog_img/no_img.jpg" >
                                                <?php } ?>
                                                <span class="notification online"></span>

                                            </div>
                                            <div class="u-text float-left">
                                                <div class="u-name">
                                                    <strong>Posted by {{$comment->first_name}} {{$comment->last_name}}</strong>
                                                </div>
                                                <p class="text-muted">{{ substr($comment->comments, 0, 50) . "..." }}</p>
                                            </div>
                                        </div>
                                        <small class="float-right">{{getDays($comment->created_at)}}</small>
                                    </a>
                                </li>
                            @endforeach
                        @endif    
                    </ul>
                </div>
                <!-- end card-body -->
                @if(isset($comments_count) && $comments_count > 5)
                    <div class="card-footer text-center">
                        <a href="{{ url('/adminpanel/comments') }}" class="text-theme">
                            <strong>See all Comments ({{  $comments_count  }}) </strong>
                        </a>
                    </div>
                @endif   
                <!-- end card-footer -->
            </div>
            <!-- end card -->
        </div>

    </div>

    <!-- end row -->

</div>



@endsection



@section('footer_script')





<!-- dashboard-pm -example -->

<script src="{{ url('/public/admin-assets/js/dashboard-pm-example.js') }}"></script>



@endsection