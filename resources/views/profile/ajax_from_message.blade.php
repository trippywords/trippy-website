@php 



	$fromuserobj = getUserdetailbyid(Auth::user()->id);



@endphp



<div class="chats chats-me">



	<div class="user_details media">



		<div class="user_profile bg-red media-left">

			<?php if (isset($fromuserobj->profile_image) && $fromuserobj->profile_image != null && file_exists(public_path() . '/user_img/' . $fromuserobj->profile_image)) { ?>

				<img src="{{ asset('/public/user_img/'.$fromuserobj->profile_image) }}" alt="{{ucfirst($fromuserobj->first_name)}} {{ ucfirst($fromuserobj->last_name) }}">

			<?php } else {

				echo ucfirst(substr($fromuserobj->first_name, 0, 1));

			} ?>

		</div>



		<div class="user_name font-red media-body">



			<span>{{ ucfirst($fromuserobj->first_name) }} {{ ucfirst($fromuserobj->last_name) }}</span>



			<div class="chat">



				{{ $message_to_send }}



			</div>



		</div>



	</div>



</div>