@foreach ($publish_blogs as $blog)

<div class="media" data-val="<?php echo $blog['id']; ?>">

	<div class="media-left">

		@if($blog->blog_image!='')

                <a href="blog/{{ $blog->blog_slug }}"><img src="public/blog_img/{{ $blog->blog_image }}" class="media-object"></a>

		@else

		<img src="public/blog_img/blog-2.jpg" class="media-object">

		@endif

	</div>

	<div class="media-body">

		<h4 class="media-heading"><a href="blog/{{ $blog->blog_slug }}">{{ $blog->blog_title }}</a></h4>

		<p class="media-content">{{ strip_tags($blog->blog_description) }}</p>

		<div class="media-sub-content">Genre:  Design, Illustration</div>

	</div>

	<div class="media-edit" style="display: none;">

		<a href="blog-edit/{{ $blog->blog_slug }}" class="edit" title="Edit">

			<i class="fa fa-pencil-square"></i>

		</a>

		<a onclick="delete_blog({{ $blog->id }})" class="trash" title="Delete">

			<i class="fa fa-trash"></i>

		</a>

	</div>

</div>

@endforeach