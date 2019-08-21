@extends('layouts.app')

@section('title',"Messages")

@section('content')

<section>

	<div class="chatroom_page">

		<dir class="container">

			<!-- Chatroom Section S -->

			<div class="chatroom_section">

				<div class="row custom-row">

					<!-- Online People Section -->

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 online_section_modal" id="online_section_modal">

						<div class="chatting_online_section">

							<div class="chatting_online_section_title">

								<h6 class="title">Messages</h6>
								<span id="blockedMess_toats">This User has been blocked</span>
								<div class="online_section_modal_close">

									<i class="fa fa-close" id="online_section_modal_close"></i>

								</div>

							</div>

							<div class="online_list">

								@for($i = 0; $i < count($user_unique); $i++)

									@php 

										$userobj = getUserdetailbyid($user_unique[$i]);

									@endphp

								<div class="online-user-details">

									<a href="javascript:;" data-val="{{ $userobj->id }}" class="online_user-main usermessage">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-ocean-blue">

													@if(isset($userobj->profile_image) && $userobj->profile_image != null && file_exists(public_path() . '/user_img/' . $userobj->profile_image))

													<img src="{{ URL::asset('public/user_img/'.$userobj->profile_image) }}" alt="{{ucfirst($userobj->first_name)}} {{ ucfirst($userobj->last_name) }}">

													@else

													{{ ucfirst(substr($userobj->first_name, 0, 1)) }}

													@endif

												</div>

												<div class="user_name font-ocean-blue">

													{{ ucfirst($userobj->first_name) }} {{ ucfirst($userobj->last_name) }}

												</div>

											</div>

										</div>

									</a>

								</div>

								@endfor

							<!--

								<div class="online-user-details">

									<a href="#" title="Christine E. Keegan" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile">

													<img src="assets/image/team1.jpg" alt="C">

												</div>

												<div class="user_name">

													Christine E. Keegan

												</div>

			 								</div>

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Daniel G. Tipton" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-orange">

													D

												</div>

												<div class="user_name font-orange">

													Daniel G. Tipton

												</div>

											</div>

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Mark S. Arnone" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile">

													<img src="assets/image/team2.jpg" alt="M">

												</div>

												<div class="user_name font-">

													Mark S. Arnone

												</div>

											</div>

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Terence V. Albers" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-orange">

													T

												</div>

												<div class="user_name font-orange">

													Terence V. Albers

												</div>

											</div>									

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Amber R. Abad" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-ocean-blue">

													A

												</div>

												<div class="user_name font-ocean-blue">

													Amber R. Abad

												</div>

											</div>

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Christine E. Keegan" class="online_user-main"> 

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile">

													<img src="assets/image/team1.jpg" alt="C">

												</div>

												<div class="user_name">

													Christine E. Keegan

												</div>

											</div>

										</div>

									</a>	

								</div>

								<div class="online-user-details">

									<a href="#" title="Daniel G. Tipton" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-orange">

													D

												</div>

												<div class="user_name font-orange">

													Daniel G. Tipton

												</div>

											</div>

										</div>

									</a>	

								</div>

								<div class="online-user-details">

									<a href="#" title="Mark S. Arnone" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile">

													<img src="assets/image/team2.jpg" alt="M">

												</div>

												<div class="user_name font-">

													Mark S. Arnone

												</div>

											</div>

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Terence V. Albers" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-orange">

													T

												</div>

												<div class="user_name font-orange">

													Terence V. Albers

												</div>

											</div>									

										</div>						

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Amber R. Abad" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-ocean-blue">

													A

												</div>

												<div class="user_name font-ocean-blue">

													Amber R. Abad

												</div>

											</div>

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Christine E. Keegan" class="online_user-main"> 

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile">

													<img src="assets/image/team1.jpg" alt="C">

												</div>

												<div class="user_name">

													Christine E. Keegan

												</div>

											</div>

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Daniel G. Tipton" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-orange">

													D

												</div>

												<div class="user_name font-orange">

													Daniel G. Tipton

												</div>

											</div>

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Mark S. Arnone" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile">

													<img src="assets/image/team2.jpg" alt="M">

												</div>

												<div class="user_name font-">

													Mark S. Arnone

												</div>

											</div>

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Terence V. Albers" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-orange">

													T

												</div>

												<div class="user_name font-orange">

													Terence V. Albers

												</div>

											</div>									

										</div>

									</a>

								</div>

								<div class="online-user-details">

									<a href="#" title="Amber R. Abad" class="online_user-main">

										<div class="online_user">

											<div class="d-flex justify-content-start align-items-center">

												<div class="user_profile bg-ocean-blue">

													A

												</div>

												<div class="user_name font-ocean-blue">

													Amber R. Abad

												</div>

											</div>

										</div>

									</a>

								</div>

						-->

							</div>

						</div>

					</div>

					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 ajaxmessage">

						<div class="chatting_section">

							<div class="chatting-right-section">

								@php 

									$user = getUserdetailbyid(Auth::user()->id);

								@endphp

								<div class="chatting-rigth-box">

									<div class="chatting-image">

										<div class="user_profile">

										<?php if(isset($user->profile_image) && $user->profile_image != null && file_exists(public_path() . '/user_img/' . $user->profile_image)): ?>

											<img src="{{ URL::asset('public/user_img/'.$user->profile_image) }}" alt="{{ucfirst($user->first_name)}} {{ ucfirst($user->last_name) }}">

										<?php else: ?>

											<img src="{{asset("/public/assets/image/profile.png")}}" alt="Profile">

										<?php endif; ?>

										</div>

									</div>

									<div class="chatting-heading">

										<h2 class="main-title">Welcome, {{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</h2>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!-- Chatroom Section S -->

		</div>

	</dir>

</section>

@endsection

@section('js')

<script type="text/javascript">

	$(document).ready(function(){

	    $(".header-secondary .header-main .container").removeClass("container").addClass("container-fluid");

	    /* Attacment Div */

	    $(".attachment-div").hide();

	    $(".icon-attachment").click(function(){

	    	$(".attachment-div").fadeToggle(200);	

	    })

		//$(document).on('click','.usermessage',function(){

		$(".usermessage").click(function () {

			
					

			if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
        		$("footer").addClass('footer-height-custom');
		    }else{
		        $("footer").removeClass('footer-height-custom');
		    }
		    $(window).resize(function(){
		        if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
		            $("footer").addClass('footer-height-custom');
		        }else{
		            $("footer").removeClass('footer-height-custom');
		        }
		    });

			var ScreenHeight = $(window).height();

			var HeaderHeight = $(".header-main").height();

			var FooterHeight = $(".copyright-main").height();

			var ChatroomPageHeight = ScreenHeight - (HeaderHeight + FooterHeight);

			var ChatroomSectionHeight = (ChatroomPageHeight - 30);

		    if($(window).width() < 768)
			{
			   $(".chatting_section").height(ChatroomSectionHeight + 100);
			   $(".chats_section").height(ChatroomSectionHeight - 180);
			} else {
			   $(".chats_section").height(ChatroomSectionHeight - 180);
			}

			var userid = $(this).data("val");

			$.ajax({

				url: "getmessages",

				type:"GET",

				data: {'userid': userid},

				success: function (result) {

//alert(result);

					$(".ajaxmessage").html(result);

					var ScreenHeight = $(window).height();

					var HeaderHeight = $(".header-main").height();

					var FooterHeight = $(".copyright-main").height();

					var ChatroomPageHeight = ScreenHeight - (HeaderHeight + FooterHeight);

					var ChatroomSectionHeight = (ChatroomPageHeight - 30);

					$(".chatting_section").height(ChatroomSectionHeight);

					$(".chats_section").height(ChatroomSectionHeight - 180);

					var wtf = $('#chats_scroll');

					var height = wtf[0].scrollHeight;

					wtf.scrollTop(height);

				}

			});

		});

		$(document).on('click','#send',function(){

			var message = $.trim($("#message").val());
			if (message!=undefined && message!='') {
				var to_user_id = $("#to_userid").val();

				$.ajax({

					url: "storemessage",

					type: "GET",

					data: { 'touserid': to_user_id, 'message': message },

					success: function (result) {
						if (result==0) {
							$("#message").val("");
							var x = document.getElementById("blockedMess_toats");
							$('#blockedMess_toats').text('This User has been blocked');
	                        x.className = "show";
	                        setTimeout(
	                            function(){ 
	                                x.className = x.className.replace("show", ""); 
	                            }, 3000);
	                        //setTimeout(function(){location.reload();}, 1000);
	                        return false;  
						}else{
							if (result==2) {
								var x = document.getElementById("blockedMess_toats");
								$('#blockedMess_toats').text('Please enter message');
		                        x.className = "show";
		                        setTimeout(
		                            function(){ 
		                                x.className = x.className.replace("show", ""); 
		                            }, 3000);
		                        //setTimeout(function(){location.reload();}, 1000);
		                        return false;  
							}else{
								$(".chats_section").append(result);
								$("#message").val("");
							}
							
						}		
					},

					error: function (result) {

					}

				});
			}else{
				var x = document.getElementById("blockedMess_toats");
				$('#blockedMess_toats').text('Please enter message');
                x.className = "show";
                setTimeout(
                    function(){ 
                        x.className = x.className.replace("show", ""); 
                    }, 3000);
                //setTimeout(function(){location.reload();}, 1000);
                return false;  
			}	

		});

	});

	$(window).resize(function () {

		$(function() {

			

			var elmnt = document.getElementById("chats_scroll");

			elmnt.scrollIntoView(false);

		

			var ScreenHeight = $(window).height();

			console.log(ScreenHeight);



			var HeaderHeight = $(".header-main").height();

			console.log(HeaderHeight);



			var FooterHeight = $(".copyright-main").height();

			console.log(FooterHeight);



			var ChatroomPageHeight = ScreenHeight - (HeaderHeight + FooterHeight);

			$(".chatroom_page").height(ChatroomPageHeight);

			console.log(ChatroomPageHeight);



			/*var ChatroomTopHeight = $(".chatroom_top").height();

			console.log(ChatroomTopHeight);*/



			var ChatroomSectionHeight = (ChatroomPageHeight - 30);

			$(".chatting_section").height(ChatroomSectionHeight);

			console.log(ChatroomSectionHeight);



			var chatSectionTitleHeight = $(".chatting_section_title").height();

			var chatTypingHeight = $(".chat_typing").height();



			var customTotalHeight = chatSectionTitleHeight + chatTypingHeight;

			console.log(customTotalHeight);



			var chatSectionHeight = (ChatroomSectionHeight - customTotalHeight);

			$(".chats_section").height(ChatroomSectionHeight - 180);



			/*var ChatroomSectionHeight = PeopleSection;*/

			$(".chatting_online_section").height(ChatroomSectionHeight);

			/*console.log(PeopleSection);*/



			var ChattingOnlineSectionTitleHeight = $(".chatting_online_section_title").height();

			console.log(ChattingOnlineSectionTitleHeight);



			var OnlineListHeight = ((ChatroomSectionHeight - ChattingOnlineSectionTitleHeight) - 0);

			$(".online_list").height(OnlineListHeight);

			console.log(OnlineListHeight);



			if($(window).width() < 768)

			{

			   $(".chats_section").height(ChatroomSectionHeight - 190);

			} else {

			   $(".chats_section").height(ChatroomSectionHeight - 180);

			}

		});

	});

	$(function() {

		

		

		var ScreenHeight = $(window).height();

		console.log(ScreenHeight);



		var HeaderHeight = $(".header-main").height();

		console.log(HeaderHeight);



		var FooterHeight = $(".copyright-main").height();

		console.log(FooterHeight);



		var ChatroomPageHeight = ScreenHeight - (HeaderHeight + FooterHeight);

		$(".chatroom_page").height(ChatroomPageHeight);

		console.log(ChatroomPageHeight);



		/*var ChatroomTopHeight = $(".chatroom_top").height();

		console.log(ChatroomTopHeight);*/



		var ChatroomSectionHeight = (ChatroomPageHeight - 150);

		$(".chatting_section").height(ChatroomSectionHeight);

		console.log(ChatroomSectionHeight);



		var chatSectionTitleHeight = $(".chatting_section_title").height();

		var chatTypingHeight = $(".chat_typing").height();



		var customTotalHeight = chatSectionTitleHeight + chatTypingHeight;

		console.log(customTotalHeight);



		var chatSectionHeight = (ChatroomSectionHeight - customTotalHeight);

		$(".chats_section").height(ChatroomSectionHeight - 180);



		/*var ChatroomSectionHeight = PeopleSection;*/

		$(".chatting_online_section").height(ChatroomSectionHeight);

		/*console.log(PeopleSection);*/



		var ChattingOnlineSectionTitleHeight = $(".chatting_online_section_title").height();

		console.log(ChattingOnlineSectionTitleHeight);



		var OnlineListHeight = ((ChatroomSectionHeight - ChattingOnlineSectionTitleHeight) - 0);

		$(".online_list").height(OnlineListHeight);

		console.log(OnlineListHeight);



		if($(window).width() < 768)

		{

		   $(".chatting_section").height(ChatroomSectionHeight + 100);
		   $(".chats_section").height(ChatroomSectionHeight - 190);

		} else {

		   $(".chats_section").height(ChatroomSectionHeight - 180);

		}

	});

	/* Online People Section S */

	$(function() {

		var Modal = document.getElementById("online_section_modal");

	    $("#online_person_icon").click(function(){

	    	$("#online_section_modal").show();

	    });



	    $("#online_section_modal_close").click(function(){

	    	$("#online_section_modal").hide();

	    });



	   /* window.onclick = function(event) {

		    if (event.target == Modal) {

		        Modal.style.display = "none";

		    }

		}*/	

	});

	function autoRefresh_div(userid) {



		if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
        		$("footer").addClass('footer-height-custom');
		    }else{
		        $("footer").removeClass('footer-height-custom');
		    }
		    $(window).resize(function(){
		        if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
		            $("footer").addClass('footer-height-custom');
		        }else{
		            $("footer").removeClass('footer-height-custom');
		        }
		});

		    var ScreenHeight = $(window).height();

			var HeaderHeight = $(".header-main").height();

			var FooterHeight = $(".copyright-main").height();

			var ChatroomPageHeight = ScreenHeight - (HeaderHeight + FooterHeight);

			var ChatroomSectionHeight = (ChatroomPageHeight - 30);
			
		    if($(window).width() < 768)
			{
			   $(".chatting_section").height(ChatroomSectionHeight + 100);
			   $(".chats_section").height(ChatroomSectionHeight - 190);
			} else {
			   $(".chats_section").height(ChatroomSectionHeight - 180);
			}

   		var userid = $('.chatroom_heading').attr("data-val");

   		if(userid != '' && userid != null){

			$.ajax({

				url: "refreshmessage",

				type:"GET",

				data: {'userid': userid},

				success: function (result) {

						$("#chats_scroll").html(result);

						var ScreenHeight = $(window).height();

						var HeaderHeight = $(".header-main").height();

						var FooterHeight = $(".copyright-main").height();

						var ChatroomPageHeight = ScreenHeight - (HeaderHeight + FooterHeight);

						var ChatroomSectionHeight = (ChatroomPageHeight - 30);

						$(".chatting_section").height(ChatroomSectionHeight);

						$(".chats_section").height(ChatroomSectionHeight - 180);

						var wtf = $('#chats_scroll');

	                   	var height = wtf[0].scrollHeight;

	                   	wtf.scrollTop(height);

				}

			});	

   		}

	}

	setInterval(autoRefresh_div, 5000); // every 5 seconds

	autoRefresh_div();

</script>

@endsection