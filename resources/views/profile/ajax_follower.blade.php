<div class="connection-main-section ajaxfollowerlist1">

<?php if (count($user_followers ) > 0) { ?>
@foreach ($user_followers as $uf)



	@php



		$userdetail = getUserdetailbyid($uf->user_id);



	@endphp



	<div id="{{$uf->user_id}}" class="connection-section display-flex-custom blockhide{{$uf->user_id}}">



		<div class="media">



			<div class="media-left">



				<div class="profile_pic">

					<?php if (isset($userdetail->profile_image) && $userdetail->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetail->profile_image)) { ?>

						<img src="{{ asset('/public/user_img/'.$userdetail->profile_image) }}" style="width: 60px;height: 100%;border-radius: inherit;" alt="Profile">

					<?php } else { ?>

						<img src="{{ asset('/') }}public/assets/image/profile.png" style="width: 60px;height: 100%;border-radius: inherit;" alt="Profile">

					<?php } ?>

				</div>



			</div>



			<div class="media-body">



				<a href="{{url('profile/'.$userdetail->name)}}">



					<div class="tabcontent-title connection-profile">



						{{ ucfirst($userdetail->first_name)." ".ucfirst($userdetail->last_name) }}



					</div>



				</a>



				 <div class="connection-profile desc">Writer</div>



				 	<div class="connection-profile">Connected <?php echo getDays($uf->followed_at);?></div>



			</div> 



		</div>



		<div class="message-main text-right">



			<button type="button" class="btn btn-danger" onclick="removefollower(<?php echo $uf->user_id; ?>)">Remove</button>



		</div>



	</div>



@endforeach
<div class="ajaxfollowerlistza">
	<div class="ajax-load text-center" id="ajax-load-followers" style="display:none">
	    <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Followings</p>
	</div>
	<?php if (isset($user_followers_total) && intval($user_followers_total) > 0) { ?>
	    <div class="blog_button">
	        <a href="javascript:;" class="btn btn-primary load_more_followers" data-page="{{ $page }}" title="Load More">
	            LOAD MORE
	        </a>
	    </div>
	<?php } ?> 
	<?php }else{?>
	    <h5 style="color:#57bb47;text-align: center">No Results Found!</h5>
	<?php } ?>
</div>
</div>