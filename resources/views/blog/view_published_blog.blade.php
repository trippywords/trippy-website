<?php if (count($publish_blogs)) { ?>
	@foreach ($publish_blogs as $blog)

	<div class="media" data-val="<?php echo $blog->id; ?>">

		<div class="media-left">

			@if(isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image))
	            <a href="{{ url('blog/'.$blog->blog_slug) }}" target="_blank"><img src="{{ asset("/public/blog_img/".$blog->blog_image) }}" class="media-object"></a>
			@else
				<a href="{{ url('blog/'.$blog->blog_slug) }}" target="_blank"><img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object"></a>
			@endif

		</div>

		<div class="media-body">

			<h4 class="media-heading"><a href="{{ url('blog/'.$blog->blog_slug) }}" target="_blank">{{ $blog->blog_title }}</a></h4>
			<?php $content = preg_replace("/<img[^>]+\>/i", " ", $blog->blog_description); 
			$content = preg_replace("/<video[^>]+\>/i", " ", $content); 
			$content = str_replace("Your browser does not support HTML5 video.",'', $content); 
			$content = strip_tags($content); 
			if (isset($content) && trim($content)=='') {
				$content = 'Trippy Words';
			} ?>
			<p class="media-content">@php echo substr($content, 0,200) @endphp</p>
			<?php
	            $genre_name= "";
	            if(!empty($blog->blog_genre)){
	                $genre = DB::table('genres')->where('id',$blog->blog_genre)->first();
	            }
	            $genre_name = $genre->name;
	        ?>
			<div class="media-sub-content">Genre:  {{ $genre_name }}</div>

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
	<div class="load_more_blog">
	    <div class="ajax-load text-center" style="display:none" id="ajax-load-blogs">
	        <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
	    </div>
	    @if(isset($publish_total) && intval($publish_total) > 0)
	        <div class="blog_button">
	            <a href="javascript:;" class="btn btn-primary" id="loadmore" title="Load More" data-page="{{ $page }}">
	                LOAD MORE
	            </a>
	        </div>
	    @endif
	</div>
<?php }else{ ?>
    <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center" style="background-color:#fff !important;">
        <span>
            <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
        </span>
            <p class="content_text">Awww ! no blog. Write now <span>Just click on edit</span></p>
    </div>
<?php } ?>