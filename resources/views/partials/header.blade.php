<header>
	<div class="header-main header-main-secondary">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3 col-md-4 col-sm-4">
					<div class="logo">
						<?php
							if(Auth::user()){
								$url = url("/");
							}else{
								$url = url("/");
							}
						$is_first_login = Session::get('is_first_login'); ?>
						<a <?php if(isset($is_first_login) && intval($is_first_login) ==1 ){ ?> href="javascript:void(0);" onclick="return confirm(' Please select preferences.');" <?php }else{ ?> href="{{ $url }}" <?php } ?>  title="TrippyWords" >
							<img src="{{ asset('/public/assets/image/logo.png')}}" alt="TrippyWords" >
						</a>
					</div>
				</div>
				
				<div class="col-lg-9 col-md-8 col-sm-8">
					<?php if(isset($is_first_login) && intval($is_first_login) !=1 ){ ?> 
					<ul class="header-menubar-section">
						<li class="menus header-search">
							<form method="post" id="search" action="{{ url('blog/search') }}" >
		                  		@csrf
		                  		<div class="input-group search">
                                    @php
                                       if(isset($blogTitle)){
                                       if($value="70 of the best blogs for creative inspiration"){
                                       	    $value = "";
                                        }else{
                                       		$value = $blogTitle;
                                   		}
                                       }else{
                                          $value = ""; 
                                       }
                                    @endphp
			                    	<input type="text" name="title" id="title" class="form-control spacebar" value="{{ $value }}" placeholder="Search Blog">
			                    	<div class="input-group-append">
			                    		<button type="submit" class="btn-search" id="btn_search">
			                    			<i class="fa fa-search" aria-hidden="true"></i>
			                    		</button>
			                        	<!-- <a href="javascript:;" title="Search" class="btn-search">
			                        		<i class="fa fa-search" aria-hidden="true"></i>
			                       		</a> -->
			                    	</div>
			                    	<div id="search_toast">Please enter keyword</div>
		                  		</div>
		                  	</form>
                		</li>
						<?php if(Auth::user()): ?>
						<li class="menus sub-menu-section-icon">

							<a href="javascript:;" class="profile_section" title="Profile">

								<div class="profile_image">

									<!-- <i class="fa fa-user"></i> -->

									<?php if(Auth::user()): ?>
										<?php if (isset(Auth::user()->profile_image) && Auth::user()->profile_image != null && file_exists(public_path() . '/user_img/' .Auth::user()->profile_image)) { ?>
											<img src="{{ asset("/public/user_img/".Auth::user()->profile_image) }}" alt="">
										<?php } else { ?>
											<img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">
										<?php } ?>

									<?php else: ?>

											<img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">

									<?php endif; ?>

								</div>

								<span class="user_name">

									<?php if(Auth::user()): ?>

										{{ ucwords(Auth::user()->first_name)." ".ucwords(Auth::user()->last_name) }}

									<?php endif; ?>

								</span>

								<span class="icon-arrow-down"></span>

							</a>
							<div class="sub-menu-section sub-menu-section-profile">

								<div class="row custom-row-profile">

									<div class="profile_li">

										<a href="{{ route('profile') }}" class="profile_menus" title="">

											<span class="icon-user-profile"></span>

											<span class="text">Profile</span>

										</a>

									</div>

									<div class="profile_li">

										<a href="{{ route('preference-list') }}" class="profile_menus" title="">

											<span class="icon-table-grid"></span>

											<span class="text">Preferences</span>

										</a>

									</div>

									<div class="profile_li">

										<a href="{{ url('blog-category') }}" class="profile_menus" title="">

											<span class="icon-table-grid"></span>

											<span class="text">Trippyfeeds</span>

										</a>

									</div>

									<div class="profile_li">

										<a href="{{ route('connections') }}" class="profile_menus" title="">

											<span class="icon-link"></span>

											<span class="text">Connections</span>

										</a>

									</div>

									<div class="profile_li">

										<a href="{{ route('following') }}" class="profile_menus" title="">



											<span class="icon-wifi"></span>

											<span class="text">Following</span>

										</a>

									</div>
									<div class="profile_li">
										<a href="{{ url('followers') }}" class="profile_menus" title="">
											<span class="icon-wifi"></span>
											<span class="text">Followers</span>
										</a>
										
									</div>   
									<div class="profile_li">
							                    <a href="{{ route('blockuserlist') }}" class="profile_menus" title="">
							                      <span class="icon fa fa-ban"></span>
							                      <span class="text">Block Users</span>
							                    </a>
							                  </div>
									<div class="profile_li">

										<a href="{{ route('bookmarks') }}" class="profile_menus" title="">

											<span class="icon-save-bookmark"></span>

											<span class="text">Bookmarks</span>

										</a>

									</div>

									<div class="profile_li">

										<a href="{{ route('notification-list') }}" class="profile_menus" title="">

											<span class="fa fa-bell"></span>

											<span class="text">Notification List</span>

										</a>

									</div>

									<div class="profile_li">

										<a href="{{ route('account-details') }}" class="profile_menus" title="">

											<span class="icon-briefcase"></span>

											<span class="text">Account Details</span>

										</a>

									</div>

									<div class="profile_li">

										<a href="{{ route('social') }}" class="profile_menus" title="">

											<i class="fa fa-twitter" aria-hidden="true"></i>

											<span class="text">Social</span>

										</a>

									</div>

									@hasrole('super-admin')                            

									<div class="profile_li">

										<a href="{{ route('admin-panel') }}" class="profile_menus" title="">

											<i class="fa fa-user" aria-hidden="true"></i>

											<span class="text">Admin Panel</span>

										</a>

									</div>

									 @endhasrole

									 <div class="profile_li">

										<a href="{{ route('request') }}" class="profile_menus" title="">

											<i class="fa fa-user-plus" aria-hidden="true"></i>

											<span class="text">Request</span>

										</a>

									 </div>   

									 <div class="profile_li">

										<a href="{{ route('people') }}" class="profile_menus" title="">

											<i class="fa fa-users" aria-hidden="true"></i>

											<span class="text">People</span>

										</a>

									</div>
									
									<div class="profile_li">

										<a href="{{ route('messages') }}" class="profile_menus" title="">

											<i class="fa fa-envelope" aria-hidden="true"></i>

											<span class="text">Messages</span>

										</a>

									</div>

									 <div class="profile_li">

										<a href="{{ route('logout') }}" class="profile_menus" title="">

											<i class="fa fa-sign-out" aria-hidden="true"></i>

											<span class="text">Logout</span>

										</a>

									</div>                       

								</div>

							</div>
							
						</li>
						<?php endif; ?> 
					</ul>
					<?php } ?>
				</div>
			</div>
			<div class="text-center">
				<script>
					$(document).ready(function(){
						if($("#snackbar").length > 0){
							var x = document.getElementById("snackbar");
							x.className = "show";
							setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
						}

						/*Spacebar and comma validation starts*/
						$(".spacebar").keydown(function (e) {
				            if (e.keyCode == 32) { 
				               $(this).val($(this).val() + " "); 
				               return false; 
				            }
				            if (e.keyCode == 188) { 
				               $(this).val($(this).val() + ","); // append '-' to input
				               return false; // return false to prevent space from being added
				            }
				        });
						/*Spacebar validation ends*/

						/*No input submission in searchbox validation start*/
						$("body").on('click',"#btn_search",function(){     
							var search = $.trim($('#title').val()); 
							if(search == "" || search == null){
								var x = document.getElementById("search_toast");
								x.className = "show";
								setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
								return false;
							}
					    });
						/*No input submission in searchbox validation ends*/
					});
				</script>
				@if (Session::has('news_error_msg'))
					<!-- <div id="news_error_msg" style="color:red;font-size:22px;">{{ Session::get('news_error_msg') }}</div> -->
					<div id="snackbar">{{ Session::get('news_error_msg') }}</div>
				@endif
				@if (Session::has('news_success_msg'))
					<!-- <div id="news_success_msg" style="color:green;font-size:22px;">{{ Session::get('news_success_msg') }}</div> -->
					<div id="snackbar">{{ Session::get('news_success_msg') }}</div>
				@endif
			</div>
		</div>
	</div>
</header>
<script>
	/* Search Button Section S */
	$(document).ready(function(){
	$('#title').keypress(function (e) {
	 	if (e.which == 13) {
	   		$('#search').submit();
	   		return false;    //<---- Add this line
	 	}
	});
		$(".header-menubar-section .search_section .input-group-btn").click(function(){
			$(".header-menubar-section .search_section .form-control").css({"width": "250px", "border-left": "2px solid #9c9c9c", "margin-left":"15px" , "padding-left":"5px", "transition":"1.5s"}).focus();
		});
		$(".header-menubar-section .search_section .form-control").focusout(function(){
			$(".header-menubar-section .search_section .form-control").css({
				"height": "15px",
				"width": "0px",
				"border-color": "transparent",
				"border-left": "2px solid transparent",
				"padding": "0px",
				"margin-left": "0px",
				"transition": "1.5s"
			});
		});      
	});
	setTimeout(function() {
		$('#news_error_msg').hide();
		$('#news_success_msg').hide();
	}, 10000);
</script>