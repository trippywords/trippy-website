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
	                            <a data-val="{{$req_udata->user_id}}" id="act_action" class="button connect button_accept button_connect" title="Accept" <?php if (isset($req_udata->is_block) && $req_udata->is_block==1) { ?> disabled="disabled" <?php } ?>>
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
<?php }else{ ?>
<div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
    <span>
        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
    </span>
    <p class="content_text">Awww ! no request.</p>
</div>
<?php } ?>
<div class="requestAZ">
<div class="ajax-load text-center" id="ajax-load-requests" style="display:none">
    <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
</div>
<?php if (isset($requserdata_total) && intval($requserdata_total) > 0) { ?>
    <div class="blog_button">
        <a href="javascript:;" class="btn btn-primary" id="load_more_requests" title="Load More" data-page="{{ $page }}">
            LOAD MORE
        </a>
    </div>
<?php } ?> 