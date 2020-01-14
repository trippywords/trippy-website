@if(isset($tab) && $tab=='connections')

	<?php if (!empty($user_connection )) {

        foreach ($user_connection as $uc) {

            $userdetail = getUserdetailbyid($uc->connect_user_id); ?>

            @if($userdetail!=null)

		        <div class="connection-section display-flex-custom blockhide{{$uc->connect_user_id}}">

		            <div class="media">

		                <div class="media-left">

		                    <div class="profile_pic">

		                        <?php if(isset($userdetail->profile_image) && $userdetail->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetail->profile_image)){ ?>

		                        <img src='{{ asset("/public/user_img/".$userdetail->profile_image) }}' alt="Profile">

		                        <?php }else{?>

		                        <img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">

		                        <?php } ?>

		                    </div>

		                </div>

		                <div class="media-body">

		                    <a href="{{ url('profile/'.$userdetail->name) }}"><div class="tabcontent-title connection-profile">  {{ ucfirst($userdetail->first_name)." ".ucfirst($userdetail->last_name) }}</div></a>

		                    <div class="connection-profile desc">Writer</div>

		                    <div class="connection-profile">Connected <?php echo getDays($uc->connection_date) ?></div>

		                </div>

		            </div>

		            <div class="message-main text-right">

		                <!-- <a href="javascript:;" title="" class="message">Message</a>

		                <a href="javascript:;" title="" class="remove">Remove</a> -->

		                <button type="button" class="btn btn-success message open-message" data-toggle="modal" data-target="#myModal" data-val="{{$uc->connect_user_id}}" <?php if (isset($uc->is_block) && $uc->is_block==1) { ?> disabled="disabled" <?php } ?>>Message</button>

		                <button type="button" class="btn btn-danger message-danger" onclick="removeConnection(<?php echo $uc->connect_user_id; ?>)">Remove</button>

		            </div>

		        </div>

        	@endif

    	<?php }

	} ?>

@endif

@if(isset($tab) && $tab=='notification-list')

	@foreach($notifications as $notification)

	    @php $usernotichecked=""; @endphp    

	    @if(getNotification_status($notification->id)==1)  

	    	@php $usernotichecked=" checked='checked'"; @endphp

	    @else

	    	@php $usernotichecked=""; @endphp 

	    @endif

	    <div class="prefrence-toggle-main display-flex-custom">

	        <div class="tabcontent-title">{{ $notification->notification_title }}</div>

	        <div class="switch-main">

	            <label class="switch">

	                <input type="checkbox" class="toggle-input chkunotification" id="chknotid_{{ $notification->id }}" value="{{ $notification->id }}" data-id='{{ $notification->id }}' name="checked_user_notification[]" {{ $usernotichecked }}>

	                <span class="slider round"></span>

	            </label>

	        </div>

	    </div>  

    @endforeach

@endif	

@if(isset($tab) && $tab=='bookmarks')

	<?php if (count($bookmarklist) > 0) {

        foreach($bookmarklist as $bookmark){

            $blogd=getBlogDetails($bookmark->blog_id);  ?>

            <div class="connection-main-section blockhide{{ $bookmark->blog_id }}">

                <div class="connection-section display-flex-custom">

                    <div class="media">

                        <div class="media-left">

                            <div class="profile_pic">

                                <?php if (isset($blogd->blog_image) && $blogd->blog_image != null && file_exists(public_path() . '/blog_img/' . $blogd->blog_image)) { ?>

                                    <img src="{{ asset("/public/blog_img/".$blogd->blog_image) }}" alt="">

                                <?php } else { ?>

                                    <img src="{{ asset('/') }}public/blog_img/no_img.jpg" alt="Blog">

                                <?php } ?>

                            </div>

                        </div>

                        <div class="media-body">

                            <div class="tabcontent-title connection-profile">

                                <a href="{{ url('blogs/'.$blogd->id) }}" target="_blank"><?php echo $blogd->blog_title; ?>

                                </a>

                            </div>

                            <div class="connection-profile desc"><?php echo $blogd->blog_title; ?></div>

                            <div class="connection-profile time">

                                <!-- start -->

                                <span class="font-primary">

                                    <?php $userCre = getUserdetailbyid($blogd->created_by); ?>

                                    <?php if (!empty($userCre)) { ?>

                                        <a target="_blank" href="<?php echo URL::to('/') ?>/profile/<?php echo strtolower($userCre->name); ?>">

                                        <?php echo ucfirst($userCre->first_name)." ".ucfirst($userCre->last_name) ?></a>

                                    <?php } ?>

                                </span>

                                <!-- end -->

                                <?php echo getDays($bookmark->created_at) ?>

                            </div>

                        </div> 

                    </div>

                    <div class="message-main text-right">

                        <!-- <a href="javascript:;" title="" class="remove" onclick="removeBookmark(<?php echo $bookmark->blog_id; ?>)">Remove</a> -->

                        <button type="button" class="btn btn-danger message-danger-full" onclick="removeBookmark(<?php echo $bookmark->blog_id; ?>)">Remove</button>

                    </div>

                </div>

            </div>

        <?php }} ?>

@endif

