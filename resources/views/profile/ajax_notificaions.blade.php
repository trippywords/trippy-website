<div class="connection-main-section ajaxfollowerlist1">
<?php if (count($notifications) > 0) { ?>
	@foreach($notifications as $notification)
	    @php
	    $usernotichecked="";
	    @endphp    
	    @if(getNotification_status($notification->id)==1)  
	    @php
	    $usernotichecked=" checked='checked'";
	    @endphp
	    @else
	    @php
	    $usernotichecked="";
	    @endphp
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
<?php } else { ?>
    <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
        <span>
            <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
        </span>
        <p class="content_text">Awww ! no notifications.</p>
    </div>
<?php } ?>
  
</div>
<br>
<div id="ajaxnotificationslistza">
    <div class="ajax-load text-center" id="ajax-load-notifications" style="display:none">
        <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
    </div>
    <?php if (isset($notifications_total) && intval($notifications_total) > 0) { ?>
        <div class="blog_button">
            <a href="javascript:;" class="btn btn-primary" id="load_more_notifications" title="Load More" data-page="{{ $page }}">
                LOAD MORE
            </a>
        </div>
    <?php } ?> 
</div> 