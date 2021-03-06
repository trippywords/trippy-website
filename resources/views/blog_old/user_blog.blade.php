@extends('layouts.app')
@section('title',$blog_details->blog_title)
@section('meta')
<meta name="keywords" content="{{$blog_details->blog_keywords}}"/>
<meta name="description" content="{{$blog_details->blog_meta_description}}"/>
<meta name="author" content="{{ ucfirst($auther->first_name) }}"/>
<meta property="og:title" content="{{ $blog_details->blog_title }}" />
<?php
if (file_exists('public/assets/image/logo.png')){
  $detail_image_url=asset('public/assets/image/logo.png');
  list($width, $height) = getimagesize($detail_image_url);
  $ext = pathinfo($detail_image_url, PATHINFO_EXTENSION);
}?>

<meta property="og:image" content="{{ asset('/public/assets/image/fb_share_logo.png')}}" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="200">
<meta property="og:image:height" content="200">
<meta property="og:url" content="{{ url('blog/'.$blog_details->blog_slug) }}" />
<meta property="og:description" content="{{$blog_details->blog_meta_description}}" />
<meta property="og:type" content="website" />

@endsection
@section('content')
@php
	if(Auth::user()){
		$user = Auth::user()->id;
	}else{
		$user = 0;
	}
@endphp
<section>
	<div class="inner-banner blog-new-banner">
		<div class="banner-content-main">
			<h1 class="main-title">{{ $blog_details->blog_title }}</h1>
			<ul class="breadcrumbs-main">
				<li>
					<a href="{{ url('/') }}" class="breadcrumbs-list">Home</a>
				</li>
				<li>
					<i class="icon icon-right-arrow"></i>
				</li>
				<li>
					<a href="{{url('profile/'.$auther->name)}}" class="breadcrumbs-list">Blog</a>
				</li>
				<li>
					<i class="icon icon-right-arrow"></i>
				</li>
				<li>
					{{ $blog_details->blog_title }}
				</li>
			</ul>
		</div>
	</div>
