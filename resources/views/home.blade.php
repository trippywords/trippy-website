@extends('layouts.app')

@section('title','Home')

@section('content')

	<section>

		<div class="banner_section">

			<div class="owl-carousel owl-theme">

				<div class="item banner_one">

					<div class="container">

						<div class="row custom-row">

							<div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 custom-col">

								<div class="banner_content">

									<h1 class="banner_content_title wow fadeInUp">Modern1232 & Creative Writers we have <span class="custom_color">something</span> for you.</h1>

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

										@if(!Auth::user())

											<a href="javascript:;" title="Login" class="btn btn-default loginPopup" data-toggle="modal" data-target="#login_modal" style="cursor: pointer;">Login</a>

											<a href="javascript:;" title="Sign Up" class="btn btn-default signup" data-toggle="modal" data-target="#signup_modal" style="cursor: pointer;">Sign Up</a>

										@endif

									</div>

									<?php endif; ?>

								</div>

							</div>

							<div class="col-xl-4 offset-xl-2 col-lg-5 col-md-4 col-sm-3 custom-padding">

								<img src="{{ asset('/') }}public/assets/image/type-with-coffee.png">

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>


		<?php 
		//echo "<pre>";
		//print_r($blogs);
		

		?>
		

	</section>

	<section>
	<div class="main_content container">
				<!-- main_content -->
				<!-- block_posts block_4 -->
				<div class="block_posts block_4">
					<!-- block_inner -->
					<div class="block_inner row">
					@foreach($blogs as $blog)

						<div class="big_post col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<br><br>
							<div class="block_img_post">
								<img src="public/blog_img/{{$blog->blog_image}}" alt="">
							</div><br>
							<div class="inner_big_post">
							 <a href="#" class="btn btn-primary">{{ $blog->blog_title }}</a> 
								<br/>
								<div class="title_post"><a href="#"><h4>{{ $blog->blog_title }}</h4></a>
								</div>
								<div class="big_post_content">
									<p>{{ $blog->blog_heading }}</p>
								</div>
								<div class="post_date"><em><a href="#"><?php echo date("F j, Y",strtotime($blog->updated_at));  ?>
								</a></em>
								</div>
							</div>
						</div>
						@endforeach
						
					</div>
					<!-- // block_inner -->
						</div>
						</section>

		<section>


			<div class="container">

				<div class="posts_sidebar clearfix">
					<!--Start Posts Areaa -->
					<div class="posts_areaa col-md-7">
						<!-- posts_areaa -->
						<div class="row">
							<div class="block_posts block_1">
								<!-- block_posts block_1 -->
								<div class="featured_title">
									<!-- featured_title -->
									<div class="col-md-3 pd0">
										<h4>Business</h4>
									</div>
									<div class="col-md-9">
										<ul class="nav navbar-nav navbar-right">
											<li role="presentation"><a href="#">Enterpenuarship</a>
											</li>
											<li role="presentation"><a href="#">Startup</a>
											</li>
											<li role="presentation"><a href="#">Marketing</a>
											</li>
											<li role="presentation"><a href="#">Leadership</a>
											</li>
											<li role="presentation" class="dropdown">	<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
										  More <span class="caret"></span>
										</a>
												<ul class="dropdown-menu">
													<li role="presentation"><a href="#">Enterpenuarship</a>
													</li>
													<li role="presentation"><a href="#">Startup</a>
													</li>
													<li role="presentation"><a href="#">Marketing</a>
													</li>
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
										<div class="block_img_post">
											<!-- block_img_post -->
											<img src="public/blog_img/1525844648.jpg" alt="Use A Passage Of Lorem Ipsum">
										</div>
										<!-- // block_img_post -->
										<div class="inner_big_post">
											<!-- inner_big_post -->
											<div class="title_post">
												<!-- title_post -->	<a href="#"><h4>Use A Passage Of Lorem Ipsum</h4></a>
											</div>
											<!-- // title_post -->
											<div class="big_post_content">
												<!-- big_post_content -->
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
											</div>
											<!-- // big_post_content --> <a href="#" class="btn btn-primary">See More</a> 
										</div>
										<!-- // inner_big_post -->
									</div>
									<!-- // big_post -->
									<div class="small_list_post col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<!-- small_list_post -->
										<ul>
											<li class="small_post clearfix">
												<!-- small_post -->
												<div class="img_small_post">
													<!-- img_small_post -->
													<img src="public/blog_img/1525844648.jpg" alt="Consectetur adipisicing elit">
												</div>
												<!-- // img_small_post -->
												<div class="small_post_content">
													<!-- small_post_content -->
													<div class="title_small_post">
														<!-- title_small_post -->	<a href="#"><h5> velit esse cillum dolore eu fugiat nulla pariatur</h5></a>
													</div>
													<!-- // title_small_post -->
													<div class="post_date"><em><a href="#">July 01, 2014</a></em>
													</div>
												</div>
												<!-- // small_post_content -->
											</li>
											<!-- // small_post -->
											<li class="small_post clearfix">
												<!-- small_post -->
												<div class="img_small_post">
													<!-- img_small_post -->
													<img src="public/blog_img/1525844648.jpg" alt="Consectetur adipisicing elit">
												</div>
												<!-- // img_small_post -->
												<div class="small_post_content">
													<!-- small_post_content -->
													<div class="title_small_post">
														<!-- title_small_post -->	<a href="#"><h5>Elit Sed Do Eiusmod Tempor Incididunt</h5></a>
													</div>
													<!-- // title_small_post -->
													<div class="post_date"><em><a href="#">July 01, 2014</a></em>
													</div>
												</div>
												<!-- // small_post_content -->
											</li>
											<!-- // small_post -->
											<li class="small_post clearfix">
												<!-- small_post -->
												<div class="img_small_post">
													<!-- img_small_post -->
													<img src="public/blog_img/1525844648.jpg" alt="Consectetur adipisicing elit">
												</div>
												<!-- // img_small_post -->
												<div class="small_post_content">
													<!-- small_post_content -->
													<div class="title_small_post">
														<!-- title_small_post -->	<a href="#"><h5>incididunt ut dolore magna</h5></a>
													</div>
													<!-- // title_small_post -->
													<div class="post_date"><em><a href="#">July 01, 2014</a></em>
													</div>
												</div>
												<!-- // small_post_content -->
											</li>
											<!-- // small_post -->
											<li class="small_post clearfix">
												<!-- small_post -->
												<div class="img_small_post">
													<!-- img_small_post -->
													<img src="public/blog_img/1525844648.jpg" alt="Consectetur adipisicing elit">
												</div>
												<!-- // img_small_post -->
												<div class="small_post_content">
													<!-- small_post_content -->
													<div class="title_small_post">
														<!-- title_small_post -->	<a href="#"><h5>Consectetur Adipisicing Elit, Sed Do Eiusmod</h5></a>
													</div>
													<!-- // title_small_post -->
													<div class="post_date"><em><a href="#">July 01, 2014</a></em>
													</div>
												</div>
												<!-- // small_post_content -->
											</li>
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
										<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Latest</a>
										</li>
										<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Popular</a>
										</li>
										<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Features</a>
										</li>
										<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Trending</a>
										</li>
									</ul>
									<!-- Tab panes -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="home">
											<ul class="recent_post">
												<li>
													<figure class="widget_post_thumbnail">
														<a href="#">
															<img src="img/news/world/4.jpg" alt="Appropriately simplify quality imperatives">
														</a>
													</figure>
													<div class="widget_post_info">
														<h5><a href="#">Appropriately simplify quality imperatives</a></h5>
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
															<span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
														</div>
													</div>
												</li>
											</ul>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
															<span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
														</div>
													</div>
												</li>
											</ul>
										</div>
										<div role="tabpanel" class="tab-pane fade" id="messages">
											<ul class="recent_post">
												<li>
													<figure class="widget_post_thumbnail">
														<a href="#">
															<img src="img/news/world/4.jpg" alt="Appropriately simplify quality imperatives">
														</a>
													</figure>
													<div class="widget_post_info">
														<h5><a href="#">Appropriately simplify quality imperatives</a></h5>
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
															<span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
														</div>
													</div>
												</li>
											</ul>
										</div>
										<div role="tabpanel" class="tab-pane fade" id="settings">
											<ul class="recent_post">
												<li>
													<figure class="widget_post_thumbnail">
														<a href="#">
															<img src="img/news/world/4.jpg" alt="Appropriately simplify quality imperatives">
														</a>
													</figure>
													<div class="widget_post_info">
														<h5><a href="#">Appropriately simplify quality imperatives</a></h5>
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
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
														<div class="post_meta">	<span><a href="#"><i class="fa fa-comments-o"></i> 0 comments</a></span>
															<span class="date_meta"><a href="#"><i class="fa fa-calendar"></i> Mar 10, 2015</a></span>
														</div>
													</div>
												</li>
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

		</section>


				

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

							<img src="{{ asset('/') }}public/assets/image/about-img.png" alt="About TrippyWords">

						</div>

					</div>

				</div>

			</div>

		</div>

	

@endsection

@section('js')
@if (\Session::has('verification_message'))
	<script>
		$('#email_verification').text("{{ Session::get('verification_message') }}");
		$('#email_verification').css('display','block');
		$('#login_modal').modal('show');

	</script>
	<!-- <div class="alert alert-success">
		<ul>
			<li>{!! \Session::get('verification_message') !!}</li>
		</ul>
	</div> -->
@endif
@if (\Session::has('verification_error'))
	<script>
		$('#email_verification_error').text("{{ Session::get('verification_error') }}");
		$('#email_verification_error').css('display','block');
		$('#login_modal').modal('show');

	</script>
@endif
<script >
setTimeout(function(){
	 $("#email_verification").hide();
}, 5000 ); // 5 secs

setTimeout(function(){
	 $("#email_verification_error").hide();
}, 5000 ); // 5 secs
</script>
@endsection

	