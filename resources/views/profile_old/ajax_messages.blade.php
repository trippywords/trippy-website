	<div class="chatting_section">
		<div class="chatting_section_title">
			<div class="chatroom_heading" data-val="{{$to_user}}">
				@php 
					$touserobj = getUserdetailbyid($to_user);
				@endphp
				<h6 class="title">{{ ucfirst($touserobj->first_name) }} {{ ucfirst($touserobj->last_name) }}</h6>
			</div>
			<div class="online_person_icon" id="online_person_icon">
				<div class="chat_icon">
					<span class="user_number">99+</span>
				</div>
			</div>
		</div>
		<div id="chats_scroll" class="chats_section">
			@for($i = 0; $i < count($user_msg); $i++)
				@php 
					$userobj = getUserdetailbyid($user_msg[$i]['from_user_id']);
				@endphp
			<div class="chats @if($user_msg[$i]['from_user_id'] == Auth::user()->id)
					 chats-me
				@endif">
				<div class="user_details media">
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
							{{ $user_msg[$i]['message'] }}
						</div>
					</div>
				</div>
			</div>
			@endfor
		</div>
		<div class="chat_typing">
			<div class="input-group">
				<input type="hidden" name="to_user_id" id="to_userid" value="{{$touserobj->id}}">
				<input type="text" id="message" class="form-control" placeholder="Hi, Type Here ..." name="search">
				<div class="input-group-btn">
					<button class="btn btn-default send" id="send" type="submit">Send</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#message").keyup(function(event) {
				if (event.keyCode === 13) {
					$("#send").click();
				}
			});
		});
	</script>