<div class="connection-main-section ajaxfolllist1">
<?php if (count($block_user ) > 0) { ?> 
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
	<div class="ajaxblocklistaz">
        <div class="ajax-load text-center" id="ajax-load-followings" style="display:none">
            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Followings</p>
        </div>
        <?php if (isset($block_user_total) && intval($block_user_total) > 0) { ?>
            <div class="blog_button">
                <a href="javascript:;" class="btn btn-primary load_more_blocks" data-page="{{ $page }}" title="Load More">
                    LOAD MORE
                </a>
            </div>
        <?php } ?>
    </div>
<?php }else{ ?>                          
    <h5 style="color:#57bb47;text-align: center">No Results Found!</h5>
<?php } ?>
</div>