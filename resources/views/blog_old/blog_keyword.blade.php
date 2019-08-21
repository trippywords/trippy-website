@extends('layouts.app')
@section('title',ucwords($keyword))
@section('content')

<section>

	<div class="profile_page">

		<div class="container">

			<div class="row">
			
				<div class="col-lg-4 col-md-5">
					<div class="categories-list-main">
						<h3 class="categories-list-title">Genre</h3>
						<ul class="categories-list-section">
							@foreach($user_genere_details as $gen)
							<li class="categories-list categories-list-hover">
								<a href="{{url('genre/blog',getParentGenreSlug($gen->id))}}" title="Image posts" target="_blank" class="categories">{{ getParentGenreInfo($gen->id)}}</a>
							</li>
							@endforeach
						</ul>
					</div>
				</div>

				<div class="col-lg-8 col-md-7">
					<div class="profile_page_main_section">
						
						<!-- start -->
						<div class="profile_main_title_section">
							
							<h2 class="title">
								<!-- <i class="fa fa-search"></i> -->
								Blog list for <b>"{{ $keyword}}"</b>
							</h2>
							<!-- <h4 class="title">Search result</h4> -->
							<input type="hidden" id="search_title" name="search_title" value="{{ $keyword}}">
							<!-- <a href="javascript:;" class="edit_icon show_edit_section" title="edit">
								<i class="fa fa-edit"></i>
								Edit
							</a> -->
						</div>
						<!-- end -->

			   			<div class="profile_main_section no-padding" id="searced_blogs">

							@if(count($blogs) > 0)

							@foreach ($blogs as $blog)

							<div class="media" data-val="<?php echo $blog['id']; ?>">

								<div class="media-left">

									@if(!empty(isset($blog->blog_image)?$blog->blog_image:""))

									<a href="{{ $blog->blog_slug }}"><img src="{{ asset('/') }}public/blog_img/{{ $blog->blog_image }}" class="media-object"></a>

									@else

									<a href="{{isset($blog->blog_slug)?$blog->blog_slug:''}}"><img src="{{ asset('/') }}public/blog_img/blog-2.jpg" class="media-object"></a>

									@endif

								</div>

								<div class="media-body">

									<h4 class="media-heading"><a href="{{ url('blog',isset($blog->blog_slug)?($blog->blog_slug):'')}}" target="_blank">{{ isset($blog->blog_title)?$blog->blog_title:'' }}</a></h4>

									<p class="media-content">@php echo strip_tags(str_limit(isset($blog->blog_description)?$blog->blog_description:"", 200)) @endphp</p>

									<!--<div class="media-sub-content">Genre:  Design, Illustration</div>-->

								</div>

							</div>

							@endforeach

							@else

							<div class="profile_main_section no_any_content d-flex align-items-center justify-content-center">
								<span>
									<img src="{{ asset('/') }}public/blog_img/no-blog.png"  height="100px" widht="100px" >

								</span>

								<p class="content_text">Awww ! no blogs.</p>

							</div>

							@endif

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

@endsection