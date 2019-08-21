@extends('layouts.app')

@section("title","Block User")

@section('content')



	

<section>

	 <div class="profile_page user_menu_page blockuser_page">                                        

		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-5">
                    <div class="tab">
                        <a href="{{ url('account-details') }}" >
                            <div class="tablinks"  id="defaultOpen_usermenu">
                                <span class="icon icon-briefcase"></span>
                                <span class="link_text">Account Details</span>
                            </div>
                        </a>
                        <a href="{{ route('preference-list') }}" >
                            <div  class="tablinks " id="defaultOpen_preference">
                                <span class="icon icon-table-grid"></span>
                                <span class="link_text">Preferences</span>
                            </div>
                        </a>  
                        <a href="{{ route('connections') }}" >  
                            <div  class="tablinks " id="defaultOpen_connection">
                                <span class="icon icon-link"></span>
                                <span class="link_text">Connections</span>    
                            </div>
                        </a>
                        <a href="{{ route('following') }}" >
                            <div  class="tablinks " id="defaultOpen_following">
                                <span class="icon icon-wifi"></span>
                                <span class="link_text">Following</span>    
                            </div>
                        </a>
                        <a href="{{ url('followers') }}" >
                            <div class="tablinks " id="defaultOpen_followers">
                                <span class="icon icon-wifi"></span>
                                <span class="link_text">Followers</span>   
                            </div>
                        </a> 
                        <a href="{{ route('bookmarks') }}" >
                            <div  class="tablinks " id="defaultOpen_bookmarks">
                                <span class="icon icon-save-bookmark"></span>
                                <span class="link_text">Bookmarks</span> 
                            </div>
                        </a>   
                        <a href="{{ route('notification-list') }}" >
                            <div  class="tablinks " id="defaultOpen_notificationlist">
                                <span class="icon fa fa-bell"></span>
                                <span class="link_text">Notification List</span>
                            </div>
                        </a>
                        <a href="{{ route('social') }}" >
                            <div class="tablinks " id="defaultOpen_social">
                                <span class="icon fa fa-twitter"></span>
                                <span class="link_text">Social</span>
                            </div>
                        </a>
                        <a href="{{ route('request') }}" >
                            <div  class="tablinks " id="defaultOpen_request">
                                <span class="icon fa fa-user-plus"></span>
                                <span class="link_text">Request</span>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-8 col-md-7">

				   <!-- Block user diplay section start -->

						<div id="Followers" class="tabcontent connection-main">

						<div class="connection-main-header">

							<div class="row">

								<div class="col-sm-3">

									<div class="connections tabcontent-title">

										@if(count($block_user)!=0)

											{{count($block_user)}} Block users

										@endif

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

											<a href="javascript:;" id="block_ascending" class="dropdown-item">Ascending</a>

											<a href="javascript:;" id="block_descending" class="dropdown-item">Descending</a>

										</div>

									</div>

								</div>



								<div class="col-sm-3">

									<div class="input-group search-main">

										<span class="input-group-addon"><i class="icon icon-search tabcontent-title searchfollowing"></i></span>

										<input type="text" class="form-control" name="search_block" id="search_block" placeholder="Search by name">

									</div>

								</div>

							</div>

						</div>

						<div class="connection-main-section list_block">
							<?php if (count($block_user ) > 0) { ?>
							<div id="block_more">
							@foreach($block_user as $buser)

								@php

									$user_details = getUserdetailbyid($buser->connect_user_id);

								@endphp

								@if($user_details)		

									<div class="connection-section display-flex-custom blockhide{{$buser->connect_user_id }}">

										<div class="media">

											<div class="media-left">

												<div class="profile_pic">

													<?php if (isset($user_details['profile_image']) && $user_details['profile_image'] != null && file_exists(public_path() . '/user_img/' . $user_details['profile_image'])) { ?>

														<img src="{{ asset("/public/user_img/".$user_details['profile_image']) }}" alt="Profile">

													<?php } else { ?>

														<img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">

													<?php } ?>

												</div>

											</div>

											<div class="media-body">

												<a href="profile"><div class="tabcontent-title connection-profile" id="name{{$buser->connect_user_id}}" data-val="{{ucfirst($user_details['first_name'])}} {{ucfirst($user_details['last_name'])}}">{{ucfirst($user_details['first_name'])}} {{ucfirst($user_details['last_name'])}}</div></a>
											    <div class="connection-profile desc">Writer</div>
		                    					<div class="connection-profile">Connected <?php echo getDays($buser->blocked_date) ?></div>
											</div> 

										</div>

										<div class="message-main text-right">

											<button type="button" class="btn btn-danger" id="btnunblock" onclick="unblockUser({{$buser->connect_user_id}})" >Unblock</button>

										</div>

									</div>

								@endif

							@endforeach
						</div>	
						<?php }else{ ?>
							<div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                    <p class="content_text">Awww ! no Block Users.</p>
                                </div>
                        <?php } ?>        
							<!-- If no block user then start -->

							<!-- <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">

								<span>

									<img src="public/blog_img/no-blog.png"  alt="" height="100px" widht="100px" >

								</span>

								<p class="content_text">Awww ! no block users.</p>

							 </div> -->

							<!-- If no block user then end -->

						</div>
                        <div class="ajaxblocklistaz">
                            <div class="ajax-load text-center" id="ajax-load-connections" style="display:none">
                                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Connections</p>
                            </div>
                            <?php if (isset($block_user_total) && intval($block_user_total) > 0) { ?>
                                <div class="blog_button">
                                    <a href="javascript:;" class="btn btn-primary load_more_blocks" data-page="4" title="Load More">
                                        LOAD MORE
                                    </a>
                                </div>
                            <?php } ?> 
                        </div>
					</div>

				 <!-- Block user diplay section end -->

				</div>

			</div>

		</div>

	</div>

