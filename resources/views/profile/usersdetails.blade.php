<?php //dd('dbdbdbd');?>
@extends('layouts.app')
@section('title',ucfirst($userdetails->first_name)." ".ucfirst($userdetails->last_name))
@section('meta')

<!-- Facebook Share -->
<meta property="og:image" content="{{ asset('/public/assets/image/fb_share_logo.png')}}" />
<meta property="og:image:type" content="image/png">
<meta property="og:type" content="website" />
@endsection
@section('content')
<section <?php if ($userdetails == null){ echo 'style="margin-bottom:31.5%"'; } ?>>
	<div id="bookmarkmsg">Blog Bookmarked</div>    
	<div id="bookmarkremmsg">Blog Bookmark Removed</div>
	<div class="profile_page block_page blockuser_page">
		<div class="container">
			<div class="row">
				<?php if (empty($userdetails)){ 
   				echo '<div class="col-lg-4"></div><div class="col-lg-4"><h1 style="text-align:center;color:red">User Not Found</h1></div><div class="col-lg-4"></div>';
				} ?>
				<div class="col-lg-4 col-md-5" <?php if (empty($userdetails)){ echo 'style="display:none"'; } ?> >
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
									<?php if(Auth::user()){ ?>
										<i class="icon-toggle"></i>
										<div id="succ_blocked">You have blocked successfully</div>
										<div id="succ_unblocked">You have unblocked successfully</div>
										<div id="succ_reported">You have Reported successfully</div>
										<div id="already_reported">You have already reported to this User</div>
										<div class="view_menu_sub">
										 	<?php $connection = \App\Connection::where("user_id",'=',$uid)->where("connect_user_id","=",$userdetails->id)->where('is_delete','=',0)->first();
											if (isset($connection->is_block) && $connection->is_block==1) { ?>
												<a href="javascript:void(0);" onclick="unblockUser({{ $userdetails->id }})" title="Unblock this user" class="view_menu_sub_link">Unblock this user</a>
											<?php }else{ ?>	
												<a href="javascript:void(0);" onclick="unblockUser({{ $userdetails->id }})" title="Block this user" class="view_menu_sub_link">Block this user</a>	
											<?php } ?>	
											<a href="javascript:void(0);" onclick="reportUser({{ $userdetails->id }})" title="Report this user" class="view_menu_sub_link" <?php if (isset($connection->is_block) && $connection->is_block==1){ ?> disabled="disabled" <?php } ?>>Report this user</a>		
										</div>
									<?php } ?>
								</div>

								<?php } ?>
								<div class="profile_section media align-items-center">
									<div class="profile_pic media-left">
										<?php
										if (!empty($userdetails) && $userdetails->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetails->profile_image)) {
											?>
											<img src="{{ asset('/public/user_img/'.$userdetails->profile_image) }}" alt="">
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
										<a href="" class="name" id="userNameText">
											{{ ucfirst($userdetails->first_name)." ".ucfirst($userdetails->last_name) }}
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
								<?php $connection = getConnection(Auth::user()->id,$userdetails->id); ?>

                                    <?php if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==0 && checkConnectionReqStatus(Auth::user()->id,$userdetails->id)==0){ 
                                         $title = "Connected";
                                         $data_title = "Disconnect";
                                    }else{ if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==1){
                                        $title="Cancel Request" ;
                                        $data_title="Cancel Request" ;
                                    }elseif (checkConnectionStatus($userdetails->id,Auth::user()->id)==1) {
                                        $title = "Accept Request"; 
                                        $data_title = "Accept Request"; 
                                    }else {
                                        $title="Connect" ;
                                        $data_title="Connect" ;
                                    } } ?>
                                    
                                    <a  data-val="{{$userdetails->id}}" data-title="{{$data_title}}" id="userdetails_id" class="button connect button_connect" title="<?php echo $title; ?>"  <?php if (isset($connection->is_block) && $connection->is_block==1): ?> disabled="disabled" <?php endif ?> >

                                    <?php if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==0 && checkConnectionReqStatus(Auth::user()->id,$userdetails->id)==0){ echo "Connected"; }else{ if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==1){ echo "Cancel Request"; }elseif (checkConnectionStatus($userdetails->id,Auth::user()->id)==1) { echo "Accept Request"; }else { echo "Connect";} }?>
                                    </a>

								<?php if(checkFollowerStatus(Auth::user()->id,$userdetails->id)==0){ ?> 
                                        <a data-val="{{$userdetails->id}}" id="userdetails_id" class="button follow button_unfollow" title="Followed" <?php if (isset($connection->is_block) && $connection->is_block==1): ?> disabled="disabled" <?php endif ?>>
                                    <?php }else{ ?>
                                        <a data-val="{{$userdetails->id}}" id="userdetails_id" class="button follow button_follow" title="Follow" <?php if (isset($connection->is_block) && $connection->is_block==1): ?> disabled="disabled" <?php endif ?>>
                                    <?php } ?>

                                    <?php $checkFollowerStatus = checkFollowerStatus(Auth::user()->id,$userdetails->id);
                                 if(isset($checkFollowerStatus) && intval($checkFollowerStatus)==0){ echo "Followed"; }else{ echo "Follow"; }?>

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
							<?php 
							//dd($blogdata);

							?>
							<div class="col-lg-6 col-md-12">
								<div class="block_author_section">                                    
									<div class="block_profile_main">
										<div class="block_profile_section media" >
											<div class="media-left">
												<div class="">
													<?php
													if (!empty($userdetails) && $userdetails->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetails->profile_image)) {
														?>
														<img src="{{ asset("/public/user_img/".$userdetails->profile_image) }}" alt="">
														<?php
													} else {
														?>
														<img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">
														<?php
													}
													?>
												</div>
											</div>
											<div class="media-body">
												<?php //if(Auth::user()){ 
												if ($userdetails != null) {
													?>
													<a target="_blank" href="{{ url("blog/".$blogdata->blog_slug) }}" title="{{ $blogdata->blog_title }}" class="user_name">{{ $blogdata->blog_title }}</a>
													<?php

													$is_bookmarked=App\Bookmarks::select('is_delete')->where('blog_id','=',$blogdata->id)->where('is_delete','=',0)->where('user_id','=',Auth::user()->id)->first();
												 }else{ ?>
													<a target="_blank" href="{{ url("blog/".$blogdata->blog_slug) }}" title="{{ $blogdata->blog_title }}" class="user_name">{{ $blogdata->blog_title }}</a>
												<? }
											
												?>
												<div class="time"><?php echo date("F j, Y", strtotime($blogdata->updated_at)); ?></div>
											</div>
										</div>
										<div class="block_profile_icon_section dropdown">
											<?php if(Auth::user()){ ?>
												<a href="javascript:;" title="Save" class="icon" onclick="blogbookmark(<?php echo $blogdata->id; ?>)">
													<i class="icon-save-bookmark bookmark<?php echo $blogdata->id; ?>" <?php if( isset($is_bookmarked->is_delete) && $is_bookmarked->is_delete==0){ echo "style='color:#57bb47'"; } ?>></i>
												</a>
											<?php }else{ ?>
												<a href="javascript:;" title="Save" class="icon" data-toggle="modal" data-target="#login_modal">
													<i class="icon-save-bookmark bookmark<?php echo $blogdata->id; ?>" ></i>
												</a>
											<?php } ?>	
											<a href="javascript:;" title="Share" class="icon sort-info tabcontent-title dropdown-toggle" data-toggle="dropdown">
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
										<?php if (!empty($blogdata) && $blogdata->blog_image != null && file_exists(public_path() . '/blog_img/' . $blogdata->blog_image)) { ?>
											<img src="{{ asset("/public/blog_img/".$blogdata->blog_image) }}" alt="{{ $blogdata->blog_title }}">
										<?php } else { ?>
											<img src="{{ asset('/') }}public/blog_img/no_img.jpg" alt="Blog">
										<?php } ?>
									</div>
									<div class="block_author_heading">
										<a target="_blank" href="{{ url("blog/".$blogdata->blog_slug) }}" title="{{ $blogdata->blog_title }}" class="title">{{ $blogdata->blog_title }}</a>
									</div>
									<p class="block_author_content">
										<?php 
											print_r($blogdata->blog_description);
										?>
										
									</p>
									<div class="read_more_section">
										<a  href="{{ url('blog/'.$blogdata->blog_slug) }}" style="color: #25aae2;" title="Read More">Read More...</a>
										
										<!-- <span class="follow pull-right">1.5 K</span> -->
									</div>
								</div>
							</div>
							
							
							<?php }?>
							
							
						</div>
					</div>
				</div>

			</div>

		</div>
		@endforeach	
		@endif					
	</div>

