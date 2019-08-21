@extends('layouts.app')
@section('title',ucfirst($userdetails->first_name)." ".ucfirst($userdetails->last_name))
@section('content')
<section <?php if ($userdetails == null){ echo 'style="margin-bottom:31.5%"'; }else{ if(count($blogdetails)<=0){ echo 'style="margin-bottom:15%"';} }?>>
	<div id="bookmarkmsg">Blog Bookmarked</div>    
	<div id="bookmarkremmsg">Blog Bookmark Removed</div>
	<div class="profile_page block_page">
		<div class="container">
			<div class="row">
				<?php if ($userdetails == null){ 
   				echo '<div class="col-lg-4"></div><div class="col-lg-4"><h1 style="text-align:center;color:red">User Not Found</h1></div><div class="col-lg-4"></div>';
				} ?>
				<div class="col-lg-4 col-md-5" <?php if ($userdetails == null){ echo 'style="display:none"'; } ?> >
					<div class="profile_page_side_section">
						<div class="user_profile block_user_profile margin-bottom-30">
							<div class="user_image_section">
								<?php 
								if(Auth::user()!=null) {
									$uid=Auth::user()->id;
								} else {
									$uid=0;
								}
								if( $userdetails!=null && $uid!=$userdetails->id){ 
								?>
								<div class="text-center">
									@if (Session::has('blockusermsg'))
									<div style="color:red;font-weight: bold" id="blockusermsg">{{ Session::get('blockusermsg') }}</div>
									@endif
								</div>
								<div class="view_menu">
									<i class="icon-toggle"></i>
									<div class="view_menu_sub">
										<a href="{{ url('blockuser/'.$userdetails->id) }}" title="Block this user" class="view_menu_sub_link">Block this user</a>
										<a href="javascript:;" title="Report this user" class="view_menu_sub_link">Report this user</a>
									</div>
								</div>
								<?php } ?>
								<div class="profile_section media align-items-center">
									<div class="profile_pic media-left">
										<?php
										if ($userdetails != null && $userdetails->profile_image != null) {
											?>
											<img src="{{ asset("/public/user_img/".$userdetails->profile_image) }}" alt="">
										<?php
										} else {
											?>
											<!-- start -->
											<img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">
											<!-- end -->
										<?php
										} ?>
									</div>
									<div class="media-body user_info">
										<?php
										if ($userdetails != null) {
										?>   
										<a href="" class="name">
											{{ $userdetails->first_name." ".$userdetails->last_name }}
										</a>       
										<div class="designation">Writer</div>
										<div class="followers"><span class="number"><?php echo getFollowercount($userdetails->id); ?></span> Followers</div>
										<?php
										} else {
											echo "User Not found";
										} ?>
									</div>
								</div>
								<div class="social_icon">
									<div class="text-right">
										<?php if ($userdetails != null && $userdetails->social_icon_status == '1') { ?>
											<?php if ($userdetails != null && $userdetails->facebook_profile_url != null && $userdetails->facebook_id != null) { ?>
												<a target="_blank" href="<?php echo $userdetails->facebook_profile_url ?>"><i class="fa fa-facebook" style="font-size: 20px;color:white"></i></a>&nbsp;&nbsp;
											<?php } ?>
											<?php if ($userdetails != null && $userdetails->twitter_id != null) { ?>
												<a target="_blank" href="https://twitter.com/<?php echo $userdetails->twitter_username ?>"><i class="fa fa-twitter" style="font-size: 20px;color:white"></i></a>
											<?php } ?>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="user_profile_button">
								<?php 
									if(Auth::user()!=null)
									{
										$uid=Auth::user()->id;
									}else{
										$uid=0;
									}
								if( $userdetails!=null && $uid!=$userdetails->id && Auth::user()){ 
									?>
								<div class="user_profile_button">                               
								<a href="{{URL::to('connect',array('id'=>$userdetails->id))}}" title="Connect" class="button connect">
								<?php if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==0 && checkConnectionReqStatus(Auth::user()->id,$userdetails->id)==0){ echo "Connect"; }else{ if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==0 && checkConnectionReqStatus(Auth::user()->id,$userdetails->id)==1){ echo "Request sent"; }else { echo "Connected";} }?>
								</a>
								<a href="{{URL::to('follow',array('id'=>$userdetails->id))}}" title="Follow" class="button follow">
								<?php if(checkFollowerStatus(Auth::user()->id,$userdetails->id)==0 || checkFollowerStatus(Auth::user()->id,$userdetails->id)==null){ echo "Follow"; }else{ echo "Followed"; }?>
								</a>                                 
								</div>
								 <?php } ?>
								<!-- <div class="user_profile_button">                               
									<a href="{{URL::to('/')}}" title="Connect" class="button connect">Connect</a>
									<a href="{{URL::to('/')}}" title="Follow" class="button follow">Follow</a>                                 
								</div> -->
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-7">
					<div class="block_author_main">
						<div class="row" id="appdiv">
							@if(count($blogdetails) > 0)
							@foreach($blogdetails as $blogdata)
							<div class="col-lg-6 col-md-12">
								<div class="block_author_section">                                    
									<div class="block_profile_main">
										<div class="block_profile_section media" >
											<div class="media-left">
												<div class="">
													<?php
													if ($userdetails != null) {
														?>
														<img src="{{ asset("/public/user_img/".$userdetails->profile_image) }}" alt="">
														<?php
													} else {
														?>
														<img src="" alt="">
														<?php
													}
													?>
												</div>
											</div>
											<div class="media-body">
												<?php
												if ($userdetails != null) {
													?>
													<a target="_blank" href="{{ url("blog/".$blogdata->blog_slug) }}" title="{{ $blogdata->blog_title }}" class="user_name">{{ $blogdata->blog_title }}</a>
													<?php
													$is_bookmarked=App\Bookmarks::select('is_delete')->where('blog_id','=',$blogdata->id)->where('is_delete','=',0)->first();
												}
												?>
												<div class="time"><?php echo date("F j, Y", strtotime($blogdata->updated_at)); ?></div>
											</div>
										</div>
										<div class="block_profile_icon_section dropdown">
											<a href="javascript:;" title="Save" class="icon" onclick="blogbookmark(<?php echo $blogdata->id; ?>)">
												<i class="icon-save-bookmark bookmark<?php echo $blogdata->id; ?>" <?php if( $is_bookmarked!=null && $is_bookmarked->is_delete==0){ echo "style='color:#57bb47'"; } ?>></i>
											</a>
											<a href="javascript:;" title="Save" class="icon sort-info tabcontent-title dropdown-toggle" data-toggle="dropdown">
												<i class="icon-arrow-down"></i>
											</a>
											<div class="dropdown-menu">
												<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo url("blog/".$blogdata->blog_slug); ?>" id="btnFacebook" class="dropdown-item" target="_blank">Share on Facebook</a>

	<a href="https://twitter.com/home?status=<?php echo url("blog/".$blogdata->blog_slug); ?>" id="btnTwitter" class="dropdown-item" target="_blank">Share on Twitter</a>

	<a href="https://plusone.google.com/_/+1/confirm?hl=en&url=<?php echo url("blog/".$blogdata->blog_slug); ?>"  target="_blank" id="btnGoogle" class="dropdown-item">Share on G+</a>

	<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo url("blog/".$blogdata->blog_slug); ?>&summary=&source="  target="_blank" id="btnLinkedin" class="dropdown-item">Share on Linkedin</a>
											</div>
										</div>
									</div>
									<div class="block_author_img">
										<?php if ($blogdata->blog_image != '') { ?>
											<img src="{{ asset("/public/blog_img/".$blogdata->blog_image) }}" alt="{{ $blogdata->blog_title }}">
										<?php } else { ?>
											<!--<img src="{{ asset("/public/blog_img/blog-2.jpg") }}" alt="Blog">-->
										<?php } ?>
									</div>
									<div class="block_author_heading">
										<a target="_blank" href="{{ url("blog/".$blogdata->blog_slug) }}" title="{{ $blogdata->blog_title }}" class="title">{{ $blogdata->blog_title }}</a>
									</div>
									<p class="block_author_content">
										@php echo strip_tags(str_limit($blogdata->blog_description, 200)) @endphp
									</p>
									<div class="read_more_section">
										<a  target="_blank" href="{{ url('blog/'.$blogdata->blog_slug) }}" style="color: #25aae2;" title="Read More">Read More...</a>
										
										<!-- <span class="follow pull-right">1.5 K</span> -->
									</div>
								</div>
							</div>
							@endforeach	
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function () {
		var page = 1;
		$("#load_more").click(function(){
			page++;
			$.ajax({
				url: '?page=' + page,
				type: "get",
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
				$("#appdiv").append(data.html);
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
				alert('server not responding...');
			});
		});
   	});
   	setTimeout(function () {
		$("#blockusermsg").hide();
	}, 5000);

	function blogbookmark(blogid){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('blogbookmark')}}",
			type:"POST",
			data: {'blog_id': blogid},
			success: function (result) {                                                            
				if(result==1)
				{
					$("#bookmarkremmsg").fadeIn().delay(1000).fadeOut();
					$(".bookmark"+blogid).css("color","#777777");
					var x = document.getElementById("bookmarkremmsg");
					x.className = "show";
					setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
				}else{
					$("#bookmarkmsg").fadeIn().delay(1000).fadeOut();
					$(".bookmark"+blogid).css("color","#57bb47");
					var x = document.getElementById("bookmarkmsg");
					x.className = "show";
					setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
				}
			}
		});
	}   
</script>
@endsection        