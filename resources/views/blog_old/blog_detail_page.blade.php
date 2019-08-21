	@extends('layouts.app')
	@section('content')

	<!-- main.css | /* Inner Banner Section S */ -->
	<section>
		<div class="inner-banner blog_page_banner">
		</div>
	</section>

	<!-- main.css | /* Blog Page Section S */ -->
	<section>
		<div class="blog_page">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-8">
						<div class="blog_main_section">
							<div class="blog_slider" style="display: none">
								<div class="owl-carousel owl-theme">
									<div class="item blog_slide">
										
									</div>	
									<div class="item blog_slide">
										
									</div>	
									<div class="item blog_slide">
										
									</div>	
								</div>
								
							</div>

							<div class="blog_section">
								<div class="blog_title">
									<h2 class="title">
										<?php if($blog_details!=null && $blog_details->blog_title!=null){ ?>
											{{ $blog_details->blog_title }}
										<?php } ?>
									</h2>
								</div>
								<div class="blog_sub_title">
									<div class="author blog_subtitle_div">
										BY <?php
										if( $blog_details!=null && $blog_details->created_by!=null)
										{
											echo App\User::where('id','=',$blog_details->created_by)->first()->name;
										}
										?>
									</div>
									<div class="like_section blog_subtitle_div">
										<span class="icon">
											<i class="fa fa-heart-o"></i>
										</span>
										<span class="likes">0 LIKES</span>
									</div>
									<div class="comment_section blog_subtitle_div">
										<span class="icon">
											<i class="fa fa-commenting-o"></i>
										</span>
										<span class="commnets"><?php echo getCommentscount($blog_details->id); ?> COMMENTS</span>
									</div>
								</div>
								<div class="blog_content">
									
									<p class="blogs">
										@php echo html_entity_decode($blog_details->blog_description) @endphp
									</p>
									<p class="blogs quoted">
										{{ '"'.$blog_details->blog_heading.'"' }}
									</p>
									
								</div>
								<div class="share_button text-right">
									<a href="javascript:;" title="Share">
										<i class="fa fa-share-alt"></i>
									</a>
								</div>
							</div>

							<div class="form_section">
								<div class="form_title">Leave a reply</div>
								@if (count($errors) > 0)
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
								@endif
								<form action="{{ route('saveblogcomment') }}" method="post">
									<div class="row">
										
										<div class="col-md-12">
											<div class="form-group">
												<textarea class="form-control" placeholder="COMMENTS" rows="5" name="comments" required=""></textarea>
											</div>
										</div>
										<div class="button_section">
											@csrf
											<input type="hidden" value="{{ $blog_details->id }}" name="blog_id" />                                                                                    
											<input type="hidden" value="{{ $blog_details->blog_slug }}" name="blog_slug" /> 
											<button type="submit" value="submit" class="btn btn-primary">SUBMIT</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4">
						<div class="blog_side_section">
							<div class="blog_side_section_title">
								<h3 class="title">Categories</h3>
								<ul class="blog_category">
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="Photography">
											<span class="blog_category_text">Photography</span>
											<span class="blog_category_number">(10)</span>
										</a>
									</li>
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="Design">
											<span class="blog_category_text">Design</span>
											<span class="blog_category_number">(03)</span>
										</a>
									</li>
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="Music">
											<span class="blog_category_text">Music</span>
											<span class="blog_category_number">(12)</span>
										</a>
									</li>
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="Fashion">
											<span class="blog_category_text">Fashion</span>
											<span class="blog_category_number">(05)</span>
										</a>
									</li>
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="Photoshop">
											<span class="blog_category_text">Photoshop</span>
											<span class="blog_category_number">(02)</span>
										</a>
									</li>
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="Articles">
											<span class="blog_category_text">Articles</span>
											<span class="blog_category_number">(19)</span>
										</a>
									</li>
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="Video">
											<span class="blog_category_text">Video</span>
											<span class="blog_category_number">(08)</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="blog_side_section">
							<div class="blog_side_section_title">
								<h3 class="title">Recent Posts</h3>
								@foreach(getRecentToppost() as $recentblog)
								<ul class="blog_category">
									<li class="blog_category_list">
										<div class="media">
											<div class="media-left">
												<a href="{{ url("blog/".$recentblog->blog_slug) }}" class="media-heading" title="">
													<?php if($recentblog->blog_image!=null) { ?>
														<img src="{{ asset("/public/blog_img/".$recentblog->blog_image) }}" alt="Post" />
													<?php }else{ ?>
														<img src="{{ asset("/public/blog_img/blog-2.jpg") }}" alt="Post" />
													<?php } ?>
												</a>
											</div>
											<div class="media-body">
												<a href="{{ url("blog/".$recentblog->blog_slug) }}" class="media-heading" title="">
													&nbsp;&nbsp;{{ $recentblog->blog_title }} 
												</a>
												<span class="post_date">
													&nbsp;&nbsp;<?php echo date("F j, Y",strtotime($recentblog->created_at));  ?>
												</span>
											</div>
										</div>
									</li>
									
								</ul>
								@endforeach
							</div>
						</div>
						<div class="blog_side_section">
							<div class="blog_side_section_title">
								<h3 class="title">Archives</h3>
								<ul class="blog_category">
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="February 2015">
											<span class="blog_category_text">February 2015</span>
											<span class="blog_category_number">(10)</span>
										</a>
									</li>
									<li class="blog_category_list category_list">
										<a href="javascript:;" class="active" title="March 2015">
											<span class="blog_category_text">March 2015</span>
											<span class="blog_category_number">(03)</span>
										</a>
									</li>
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="April 2015">
											<span class="blog_category_text">April 2015</span>
											<span class="blog_category_number">(12)</span>
										</a>
									</li>
									<li class="blog_category_list category_list">
										<a href="javascript:;" title="May 2015">
											<span class="blog_category_text">May 2015</span>
											<span class="blog_category_number">(05)</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="blog_side_section">
							<div class="blog_side_section_title">
								<h3 class="title">Tags</h3>
								<ul class="blog_tags">
									<li class="tag_list">
										<a href="javascript:;" title="Amazing">Amazing</a>
									</li>
									<li class="tag_list">
										<a href="javascript:;" title="Envato">Envato</a>
									</li>
									<li class="tag_list">
										<a href="javascript:;" title="Themes">Themes</a>
									</li>
									<li class="tag_list">
										<a href="javascript:;" title="Clean">Clean</a>
									</li>
									<li class="tag_list">
										<a href="javascript:;" title="Responsiveness">Responsiveness</a>
									</li>
									<li class="tag_list">
										<a href="javascript:;" title="SEO">SEO</a>
									</li>
									<li class="tag_list">
										<a href="javascript:;" title="Mobile">Mobile</a>
									</li>
									<li class="tag_list">
										<a href="javascript:;" title="IOS">IOS</a>
									</li>
									<li class="tag_list">
										<a href="javascript:;" title="Flat">Flat</a>
									</li>
									<li class="tag_list">
										<a href="javascript:;" title="Design">Design</a>
									</li>																																			
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		setTimeout(function() {
			$('.alert').fadeOut('fast');
	    }, 3000); // <-- time in milliseconds
	</script>
	@endsection