</section>
<script>
	$(document).ready(function () {

		$("body").on('click',".button_connect",function(){
	        button_connect($(this).attr('data-val'),$(this).attr('data-title'));
	    });

	    $('body').on('click','.button_follow',function(){
	        button_follow($(this).attr('data-val'));
	    });
	    $('body').on('click',".button_unfollow",function(){
	        button_unfollow($(this).attr('data-val'));
	    });

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

		setTimeout(function () {
			$("#blockusermsg").hide();
		}, 5000);
   	});
   	

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

	function unblockUser(user_id){
		if (user_id!=undefined) {
			var userNameText = $("#userNameText").text();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('blockuser')}}",
				type:"POST",
				data: {'user_id':user_id}, 
				success: function (result) {
					if(result==1) {
						var x = document.getElementById("succ_unblocked");
						$("#succ_unblocked").text('You have unblocked '+userNameText);
						x.className = "show";
						setTimeout(function(){ x.className = x.className.replace("show", "");
							location.reload(); 
						}, 2000);
					}else{
						var x = document.getElementById("succ_blocked");
						$("#succ_blocked").text('You have blocked '+userNameText);
						x.className = "show";
						setTimeout(function(){ x.className = x.className.replace("show", "");
							location.reload(); 
						}, 2000);
					}
				}
			});
		}	
	}

	function reportUser(user_id){
		if (user_id!=undefined) {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('reportuser')}}",
				type:"POST",
				data: {'user_id':user_id}, 
				success: function (result) {
					if(result==1) {
						var x = document.getElementById("succ_reported");
						x.className = "show";
						setTimeout(function(){ x.className = x.className.replace("show", "");
							location.reload(); 
						}, 2000);
					}else{
						var x = document.getElementById("already_reported");
						x.className = "show";
						setTimeout(function(){ x.className = x.className.replace("show", "");
							location.reload(); 
						}, 2000);
					}
				}
			});
		}	
	}

	 function button_connect(userid,title)

    {

    swal({

            title: "Do you want to "+title+" ?",

            text: "",

            icon: "warning",

            buttons: true,

            dangerMode: true,

            })

            .then((willDelete) => {

            if (willDelete) {
                if (title=='Accept Request') {
                    window.location.href = "<?php echo url('acceptrequest/"+userid+"'); ?>";
                }else{
                    if (title=='Disconnect') {
                        window.location.href = "<?php echo url('rejectrequest/"+userid+"'); ?>";
                    }else{
                        window.location.href = "<?php echo url('connect/"+userid+"'); ?>";
                    }    
                }
            }

            });

    }

    function button_follow(userid)

    {

    swal({

            title: "Are you sure you want to follow this user?",

            text: "",

            icon: "warning",

            buttons: true,

            dangerMode: true,

            })

            .then((willDelete) => {

            if (willDelete) {

            window.location.href = "<?php echo url('follow/"+userid+"'); ?>";

            }

            });

    }
    function button_unfollow(userid)

    {

    swal({

            title: "Are you sure you want to unfollow this user?",

            text: "",

            icon: "warning",

            buttons: true,

            dangerMode: true,

            })

            .then((willDelete) => {
            if (willDelete) {
                window.location.href = "<?php echo url('follow/"+userid+"'); ?>";
            }

            });

    }
</script>
@endsection        