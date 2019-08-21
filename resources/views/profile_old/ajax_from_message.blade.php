@php 
	$fromuserobj = getUserdetailbyid(Auth::user()->id);
@endphp
<div class="chats chats-me">
	<div class="user_details media">
		<div class="user_profile bg-red media-left">
			@if($fromuserobj->profile_image)
			<img src="{{ URL::asset('public/user_img/'.$fromuserobj->profile_image) }}" alt="{{ucfirst($fromuserobj->first_name)}} {{ ucfirst($fromuserobj->last_name) }}">
			@else
			{{ ucfirst(substr($fromuserobj->first_name, 0, 1)) }}
			@endif
		</div>
		<div class="user_name font-red media-body">
			<span>{{ ucfirst($fromuserobj->first_name) }} {{ ucfirst($fromuserobj->last_name) }}</span>
			<div class="chat">
				{{ $message_to_send }}
			</div>
		</div>
	</div>
</div>