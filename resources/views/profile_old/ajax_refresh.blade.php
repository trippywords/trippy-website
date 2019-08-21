@for($i = 0; $i < count($user_msg); $i++)
		@php 
			$userobj = getUserdetailbyid($user_msg[$i]['from_user_id']);
		@endphp
	<div class="chats @if($user_msg[$i]['from_user_id'] == Auth::user()->id)
			 chats-me
		@endif">
		<div class="user_details media" style="width:100%;">
			<div class="user_profile bg-red media-left">
				@if($userobj->profile_image)
				<img src="{{ URL::asset('public/user_img/'.$userobj->profile_image) }}" alt="{{ucfirst($userobj->first_name)}} {{ ucfirst($userobj->last_name) }}">
				@else
				{{ ucfirst(substr($userobj->first_name, 0, 1)) }}
				@endif
			</div>
			<div class="user_name font-red media-body">
				<span class="user_profile_name">{{ ucfirst($userobj->first_name) }} {{ ucfirst($userobj->last_name) }}</span>
				<div class="chat-time" style="@if($user_msg[$i]['from_user_id'] == Auth::user()->id) text-align: left; @else text-align: right; @endif">
					{{ $user_msg[$i]['created_at']}}</div>
				<div class="chat">
					{{ $user_msg[$i]['message'] }} <br>
					<!-- {{ $user_msg[$i]['created_at']}} -->
				</div>
			</div>
		</div>
	</div>
	@endfor