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

								<h1 class="banner_content_title wow fadeInUp">Modern & Creative Writers we have <span
										class="custom_color">something</span> for you.</h1>

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

									<a href="javascript:;" title="Login" class="btn btn-default loginPopup" data-toggle="modal"
										data-target="#login_modal" style="cursor: pointer;">Login</a>

									<a href="javascript:;" title="Sign Up" class="btn btn-default signup" data-toggle="modal"
										data-target="#signup_modal" style="cursor: pointer;">Sign Up</a>

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
	?>

<!-- Featured Blogs Top Row -->
@if (count($featuredRow) >= 3)
<div class="container">
	<div class="row">
		<div class="MultiCarousel" data-items="1,3,3,3" data-slide="1" id="MultiCarousel">
			<div class="MultiCarousel-inner">
				@foreach ($featuredRow as $blog)
				<a href="{{ url('blogs/'.$blog['blogId']) }}" target="_blank">
					<div class="item">
						<div class="feed-blog-container">
							<div class="feed-blog-parent-genre">{{ $blog['parentGenre'] }}</div>


							<?php if (isset($blog['blogImg']) && $blog['blogImg'] != null && file_exists(public_path() . '/blog_img/' . $blog['blogImg'])) { ?>
							<img src="{{ asset("/public/blog_img/".$blog['blogImg']) }}" class="media-object">
							<?php } else { ?>
							<img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object">
							<?php } ?>




							<!-- <img class="feed-blog-img" src="public/blog_img/{{ $blog['blogImg'] }}"> -->
							<div class="feed-blog-child-genre">{{ $blog['childGenre'] }}</div>
							<div class="feed-blog-title">{{ $blog['title'] }}</div>
							<div class="feed-blog-desc">{!! $blog['description'] !!}</div>
						</div>
					</div>
				</a>
				@endforeach
			</div>
			@if (count($featuredRow) > 3)
			<button class="btn btn-primary leftLst">
				<</button> <button class="btn btn-primary rightLst">>
			</button>
			@endif
		</div>
	</div>
</div>
@endif

<?php
		// Working with featuredBlogsDetails JSON response
		$featuredDetails = [];
		$featuredBlogsDetailsRow = json_decode($featuredBlogsDetails, TRUE);

		if(!empty($featuredBlogsDetailsRow)) {
			$featuredDetails = $featuredBlogsDetailsRow['featuredBlogsDetails'];
		}
	?>

<!-- Featured Blog Details Row -->
@if (count($featuredDetails) > 0)

@foreach ($featuredDetails as $blogDetail)
<div class="container">
	@if (!empty($blogDetail['childGenres']))
	<div class="feed-blog-details-parent">
		<div class="row">
			<div class="feed-blog-parent-genre col-md-6">{{ $blogDetail['parentGenre'] }}</div>
			<ul class="nav nav-pills feed-blog-details-child-genres col-md-6">
				@foreach ($blogDetail['childGenres'] as $genrekey => $childBlogs)
				<li class="{{ $genrekey == 0 ? 'active' : '' }}">
					<a href="{{ '#'.kebab_case(preg_replace('/[^a-zA-Z]/', '', $blogDetail['parentGenre'])).'-'.kebab_case(preg_replace('/[^a-zA-Z]/', '', $childBlogs['childgenre'])) }}"
						data-toggle="tab">{{ $childBlogs['childgenre'] }}</a>
				</li>
				@endforeach
			</ul>
		</div>
		<div class="tab-content">
			@foreach ($blogDetail['childGenres'] as $genrekey => $childBlogs)
			<div
				id="{{ kebab_case(preg_replace('/[^a-zA-Z]/', '', $blogDetail['parentGenre'])).'-'.kebab_case(preg_replace('/[^a-zA-Z]/', '', $childBlogs['childgenre'])) }}"
				class="{{ $genrekey == 0 ? 'row tab-pane active' : 'row tab-pane' }}">
				@foreach ($childBlogs['blogs'] as $blogkey => $blog)
				@if ($blogkey == 0)
				<div class="col-md-4">
					<a href="{{ url('blogs/'.$blog['blogId']) }}" target="_blank">
						<div class="feed-blog-container feed-blog-detail-container">


							<?php if (isset($blog['blogImg']) && $blog['blogImg'] != null && file_exists(public_path() . '/blog_img/' . $blog['blogImg'])) { ?>
							<img src="{{ asset("/public/blog_img/".$blog['blogImg']) }}" class="media-object">
							<?php } else { ?>
							<img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object">
							<?php } ?>


							<!-- <img class="feed-blog-img" src="public/blog_img/{{ $blog['blogImg'] }}"> -->
							<div class="feed-blog-title">{{ $blog['title'] }}</div>
							<div class="feed-blog-author">
								Posted by {{ $blog['authorInfo'] }} | {{ date('F d, Y', strtotime($blog['createdAt'])) }}
							</div>
							<div class="feed-blog-desc">{!! str_limit($blog['description'], $limit = 25, $end = '...') !!}</div>
							<div class="feed-blog-child-genre">READ MORE</div>
						</div>
					</a>
				</div>
				<div class="col-md-8 feed-mini-margin">
					<div class="row">
						@else
						<div class="col-md-6">
							<a href="{{ url('blogs/'.$blog['blogId']) }}" target="_blank">
								<div class="feed-blog-mini-container">

									<?php if (isset($blog['blogImg']) && $blog['blogImg'] != null && file_exists(public_path() . '/blog_img/' . $blog['blogImg'])) { ?>
									<img class="feed-blog-mini-img" src="{{ asset("/public/blog_img/".$blog['blogImg']) }}"
										class="media-object ">
									<?php } else { ?>
									<img class="feed-blog-mini-img" src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object">
									<?php } ?>




									<!-- <img class="feed-blog-mini-img" src="{{ asset('/') }}public/blog_img/no_img.jpg" alt="About TrippyWords"> -->
									<div class="feed-blog-mini-detail">
										<div class="feed-blog-title">{{ $blog['title'] }}</div>
										<div class="feed-blog-author">Posted by {{ $blog['authorInfo'] }}</div>
										<div class="feed-blog-time">
											<img src="public/assets/image/timer-icon.png" class="feed-timer-icon" />
											{{ date('F d, Y', strtotime($blog['createdAt'])) }}
										</div>
									</div>
								</div>
							</a>
						</div>
						@endif
						@endforeach
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
@endforeach
@endif



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
								We realised that there is a need for a customised and structured platform where people can promote their
								quality content.
								This idea gave us the kick and we are serious about it.
							</p>
						</div>
						<div id="what_we_do" class="tabcontent">
							<p class="desc">
								We strongly believe in shared economy and are on the track of building a potential business channel for
								quality content
								writers through our platform. We help the content writers in finding good opportunities.
								We also promote your work through different marketing channels and provide the required exposure to get
								new projects and
								develop business for you.
							</p>
						</div>
						<div id="how_it_works" class="tabcontent" style="display: none;">
							<p class="desc">
								A content writer signs up with Trippy Words and posts minimum 1 blog (minimum 600 words) of any genre
								they like every month.
								This content would be checked for originality and plagiarism and once approved will feature on the
								respective genre.
								These blogs will be circulated and promoted on all social media and the credits will belong to the
								content creator.
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
<script>
	setTimeout(function(){
	 $("#email_verification").hide();
}, 5000 ); // 5 secs

setTimeout(function(){
	 $("#email_verification_error").hide();
}, 5000 ); // 5 secs
</script>
@endsection