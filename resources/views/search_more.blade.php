@foreach ($blogs as $blog)
	<div class="media" data-val="<?php echo $blog['id']; ?>">
		<div class="media-left">
			@if(isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image))
			<a href="{{ url('blog/'.$blog->blog_slug) }}" target="_blank"><img src="{{ asset('/') }}public/blog_img/{{ $blog->blog_image }}" class="media-object" ></a>
			@else
			<a href="{{ url('blog/'.$blog->blog_slug) }}" target="_blank"><img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object" ></a>
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
			<a href="{{ url('blog-edit/'.$blog->blog_slug)}}" class="edit" title="Edit">
				<i class="fa fa-pencil-square"></i>
			</a>
			<a onclick="delete_blog({{ $blog->id }})" class="trash" title="Delete">
				<i class="fa fa-trash"></i>
			</a>
		</div>
	</div>
@endforeach