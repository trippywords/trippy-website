@extends('layouts.app')
@section('title','Search result for '.$blogTitle)
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
							<h4 class="title">Search result {{$searchCount}}</h4>
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
									@if(isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image))
									<a href="{{ url('blog/'.$blog->blog_slug) }}" target="_blank"><img src="{{ asset('/') }}public/blog_img/{{ $blog->blog_image }}" target="_blank" class="media-object"></a>
									@else
									<a href="{{ url('blog/'.$blog->blog_slug) }}" target="_blank"><img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object"></a>
									@endif
								</div>
								<div class="media-body">
									<h4 class="media-heading"><a href="{{ url('blog/'.$blog->blog_slug) }}" target="_blank">{{ $blog->blog_title }}</a></h4>
									<p class="media-content">@php echo strip_tags(str_limit($blog->blog_description, 200)) @endphp</p>
									<?php
	                                    $genre_name= "";
	                                    if(!empty($blog->blog_genre)){
	                                        $genre = DB::table('genres')->where('id',$blog->blog_genre)->first();
	                                        $genre_name = $genre->name;
	                                    }
	                                    
                                    ?>
									<div class="media-sub-content">Genre:  {{ $genre_name }}</div>
									<!--<div class="media-sub-content">Genre:  Design, Illustration</div>-->
								</div>
								<div class="media-edit" style="display: none;">
									<a href="{{ url('blog-edit/'.$blog->blog_slug) }}" class="edit" title="Edit">
										<i class="fa fa-pencil-square"></i>
									</a>
									<a onclick="delete_blog({{ $blog->id }})" class="trash" title="Delete">
										<i class="fa fa-trash"></i>
									</a>
								</div>
							</div>
							@endforeach
							@else
							<div class="profile_main_section no_any_content d-flex align-items-center justify-content-center">
								<span>
									<img src="{{ asset('/') }}public/blog_img/no-blog.png" height="100px" widht="100px" >
								</span>
								<p class="content_text">Awww ! We couldn't find any results for <b>{{ $blogTitle }}</b> </p>
							</div>
							@endif
						</div>
						<div class="ajax-load text-center" style="display:none">
							<p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
						</div>
						@if($searchCount > 4)
						<div class="blog_button">
							<input type="hidden" name="searchCount" id="searchCount" value="{{$searchCount}}">
							<a href="javascript:;" class="btn btn-primary" id="load_more" title="Load More">
								LOAD MORE
							</a>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">             
	$(document).ready(function(){ 
		var page = 1;
		$("#load_more").click(function(){
			window.history.pushState("", "", url);
			page++;
			var total = $("searchCount").val();
			var dtotal = 5 * page;
			$.ajax({
				// url: '?page=' + page,
				type: "post",
				data:{
					'title' : $.trim($('#search_title').val()),
					'page':page,
					'_token':$('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function()
				{
					$('.ajax-load').show();
				}
			})
			.done(function(data)
			{
				if(data.html == ""){
					$("#load_more").hide();
					$('.ajax-load').html("No more blogs found");
					return;
				}
				$('.ajax-load').hide();
				$("#searced_blogs").append(data.html);
				if (dtotal >= total) {
					$("#load_more").hide();
				}
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
				  alert('server not responding...');
			});
		});
	});
	
</script>
@endsection