</section>

<script>

function unblockUser(connection_id){

	var name = $('#name'+connection_id).attr('data-val');

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

				data: {'connection_id':connection_id}, 

				success: function (result) {

					if(result==1) {

						/*$("#bookmarkmsg").fadeIn().delay(5000).fadeOut();*/

						$(".blockhide"+connection_id).hide();

						$("#unblock_user").html('You have unblock '+name);

						var x = document.getElementById("unblock_user");

						x.className = "show";

						setTimeout(function(){ x.className = x.className.replace("show", "");

							location.reload(); 

						}, 2000);

					}

				},

				error: function (result) {

					alert(connection_id);

				}

			});

		}

	});   

}

$(document).ready(function () {
	var orderBy = 'ASC';
    $("body").on('click','.load_more_blocks',function(){
        var page = $(this).attr('data-page');
        var search_block = $('#search_block').val();
        $('.ajax-load').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getBlockUsers')}}",
            type: "POST",
            data: {'search_block': search_block,'page':page,'orderBy':orderBy}, 
            success: function (result) {
                if(result) {
                    $('#ajax-load-connections').hide();
                    $('.ajaxblocklistaz').hide();
                    $("#block_more").append(result);
                }
                
            }
        });
    });

    $("body").on('blur','#search_block',function(){
        var page = 0;
        var search_block = $('#search_block').val();
        $('.ajax-load').show();
        $("#block_more").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getBlockUsers')}}",
            type: "POST",
            data: {'search_block': search_block,'page':page,'orderBy':orderBy}, 
            success: function (result) {
                if(result) {
                    $('.ajaxblocklistaz').hide();
                    $('#ajax-load-connections').hide();
                    $("#block_more").append(result);
                }
                
            }
        });
    });

    $("body").on('click','#block_ascending',function () {
        var page = 0;
        orderBy = 'ASC';
        var search_block = $('#search_block').val();
        $('.ajax-load').show();
        $("#block_more").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getBlockUsers')}}",
            type: "POST",
            data: {'search_block': search_block,'page':page,'orderBy':'ASC'}, 
            success: function (result) {
                if(result) {
                    $('.ajaxblocklistaz').hide();
                    $('#ajax-load-connections').hide();
                    $("#block_more").append(result);
                }
                
            }
        });
    });

    $("body").on('click','#block_descending',function () {
        var page = 0;
        orderBy = 'DESC';
        var search_block = $('#search_block').val();
        $('.ajax-load').show();
        $("#block_more").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getBlockUsers')}}",
            type: "POST",
            data: {'search_block': search_block,'page':page,'orderBy':'DESC'}, 
            success: function (result) {
                if(result) {
                    $('.ajaxblocklistaz').hide();
                    $('#ajax-load-connections').hide();
                    $("#block_more").append(result);
                }
                
            }
        });
    });
});

</script>

@endsection

