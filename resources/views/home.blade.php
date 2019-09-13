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

									<h1 class="banner_content_title wow fadeInUp">Modern & Creative Writers we have <span class="custom_color">something</span> for you.</h1>

									<div class="top-gap-half-padding"></div>

									<?php
if (!Auth::user()):
?>

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

									<?php
endif;
?>

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
		

	</section>

<?php

	// Working with featuredBlogs JSON response
	$featuredRow = [];
	$featuredBlogsRow = json_decode($featuredBlogs, TRUE);
	if (!empty($featuredBlogsRow)) {
		$featuredRow = $featuredBlogsRow['featuredBlogs'];
	}

	// Working with featuredBlogsDetails JSON response
	// print_r($featuredBlogsDetails);
?> 

	<!-- Featured Blogs Top Row -->
	@if (count($featuredRow) >= 3)
		<div class="container section-gap-half-padding">
			<div class="featured-blogs row">
				<div class="MultiCarousel" data-items="1,3,3,3" data-slide="1" id="MultiCarousel"  data-interval="1000">
					<div class="MultiCarousel-inner">
						@foreach ($featuredRow as $blog)
							<div class="item">
								<div>
									<div class="blog-parent-genre">{{ $blog['parentGenre'] }}</div>
									<img src="public/blog_img/{{ $blog['blogImg'] }}" class="blog-img">
									<div class="blog-child-genre">{{ $blog['childGenre'] }}</div>
									<div class="blog-title">{{ $blog['title'] }}</div>
									<div class="blog-desc">{{ $blog['description'] }}</div>
								</div>
							</div>
						@endforeach
					</div>
					@if (count($featuredRow) > 3)
						<button class="btn btn-primary leftLst"><</button>
						<button class="btn btn-primary rightLst">></button>
					@endif
				</div>
			</div>
		</div>
	@endif

	

	<!-- Featured Blog Details Row -->


	<!-- About Us -->
	<div class="section-gap-half-padding about_trippywords_section">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="about_trippywords">
							<h2 class="title">About TrippyWords</h2>
							<div class="about_trippywords_tab_section">
								<div class="tab">
									<div class="tablinks active" onclick="openCity(event, 'who_are_we')" id="defaultOpen">Who Are We?</div>
									<div class="tablinks" onclick="openCity(event, 'what_we_do')">What we do?</div>
									<div class="tablinks" onclick="openCity(event, 'how_it_works')">How It Works?</div>
								</div>
								<div id="who_are_we" class="tabcontent">
									<p class="desc">
										We are Trippy Guys trying to get high on creativity.
										We're passionate about marketing and are here to help the modern and creative content writers.
										We strongly believe that 'Content is the King'.
										We realised that there is a need for a customised and structured platform where people can promote their quality content.
										This idea gave us the kick and we are serious about it.
									</p>
								</div>
								<div id="what_we_do" class="tabcontent">
									<p class="desc">
									We strongly believe in shared economy and are on the track of building a potential business channel for quality content 
									writers through our platform. We help the content writers in finding good opportunities.
									We also promote your work through different marketing channels and provide the required exposure to get new projects and 
									develop business for you.
									</p>
								</div>
								<div id="how_it_works" class="tabcontent" style="display: none;">
									<p class="desc">
										A content writer signs up with Trippy Words and posts minimum 1 blog (minimum 600 words) of any genre they like every month.
										This content would be checked for originality and plagiarism and once approved will feature on the respective genre.
										These blogs will be circulated and promoted on all social media and the credits will belong to the content creator.
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