</section>
<!-- main.css | /* block-this-author Page Section S */ -->
<section>
	@if (\Session::has('successmsg'))
	
	<div id="commentmsg" style="text-align: center; color: #28a745;   font-size: medium;   margin-top: 10px;   margin-bottom: 10px"> {{ \Session::get('successmsg') }}       
	</div>
	@endif
	<div class="profile_page block_page blog-new">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-5">
					<div class="profile_page_side_section">
						<div class="user_profile blog-new-profile block_user_profile margin-bottom-30">
							<div class="user_image_section blog-new-image-section">
								<div class="profile_section media align-items-center">
									<div class="profile_pic media-left">
										<?php 
										if($auther->profile_image!='')
										{
											?>
											<img src="{{asset("/public/user_img/".$auther->profile_image)}}" alt="">
										<?php 
										}else{
											?>
											<img src="" alt="" />
										<?php } ?>
										</div> 
										<div class="media-body user_info">
											<div class="designation">Author</div>
											<a href="{{url("profile/".$auther->name)}}" class="name" title="<?php echo $auther->name ?>"><?php echo ucfirst($auther->first_name) ?> <?php echo ucfirst($auther->last_name); ?></a>
										</div>
										</div>
										</div>

										
										<!-- Condition strat -->
											<div class="user_profile_button">
											<?php
											$connect_btn = "";
											$follow_btn = "";
											$requestDisable = 0;
											if(Auth::user())
											{
												$uid=Auth::user()->id;
											}else{
												$uid=0;
											}
											if(!empty($auther) && $uid != $auther->id){

												if(checkConnectionStatus($uid,$auther->id)==0 && checkConnectionReqStatus($uid,isset($blog_details->created_by)?$blog_details->created_by:0)==0)
													{
												 		$connect_btn=  "Connect"; 
												 	}
												else{ 

											 		if(checkConnectionStatus(Auth::user()->id,$auther->id)==0 && checkConnectionReqStatus(Auth::user()->id,$auther->id)==1)
											 			{

											 			 	$connect_btn= "Request sent"; 
											 			 	$requestDisable = 1;
											 			}
											 			else 
											 			{ 
											 				
											 				$connect_btn=  "Connected"; 
											 			} 
										 		} 
											}
											else
											{
												if(checkConnectionStatus(Auth::user()->id,$auther->id)==0 && checkConnectionReqStatus(Auth::user()->id,$auther->id)==1)
									 			{
									 			 	$connect_btn= "Request sent"; 
									 			 	$requestDisable = 1;
									 			}
									 			else 
									 			{ 									 				
									 				$connect_btn=  "Connected"; 
									 			} 
												
											}
											if(checkFollowerStatus($uid,$auther->id)==0 || checkFollowerStatus($uid,$auther->id)==null){
											 $follow_btn = "Follow"; 
											}
											else{ 
											 	$follow_btn=  "Followed"; 
											 }
											 $created_by =  $blog_details->created_by;
											?>
											<input type='hidden' id='check_login' value="{{$uid}}">
											@if($created_by != $uid)
											<div class="user_profile_button">     
													<a title="Connect" data-connect ="{{URL::to('connect',array('id'=>$auther->id))}}" class="button connect @if($requestDisable!=1)connect_btn @endif">
														{{$connect_btn}}
													</a>
											<a href="javascript:;" data-follow="{{URL::to('follow',array('id'=>$auther->id))}}" title="Follow" class="button follow follow_btn">
														{{$follow_btn}}
													</a>                                 
												</div>
											@endif
											<?php  ?> 
										</div>
				<!-- condition end -->
										
										</div>
										<div class="categories-list-main">
											<h3 class="categories-list-title">Genre</h3>
											<ul class="categories-list-section">
												@foreach($user_genere_details as $usergen)
												<?php $genre_name = getParentGenreInfo($usergen->preference_id); ?>
												@if($genre_name!='')
												<li class="categories-list categories-list-hover">
													<a href="{{url('genre/blog',getParentGenreSlug($usergen->preference_id))}}" target="_blank" class="categories">{{ $genre_name }}</a>
												</li>
												@endif
												@endforeach    
											</ul>
										</div>
										@if(count($topblogdata)>=1)
										<div class="categories-list-main">
											<h3 class="categories-list-title">Latest posts by Author</h3>
											<ul class="categories-list-section">
												@foreach($topblogdata as $tblogdata)

				                                    <li class="categories-list">
													<a href="{{ url('blog/'.$tblogdata->blog_slug) }}" target="_blank" title="" class="post-title">
														{{ $tblogdata->blog_title }}
													</a>
				<!--										<span class="categories">Photograph</span>-->
													</li>
												@endforeach
											</ul>
										</div>
										@endif
										</div>
										</div>
										<div class="col-lg-8 col-md-7 mobile-first">
											<div class="blog-new-main">
					<!-- <div class="social-main">
						<ul class="social-section">
							<li class="social-list">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo Request::url(); ?>" target="_blank" title="" class="social-icon">
									<i class="icon fa fa-facebook"></i>
								</a>
							</li>
							<li class="social-list">
								<a href="https://twitter.com/home?status=<?php //echo Request::url(); ?>" target="_blank" title="" class="social-icon">
									<i class="icon fa fa-twitter"></i>
								</a>
							</li>
							<li class="social-list">
								<a href="https://plusone.google.com/_/+1/confirm?hl=en&url=<?php //echo Request::url(); ?>&title=<?php //echo $blog_details->blog_title; ?>" target="_blank" title="" class="social-icon">
                                    <i class="icon fa fa-google-plus"></i>
								</a>
							</li>
							<li class="social-list">
								<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php //echo Request::url(); ?>&title=<?php //echo $blog_details->blog_title; ?>&summary=&source=" target="_blank" title="" class="social-icon">
									<i class="icon fa fa-linkedin"></i>
								</a>
							</li>
							<li class="social-list">
								<a href="https://pinterest.com/pin/create/button/?url=<?php //echo Request::url(); ?>&media={{asset("/public/blog_img/".$blog_details->blog_image) }}&description=<?php //echo $blog_details->blog_title; ?>" target="_blank" title="" class="social-icon">
									<i class="icon fa fa-pinterest"></i>
								</a>
							</li>
							@if(Auth::user())
                         	<?php 
                                 //$is_bookmarked=App\Bookmarks::select('is_delete')->where('user_id','=',Auth::user()->id)->where('blog_id','=',$blog_details->id)->where('is_delete','=',0)->first();
                            ?>
                            <li class="social-list" style="width: 40%;text-align: center">
                            	<div id="bookmarkmsg" style="text-align: center; color: #28a745;   font-size: medium;   margin-top: 10px;   margin-bottom: 10px;display: none">Blog Bookmarked
                            	</div>
            					<div id="bookmarkremmsg" style="text-align: center; color: #28a745;   font-size: medium;   margin-top: 10px;   margin-bottom: 10px;display: none">Blog Bookmark Removed
            					</div>
            				</li>
							<li class="social-list bookmark-main">
                                <a href="javascript:;" title="" class="social-icon" onclick="blogbookmark(<?php //echo $blog_details->id; ?>)">
									<span class="bookmark">Bookmark this article</span>
									<i class="icon icon-save-bookmark" <?php //if( $is_bookmarked!=null && $is_bookmarked->is_delete==0){ echo "style='color:#57bb47'"; //} ?>>
									</i>
								</a>
							</li>
							@endif
						</ul>
					</div> -->
					<div class="blog-image">
		                        <?php if($blog_details->blog_image!=''){ ?>
		                            <img src="{{asset("/public/blog_img/".$blog_details->blog_image) }}" alt="{{$blog_details->blog_title}}">
		                        <?php }/*else{
		                         ?>
		                         <img src="{{ asset('/') }}public/blog_img/blog-2.jpg" alt="{{$blog_details->blog_title}}">
		                       <?php }*/   ?>
					</div>
					<div class="blog-section">
						<h2 class="blog-title">{{ $blog_details->blog_title }}</h2>
							<p class="blog-content">{{ $blog_details->blog_heading }}</p>
							<p class="blog-content">@php echo html_entity_decode($blog_details->blog_description) @endphp</p>
						<div class="social-main">
							<ul class="social-section">