@if(isset($tab) && $tab=='request')

	<?php if(count($requserdata) > 0){ ?>

    	@foreach($requserdata as $req_udata)

	        <div class="col-lg-6 col-md-12">

	            <div class="profile_page_side_section">

	                <div class="user_profile block_user_profile margin-bottom-30">

	                    <div class="user_image_section">

	                        <div class="profile_section media align-items-center">

	                            <div class="profile_pic media-left">

	                                <?php $userdata=getUserdetailbyid($req_udata->user_id);  ?>

	                                <?php

	                                if (!empty($userdata) && $userdata->profile_image != null && file_exists(public_path() . '/user_img/' . $userdata->profile_image)) {

	                                    ?>

	                                    <img src="{{ asset("/public/user_img/".$userdata->profile_image) }}" alt="Profile">

	                                    <?php

	                                } else {

	                                    ?>

	                                    <img src="{{ asset('/') }}public/assets/image/profile.png" alt="User">

	                                    <?php

	                                }

	                                ?>      

	                            </div>

	                            <div class="media-body user_info">

	                                <a class="name" href="{{ url('profile/'.$userdata['name']) }}">

	                                 <?php 

	                                  echo ucfirst($userdata['first_name'])." ".ucfirst($userdata['last_name']);

	                                  ?> <br>Sent you Request

	                                </a>

	                            </div>

	                        </div>                              

	                    </div>

	                    <div class="user_profile_button">

	                       <!-- start -->

	                                <a data-val="{{$req_udata->user_id}}" id="act_action" class="button connect button_accept button_connect" title="Accept">

	                                    Accept

	                                </a>

	                                <a data-val="{{$req_udata->user_id}}" id="reject_action" title="Reject" class="button connect button_reject button_connect">

	                                    Reject

	                                </a>  

	                        <!-- end -->        

	                    </div>

	                </div>

	            </div>

	        </div>

		@endforeach

	<?php } ?>	

@endif	

@if(isset($tab) && $tab=='following')

	<?php if (count($user_follower ) > 0) {

        foreach ($user_follower as $uf) {

            $userdetail = getUserdetailbyid($uf->follower_id); ?>

                @if($userdetail!=null)

		            <div class="connection-section display-flex-custom blockhide{{$uf->follower_id}}">

		                <div class="media">

		                    <div class="media-left">

		                        <div class="profile_pic">

		                            <?php if(isset($userdetail->profile_image) && $userdetail->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetail->profile_image)){ ?>

		                            <img src='{{ asset("/public/user_img/".$userdetail->profile_image) }}' alt="Profile">

		                            <?php }else{?>

		                            <img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">

		                            <?php } ?>

		                        </div>

		                    </div>

		                    <div class="media-body">

		                        <a href="{{ url('profile/'.$userdetail->name) }}"><div class="tabcontent-title connection-profile" id="name{{$uf->follower_id}}" data-name="{{ ucfirst($userdetail->first_name).' '.ucfirst($userdetail->last_name) }}">{{ ucfirst($userdetail->first_name)." ".ucfirst($userdetail->last_name) }}</div></a>

		                        <div class="connection-profile desc">Writer</div>

		                        <div class="connection-profile">Connected <?php echo getDays($uf->created_at) ?></div>

		                    </div> 

		                </div>

		                <div class="message-main text-right">

		                    <!-- <a href="javascript:;" title="" class="message">Following</a>

		                    <a href="javascript:;" title="" class="remove">Remove</a> --><!-- 

		                    <button type="button" class="btn btn-success">Following</button> -->

		                    <button type="button" class="btn btn-danger message-danger-full" onclick="removefollowing(<?php echo $uf->follower_id; ?>)">Remove</button>

		                </div>

		            </div>

		        @endif

    <?php }} ?>

@endif	

@if(isset($tab) && $tab=='followers')

	<?php if (!empty($user_followers )) { ?>

        <?php foreach ($user_followers as $uf) {

            $userdetail = getUserdetailbyid(isset($uf->user_id)?$uf->user_id:0); ?>

            <?php if($userdetail!=null){ ?>

                <div class="connection-section display-flex-custom blockhide{{$uf->user_id}}">

                    <div class="media">

                        <div class="media-left">

                            <div class="profile_pic">

                                <?php if(isset($userdetail->profile_image) && $userdetail->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetail->profile_image)){ ?>

                                <img src='{{ asset("/public/user_img/".$userdetail->profile_image) }}' alt="Profile">

                                <?php }else{?>

                                <img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">

                                <?php } ?>

                            </div>

                        </div>

                        <div class="media-body">

                            <a href="{{ url('profile/'.$userdetail->name) }}"><div class="tabcontent-title connection-profile" id="username{{$uf->user_id}}" data-name="{{ ucfirst($userdetail->first_name).' '.ucfirst($userdetail->last_name) }}">{{ ucfirst($userdetail->first_name)." ".ucfirst($userdetail->last_name) }}</div></a>

                            <div class="connection-profile desc">Writer</div>

                            <div class="connection-profile">Connected <?php echo getDays($uf->created_at) ?></div>

                        </div> 

                    </div>

                    <div class="message-main text-right">

                        <!-- <a href="javascript:;" title="" class="message">Following</a>

                        <a href="javascript:;" title="" class="remove">Remove</a> --><!-- 

                        <button type="button" class="btn btn-success">Following</button> -->

                        <button type="button" class="btn btn-danger" onclick="removefollower(<?php echo $uf->user_id; ?>)">Remove</button>



                    </div>

                </div>

        <?php } } ?>

    <?php } ?>

@endif