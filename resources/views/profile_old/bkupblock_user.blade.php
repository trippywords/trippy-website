@extends('layouts.app')
@section("title","Block Users")
@section('content')

	
<section>
	 <div class="profile_page user_menu_page">                                        
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-7">
				   <!-- Follower section start -->
						<div id="Followers" class="tabcontent connection-main">
						<div class="connection-main-header">
							<div class="row">
								<div class="col-sm-3">
									<div class="connections tabcontent-title">
										Block users count
									</div>
								</div>
								<div id="unblock_user">User is unblock</div>
								<div class="col-sm-6 text-center">
									<div class="sort-main dropdown">    
										<span class="sort-title">Sort by:</span>
										<a href="javascript:;" title="" class="sort-info tabcontent-title dropdown-toggle" data-toggle="dropdown">
											<span>Recently added</span>
											<span class="fa fa-chevron-down"></span>
										</a>
										<div class="dropdown-menu position">
											<a href="javascript:;" id="follower_ascending" class="dropdown-item">Ascending</a>
											<a href="javascript:;" id="follower_descending" class="dropdown-item">Descending</a>
										</div>
									</div>
								</div>

								<div class="col-sm-3">
									<div class="input-group search-main">
										<span class="input-group-addon"><i class="icon icon-search tabcontent-title searchfollowing"></i></span>
										<input type="text" class="form-control" name="search_follower" id="search_follower" placeholder="Search by name">
									</div>
								</div>
							</div>
						</div>
						<div class="connection-main-section followerlist">
							@foreach($block_user as $buser)
								@php
									$user_details = getUserdetailbyid($buser->connect_user_id);
								@endphp
								@if(count($user_details) > 0)		
									<div class="connection-section display-flex-custom blockhide $user_details['connection_id']">
										<div class="media">
											<div class="media-left">
												<div class="profile_pic">
													@if($user_details['profile_image'] !=null)
														<img src='{{ asset("/public/user_img/".$user_details["profile_image"]) }}' alt="Profile">
													@else
														<img src="{{ asset('/public/assets/image/profile.png')}}" alt="Profile">
													@endif
												</div>
											</div>
											<div class="media-body">
												<a href="profile"><div class="tabcontent-title connection-profile">{{$user_details['first_name']}} {{$user_details['last_name']}}</div></a>
											</div> 
										</div>
										<div class="message-main text-right">
											<button type="button" class="btn btn-danger" onclick="unblockUser($user_details['connect_user_id'])">Unblock</button>
										</div>
									</div>
								@endif
							@endforeach
							<!-- If no block user then start -->
							<!-- <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
								<span>
									<img src="public/blog_img/no-blog.png"  alt="" height="100px" widht="100px" >
								</span>
								<p class="content_text">Awww ! no followers.</p>
							 </div> -->
							<!-- If no block user then end -->
						</div>
						<div class="ajaxfollowerlist1"></div>
						<div class="ajaxfollowerlistaz"></div>
						<div class="ajaxfollowerlistza"></div>
					</div>
					<!-- Follower section end -->
				</div>
			</div>
		</div>
	</div>
</section>
<script>
$(document).ready(function () {

	function unblockUser($connection_id){
		alert('hi');
		swal({
            title: "Are you sure you want to unblock user ?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('unblockuser')}}",
                    type:"POST",
                    data: {'connection_id': connection_id}, 
                    success: function (result) {
                        if(result==1) {
                            /*$("#bookmarkmsg").fadeIn().delay(5000).fadeOut();*/
                            $(".blockhide"+connection_id).hide();
                            var x = document.getElementById("unblock_user");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", "");location.reload();  }, 2000);
                        }
                    },
                    error: function (result) {
                    	alert(connection_id);
                    }
                });
            }
        });   
	}
});
</script>
@endsection