<!--										<li class="social-list">
								<a href="javascript:;" title="" class="social-icon">
									<i class="icon fa fa-share"></i>
								</a>
							</li>-->
							<li class="social-list">
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo Request::url(); ?>" target="_blank" title="" class="social-icon">
									<i class="icon fa fa-facebook"></i>
								</a>
							</li>
							<li class="social-list">
								<a href="https://twitter.com/home?status=<?php echo Request::url(); ?>"  title="" class="social-icon">
									<i class="icon fa fa-twitter"></i>
								</a>
							</li>
							<li class="social-list">
								<!--											<a href="https://plus.google.com/share?url=<?php //echo Request::url(); ?>" target="_blank" title="" class="social-icon">-->
									<a href="https://plusone.google.com/_/+1/confirm?hl=en&url=<?php echo Request::url(); ?>&title=<?php echo $blog_details->blog_title; ?>"  title="" class="social-icon">
										<i class="icon fa fa-google-plus"></i>
									</a>
								</li>
								<li class="social-list">
									<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo Request::url(); ?>&title=<?php echo $blog_details->blog_title; ?>&summary=&source="  title="" class="social-icon">
										<i class="icon fa fa-linkedin"></i>
									</a>
								</li>
								<li class="social-list">
									<a href="https://pinterest.com/pin/create/button/?url=<?php echo Request::url(); ?>&media={{asset("/public/blog_img/".$blog_details->blog_image) }}&description=<?php echo $blog_details->blog_title; ?>"  title="" class="social-icon">
										<i class="icon fa fa-pinterest"></i>
									</a>
								</li>
								@if(Auth::user())
								<li class="social-list bookmark-main">
									<a href="javascript:;" title="" class="social-icon" onclick="blogbookmark(<?php echo $blog_details->id; ?>)">
										<span class="bookmark">Bookmark this article</span>
										<i class="icon icon-save-bookmark" <?php if(isset($is_bookmarked) && $is_bookmarked!=null && $is_bookmarked->is_delete==0){ echo "style='color:#57bb47'"; } ?>>
										</i>
									</a>
								</li>
								@endif
							</ul>
						</div>
						@if(!empty($blog_details->blog_keywords))
						<div class="tag-main">
							<h5 class="tag-title">Tags</h5>
							@php
							$tags = explode(',',$blog_details->blog_keywords);
							@endphp
							<div class="tag-section">
								@for($i=0;$i<count($tags);$i++)
								<a target="_blank" href="{{url('keywords',str_replace(' ','-',$tags[$i]))}}" title="{{$tags[$i]}}" class="btn btn-primary">{{$tags[$i]}}</a>
								@endfor
							</div>

						</div>
						@endif
						<div class="author-detail-main">
							<h6 class="author-name"><a href="{{url("profile/".App\User::where('id','=',$blog_details->created_by)->first()->name)}}" class="name" title="<?php echo App\User::where('id','=',$blog_details->created_by)->first()->name ?>"><?php echo ucfirst(App\User::where('id','=',$blog_details->created_by)->first()->first_name); ?> <?php echo ucfirst(App\User::where('id','=',$blog_details->created_by)->first()->last_name); ?></a></h6>
							<p class="author-detail"><?php echo App\User::where('id','=',$blog_details->created_by)->first()->description ?></p>
						</div>
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
					<form id="commentForm" method="post">
						<div class="row">
							<!-- <div class="col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="NAME" name="name" required="">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="email" class="form-control" placeholder="E-MAIL" name="email" required="">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="WEBSITE" name="website" required="">
								</div>
							</div> -->
							
								<div class="col-md-12">
									@if(Auth::user())
									<div class="form-group">
										<textarea class="form-control" placeholder="COMMENTS" rows="5" id="comment" name="comments">{{old('comments')}}</textarea>
									</div>
									<div class="button_section">
										@csrf
										<input type="hidden" id="blog_id" value="{{ $blog_details->id }}" name="blog_id" />
										<input type="hidden" id="blog_slug" value="{{ $blog_details->blog_slug }}" name="blog_slug" /> 
										<input type="hidden" id="comment_date" value="{{date('d-m-Y')}}" name="comment_date" /> 
										<input type="hidden" id="comment_name" value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" name="comment_name" /> 
										<a href="javascript:;" id="storeComment" class="btn btn-primary storeComment">SUBMIT</a>
										<div id="comment_success">Comment submitted successfully</div>
										<!-- <button type="submit" id="storeComment" class="btn btn-primary">SUBMIT</button> -->

									</div>
									@else
										<a href="javascript:;" style="cursor: default;" class="comment_login">Please login to add comment here</a>
									@endif
								</div>
								
						</div>
					</form>
				</div><hr><br>
				<div class="categories-list-main comment-section">
					<h3 class="categories-list-title">Comments</h3><br>
					@if(count($comments) > 0)
						<ul class="categories-list-section" id="prepend_demo">
							@foreach($comments as $comment)
							<li class="categories-list categories-list-hover" style="cursor: default;">
								<span>{{ $comment->first_name }} {{ $comment->last_name }}</span>
								<a href="javascript:;" style="cursor: default;" class="categories">{{ $comment->comments }}</a>
								@php
									$newDate = date("d-m-Y", strtotime($comment->created_at));
								@endphp
								<span>{{ $newDate }}</span>
							</li>
							@endforeach    
						</ul>
					@else
						<span>No Comments Available</span>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript"> 
     
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });      
		var user = '{{$user}}';
	$(document).ready(function(){
		$('#redirect_url').val('<?php echo isset($url)?$url:''; ?>');
		$("body").on("click",'.connect_btn',function(){
			/*var id = $("#check_login").val();*/
			var connect_url = $(this).attr("data-connect");
			if(user != 0){
				window.location.href = connect_url;
			}else{
				$('#login_modal').modal('show');
				/*window.location.href = "{{url('/')}}";*/
			}
			
		});	
		$('.comment_login').on('click',function(){
			$('#login_modal').modal('show');
		});
		$("body").on("click",'.follow_btn',function(){
			var id = $("#check_login").val();
			var follow_url = $(this).attr("data-follow");
			if(user != 0){
				window.location.href = follow_url;
			}else{
				$('#login_modal').modal('show');
				/*window.location.href = "{{url('/')}}";*/
			}
			
		});
	});

	$(function(){
		$('#storeComment').on('click',function(){
			if(user !=0){
			$("#commentForm").validate({
              // Specify vaidation rules
              rules: {      
                comments: {
                  required: true,
                }
              },
              // Specify validation error messages
              messages: {      
                comments: "Please enter a Comments",
              }
            });
			/*	$('#commentForm').submit();*/
			}else{
				$('#login_modal').modal('show');
			}
		});
	});
