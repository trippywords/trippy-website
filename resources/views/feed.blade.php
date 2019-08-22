<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/feed_assets/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/feed_assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/feed_assets/css/bootstrap-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/feed_assets/css/font-awesome.min.css') }}">
    
    <!-- Javascript
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script type="text/javascript" src="{{URL::asset('public/feed_assets/js/jquery.v2.1.3.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('public/feed_assets/js/bootstrap.min.js') }}"></script>
</head>
<title>Trippy Feeds</title>

<body>
    <!-- News Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

  
    <div class="all_content news_layout animsition container-fluid">
        <div class="row">
            <div class="slider_and_box">
                <div class="mian_slider clearfix container">
                    <!--Start Mian slider -->
                    <div class="big_silder col-md-8">
                        <!-- Start big silder -->
                        <div class="row">
                            <h1 style="color: #fff;">Trippy Feed</h1>
                        </div>
                    </div>
                    <!-- End big silder -->
                    <div class="post_box col-md-4">
                        <!--Start Post box -->
                        <div class="row"></div>
                    </div>
                    <!--End Post box -->
                </div>
                <!--End Mian slider -->
            </div>
            <!-- –––––––––––––––––––––––––––––––––––––––––––––––––– -->

            <?php 
             print_r($data);

            ?>
            <div class="main_content container">
                <!-- main_content -->
                <!-- block_posts block_4 -->
                <div class="block_posts block_4">
                    <!-- block_inner -->
                    <div class="block_inner row">
                    @foreach($recommeded_blogs as $recommended)
                        <div class="big_post col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <a href="{{route('feed.showSingleBlog',$recommended->id)}}">
                            <div class="block_img_post">
                                <img src="public/blog_img/{{$recommended->blog_image}}" alt="">
                            </div>
                        </a>    
                            <div class="inner_big_post"> <a href="{{route('feed.showSingleBlog',$recommended->id)}}" class="btn btn-primary">{{ $recommended->blog_title}}</a> 
                                <br/>
                                <div class="title_post"><a href="{{route('feed.showSingleBlog',$recommended->id)}}"><h4>{{ $recommended->blog_heading}}</h4></a>
                                </div>
                                <a href="{{route('feed.showSingleBlog',$recommended->id)}}">
                                <div class="big_post_content">
                                <p>{{ strip_tags(str_limit($recommended->blog_description, $limit = 150, $end = '...')) }}</p>
                                    
                                </div>
                                </a>
                                <div class="post_date"><em><a href="{{route('feed.showSingleBlog',$recommended->id)}}"><?php echo date("F j, Y",strtotime($recommended->updated_at));  ?></a></em>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="big_post col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="block_img_post">
                                <img src="img/news/world/8.jpg" alt="Use A Passage Of Lorem Ipsum">
                            </div>
                            <div class="inner_big_post">    <a href="#" class="btn btn-primary">Lifestyle</a> 
                                <br/>
                                <div class="title_post"><a href="#"><h4>velit esse cillum dolore eu fugiat nulla pariatur</h4></a>
                                </div>
                                <div class="big_post_content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
                                </div>
                                <div class="post_date"><em><a href="#">July 01, 2014</a></em>
                                </div>
                            </div>
                        </div>
                         <div class="big_post col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="block_img_post">
                                <img src="img/news/world/8.jpg" alt="Use A Passage Of Lorem Ipsum">
                            </div>
                            <div class="inner_big_post">    <a href="#" class="btn btn-primary">Travel</a> 
                                <br/>
                                <div class="title_post"><a href="#"><h4>velit esse cillum dolore eu fugiat nulla pariatur</h4></a>
                                </div>
                                <div class="big_post_content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
                                </div>
                                <div class="post_date"><em><a href="#">July 01, 2014</a></em>
                                </div>
                            </div>
                        </div>  -->
                    </div>
                    <!-- // block_inner -->
                </div>
                <!-- // block_posts block_4 -->
                <!-- –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <div class="posts_sidebar clearfix">
                    <!--Start Posts Areaa -->
                    <div class="posts_areaa col-md-7">
                        <!--ed posts_areaa -->
                        <div class="row">
                            <div class="block_posts block_1">
                                <!-- block_posts block_1 -->
                                <div class="featured_title">
                                    <!-- featured_title -->
                                    @foreach($parentGenre as $parent)
                                    <div class="col-md-3 pd0">
                                        <h4>{{$parent->name}}</h4>
                                    </div>
                                    @endforeach
                                    <div class="col-md-9">
                                        <ul class="nav navbar-nav navbar-right">
                                        
                                        
                                        @for($i=0;$i<=2;$i++)
                                            <li role="presentation"><a href="{{route('feed.showMultiBlog',$childGenre[$i]->id)}}">{{$childGenre[$i]->name}}</a>
                                            </li>
                                          @endfor 
                                            <!-- <li role="presentation"><a href="#">Startup</a>
                                            </li>
                                                <li role="presentation"><a href="#">Marketing</a>
                                            </li>
                                            <li role="presentation"><a href="#">Leadership</a>
                                            </li> -->
                                            <li role="presentation" class="dropdown">   <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                          More <span class="caret"></span>
                                        </a>
                                        
                                                  
                                           <!-- <?php

                                           //echo $nextChildCount;
                                           ?> -->
                                                <ul class="dropdown-menu">
                                                 @for($j=0; $j<=14; $j++)
                                                    <li role="presentation"><a href="{{route('feed.showMultiBlog',$nextChild[$j]->id)}}">
                                                    {{ $nextChild[$j]->name }}
                                                    </a>
                                                    </li>
                                                    @endfor
                                                   <!--  <li role="presentation"><a href="#">Startup</a>
                                                    </li>
                                                    <li role="presentation"><a href="#">Marketing</a>
                                                    </li> -->
                                                </ul>
                                                
                                            </li>
                                        </ul>
                                        
                                    </div>
                                </div>
                                <!-- // featured_title -->
                                <div class="block_inner row">
                                    <!-- block_inner -->
                                    <div class="big_post col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <!-- big_post -->
                                        @for($i=0;$i<=0;$i++)
                                        <div class="block_img_post">
                                            <!-- block_img_post -->
                                            <a href="{{route('feed.showSingleBlog',$genre_blog[$i]->id)}}">
                                            <img src="public/blog_img/{{$genre_blog[$i]->blog_image}}" alt="Use A Passage Of Lorem Ipsum"></a>
                                        </div>
                                        <!-- // block_img_post -->
                                        <div class="inner_big_post">
                                            <!-- inner_big_post -->
                                            <div class="title_post">
                                                <!-- title_post --> 
                                            <a href="{{route('feed.showSingleBlog',$genre_blog[$i]->id)}}"><h4>{{$genre_blog[$i]->blog_title}}</h4></a>
                                            </div>
                                            <!-- // title_post -->
                                            <div class="big_post_content">
                                                <!-- big_post_content -->
                                                <a href="{{route('feed.showSingleBlog',$genre_blog[$i]->id)}}">

                                                <p>{{ strip_tags(str_limit($genre_blog[$i]->blog_description, $limit = 150, $end = '...')) }}</p>
                                                </a>
                                            </div>
                                            <!-- // big_post_content --> <a href="{{route('feed.showSingleBlog',$genre_blog[$i]->id)}}" class="btn btn-primary">See More</a> 
                                        </div>
                                        <!-- // inner_big_post -->
                                    </div>
                                    @endfor
                                    <!-- // big_post -->
                                    <div class="small_list_post col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <!-- small_list_post -->
                                        <ul>
                                        @for($i=0;$i<=3;$i++)
                                            <li class="small_post clearfix">
                                                <!-- small_post -->
                                                <a href="{{route('feed.showSingleBlog',$genre_blog[$i]->id)}}">
                                                <div class="img_small_post">
                                                    <!-- img_small_post -->

                                                    <img src="public/blog_img/{{$genre_blog[$i]->blog_image}}" alt="Consectetur adipisicing elit">
                                                </div>
                                                </a>
                                                <!-- // img_small_post -->
                                                <div class="small_post_content">
                                                    <!-- small_post_content -->
                                                    <div class="title_small_post">
                                                        <!-- title_small_post -->   <a href="{{route('feed.showSingleBlog',$genre_blog[$i]->id)}}"><h5> {{$genre_blog[$i]->blog_heading}}</h5></a>
                                                    </div>
                                                    <!-- // title_small_post -->
                                                    <div class="post_date"><em><a href="{{route('feed.showSingleBlog',$genre_blog[$i]->id)}}"><?php echo date("F j, Y",strtotime($genre_blog[$i]->created_at));  ?></a></em>
                                                    </div>
                                                </div>
                                                <!-- // small_post_content -->
                                            </li>
                                            @endfor
                                            <!-- // small_post -->
                                            <!-- <li class="small_post clearfix">
                                               
                                                <div class="img_small_post">
                                                   
                                                    <img src="img/news/featured-slider/10.jpg" alt="Consectetur adipisicing elit">
                                                </div>
                                                
                                                <div class="small_post_content">
                                                    
                                                    <div class="title_small_post">
                                                           <a href="#"><h5>Elit Sed Do Eiusmod Tempor Incididunt</h5></a>
                                                    </div>
                                                    
                                                    <div class="post_date"><em><a href="#">July 01, 2014</a></em>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                           
                                            <li class="small_post clearfix">
                                               
                                                <div class="img_small_post">
                                                    
                                                    <img src="img/news/posts-block/4.jpg" alt="Consectetur adipisicing elit">
                                                </div>
                                               
                                                <div class="small_post_content">
                                                    
                                                    <div class="title_small_post">
                                                           <a href="#"><h5>incididunt ut dolore magna</h5></a>
                                                    </div>
                                                    
                                                    <div class="post_date"><em><a href="#">July 01, 2014</a></em>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            
                                            <li class="small_post clearfix">
                                               
                                                <div class="img_small_post">
                                                   
                                                    <img src="img/news/featured-slider/5.jpg" alt="Consectetur adipisicing elit">
                                                </div>
                                                
                                                <div class="small_post_content">
                                                    
                                                    <div class="title_small_post">
                                                         <a href="#"><h5>Consectetur Adipisicing Elit, Sed Do Eiusmod</h5></a>
                                                    </div>
                                                    
                                                    <div class="post_date"><em><a href="#">July 01, 2014</a></em>
                                                    </div>
                                                </div>
                                               
                                            </li>
                                             -->
                                            <!-- // small_post -->
                                        </ul>
                                    </div>
                                    <!-- // small_list_post -->
                                </div>
                                <!-- // block_inner -->
                            </div>
                            <!-- // block_posts block_1 -->
                        </div>
                    </div>
                    <!--End Posts Areaa -->
                    <!-- –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                    

                    <div class="sidebar col-md-5">
                        <!--Start Sidebar -->
                        <div class="row">
                            <div class="inner_sidebar">
                                <!--Start Inner Sidebar -->
                                <div class="widget widget_recent_post">
                                    <!-- Start widget recent post -->
                                    <!--<h4 class="widget_title">Recent Post</h4>-->
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#latest" aria-controls="latest" role="tab" data-toggle="tab">Latest</a>
                                        </li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Popular</a>
                                        </li>
                                        <li role="presentation"><a href="#featured" aria-controls="featured" role="tab" data-toggle="tab">Features</a>
                                        </li>
                                        <li role="presentation"><a href="#trending" aria-controls="trending" role="tab" data-toggle="tab">Trending</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="latest">
                                            <ul class="recent_post">
                                            @foreach($latests as $latest)
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="{{route('feed.showSingleBlog',$latest->id)}}">
                                                            <img src="public/blog_img/{{$latest->blog_image}}" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                        <div class="widget_post_info">
                            <h5><a href="{{route('feed.showSingleBlog',$latest->id)}}">{{ $latest->blog_heading}}</a></h5>

                            <div class="post_meta"> 
                            <span>
                            <a href="{{route('feed.showSingleBlog',$latest->id)}}"{{route('feed.showSingleBlog',$latest->id)}}><i class="fa fa-comments-o"></i> {{$latest->count}} comments</a>
                            </span>
                                <span class="date_meta"><a href="{{route('feed.showSingleBlog',$latest->id)}}"><i class="fa fa-calendar"></i> <?php echo date("F j, Y",strtotime($latest->created_at));  ?></a></span>
                            </div>
                        </div>
                         </li>
                        @endforeach
                                               <!--  <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/3.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/1.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/2.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul> -->
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <ul class="recent_post">
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/4.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/3.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/1.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/2.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div role="tabpanel" class="tab-pane fade" id="featured">
                                            <ul class="recent_post">
                                            @foreach($featured as $feature)
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="{{route('feed.showSingleBlog',$feature->id)}}">
                                                            <img src="public/blog_img/{{$feature->blog_image}}" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="{{route('feed.showSingleBlog',$feature->id)}}">{{ $feature->blog_heading }}</a></h5>
                                                        <div class="post_meta"> <span><a href="{{route('feed.showSingleBlog',$feature->id)}}"><i class="fa fa-comments-o"></i> {{ $feature->count }} comments</a></span>
                                                            <span class="date_meta"><a href="{{route('feed.showSingleBlog',$feature->id)}}"><i class="fa fa-calendar"></i> <?php echo date("F j, Y",strtotime($feature->created_at));  ?></a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach;
                                                <!-- <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/3.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/1.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/2.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>-->
                                        </div> 
                                        <div role="tabpanel" class="tab-pane fade" id="trending">
                            <ul class="recent_post">
                            @foreach($trending as $trend)
                                <li>
                                    <figure class="widget_post_thumbnail">
                                        <a href="{{route('feed.showSingleBlog',$trend->id)}}">
                                            <img src="public/blog_img/{{$trend->blog_image}}" alt="Appropriately simplify quality imperatives">
                                        </a>
                                    </figure>
                                    <div class="widget_post_info">
                                        <h5><a href="{{route('feed.showSingleBlog',$trend->id)}}">{{$trend->blog_heading}}</a></h5>
                                        <div class="post_meta"> <span><a href="{{route('feed.showSingleBlog',$trend->id)}}"><i class="fa fa-comments-o"></i> {{ $trend->count }}  comments</a></span>
                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> <?php echo date("F j, Y",strtotime($trend->created_at));  ?></a></span>
                                        </div>
                                    </div>
                                </li>
                                 @endforeach
                                                <!-- <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/3.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/1.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure class="widget_post_thumbnail">
                                                        <a href="#">
                                                            <img src="img/news/world/2.jpg" alt="Appropriately simplify quality imperatives">
                                                        </a>
                                                    </figure>
                                                    <div class="widget_post_info">
                                                        <h5><a href="#">Appropriately simplify quality imperatives</a></h5>
                                                        <div class="post_meta"> <span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
                                                            <span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
                                                        </div>
                                                    </div>
                                                </li> -->
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                                <!-- End widget recent post -->
                            </div>
                            <!--End Inner Sidebar -->
                        </div>
                    </div>
                    <!--End Sidebar -->
                </div>
                <!-- Posts And Sidebar -->
            </div>
            <!-- main_content -->
        </div>
        <!-- End row -->
    </div>
    <!-- End all_content -->

</body>
</html>