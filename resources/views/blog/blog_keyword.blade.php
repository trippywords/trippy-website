@extends('layouts.app')
@section('title',ucwords($key))
@section('content')
<section>
	<div class="profile_page">
		<div class="container">
			<div class="row">
			@if(Auth::user())
				@include('partials.sidebar')
				<div class="col-lg-8 col-md-7">
				@else
				<div class="col-lg-12 col-md-7">
				@endif
					<div class="profile_page_main_section">
						<div class="profile_main_title_section">
							
							<h2 class="title">
								<i class="fa fa-search"></i>
								Search Result for <b>"{{ $blogTitle }}"</b>
							</h2>
							<h4 class="title">Search result {{ count($blogs) }}</h4>
							<input type="hidden" id="search_title" name="search_title" value="{{ $blogTitle }}">
							<!-- <a href="javascript:;" class="edit_icon show_edit_section" title="edit">
								<i class="fa fa-edit"></i>
								Edit
							</a> -->
						</div>
						
			   			<div class="profile_main_section no-padding" id="searced_blogs">
							@if(count($blogs) > 0)
							@foreach ($blogs as $blog)
							<div class="media" data-val="<?php echo $blog['id']; ?>">
								<div class="media-left">
									@if(!empty(isset($blog->blog_image)?$blog->blog_image:""))
									<a href="{{ url('blog',isset($blog->blog_slug)?($blog->blog_slug):'')}}" target="_blank"><img src="{{ asset('/') }}public/blog_img/{{ $blog->blog_image }}" class="media-object"></a>
									@else
									<a href="{{ url('blog',isset($blog->blog_slug)?($blog->blog_slug):'')}}" target="_blank"><img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object"></a>
									@endif
								</div>
								<div class="media-body">
									<h4 class="media-heading"><a href="{{ url('blog',isset($blog->blog_slug)?($blog->blog_slug):'')}}" target="_blank">{{ isset($blog->blog_title)?$blog->blog_title:'' }}</a></h4>
									<p class="media-content">@php echo strip_tags(str_limit(isset($blog->blog_description)?$blog->blog_description:"", 200)) @endphp</p>
									<?php
	                                    $genre_name= "";
	                                    if(!empty($blog->blog_genre)){
	                                        $genre = DB::table('genres')->where('id',$blog->blog_genre)->first();
	                                        $genre_name = $genre->name;
	                                    }
	                                    
                                    ?>
									<div class="media-sub-content">Genre:  {{ $genre_name }}</div>
								</div>
							</div>
							@endforeach
							@else
							<div class="profile_main_section no_any_content d-flex align-items-center justify-content-center">
								<span>
									<img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
								</span>
								<p class="content_text">Awww ! no blogs. Write now <span>Just click on button</span></p>
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