function blogbookmark(blogid){
	$.ajax({headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},url: "{{route('blogbookmark')}}",type:"POST", data: {'blog_id': blogid}, success: function (result) {                                                            
		if(result==1)
		{
			$("#bookmarkremmsg").fadeIn().delay(1000).fadeOut();
			$(".icon-save-bookmark").css("color","#777777");
		}else{
			$("#bookmarkmsg").fadeIn().delay(1000).fadeOut();
			$(".icon-save-bookmark").css("color","#57bb47");
		}
	}});
}
/*Comment submit code start*/
$(document).ready(function(){
	 $(function(){
		$(document).on('click','.storeComment',function(e){
            var blogid = $('#blog_id').val();
            var comment = $('#comment').val();
            var date = $('#comment_date').val();
            var name = $('#comment_name').val();
           	$.ajax({
				url: "{{route('saveblogcomment')}}",
				type:"POST", 
				data: {'blog_id': blogid,'comments':comment,'_token':$('meta[name="csrf-token"]').attr('content')},
				success: function (result) {  
					if(result==1){
						$('#comment').val("");
						var html = '<li class="categories-list categories-list-hover" style="cursor: default;"><span>'+name+'</span><a href="javascript:;" style="cursor: default;" class="categories">'+comment+'</a><span>'+date+'</span></li>';
						$("#prepend_demo").prepend(html);
						 var x = document.getElementById("comment_success");
                            x.className = "show";
                            setTimeout(
                                function(){ 
                                    x.className = x.className.replace("show", ""); 
                                }, 5000);
                            setTimeout(function(){location.reload();}, 1000);
                            return false;	
					}
					else{
						alert('123');
					}                                                          
				}
			});
		});
	});
});
</script>
@endsection
