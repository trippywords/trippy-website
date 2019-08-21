 @if(count($ouserdetails)>0)
        @foreach($ouserdetails as $userdetails)
            <div class="col-lg-4 col-md-6">
                <div class="profile_page_side_section">
                    <div class="user_profile block_user_profile margin-bottom-30">
                        <div class="user_image_section">                                    
                            <div class="profile_section media align-items-center">
                                <div class="profile_pic media-left">
                                    <?php
                                    if ($userdetails != null && $userdetails->profile_image != null) {
                                        ?>                                                                                                                    
                                        <img src="{{ asset("/public/user_img/".$userdetails->profile_image) }}" alt="Profile">
                                        <?php
                                    } else {
                                        ?>
                                        <img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="media-body user_info">
                                    <?php
                                    if ($userdetails != null) {
                                        ?>   
                                    <a href="{{ url("profile/".$userdetails->name) }}" class="name">
                                        {{ ucfirst($userdetails->first_name)." ".ucfirst($userdetails->last_name) }}
                                    </a>       
                                    <div class="designation">Writer</div>
                                     <div class="followers">
                                        <span class="number"><?php echo getFollowercount($userdetails->id); ?></span> Followers
                                    </div>
                                        <?php
                                    } else {
                                        echo "User Not found";
                                    }
                                    ?>  
                                </div>
                            </div>
                            <div class="social_icon">
                                <div class="text-right">
                                    <?php if ($userdetails != null && $userdetails->social_icon_status == '1') { ?>
                                        <?php if ($userdetails != null && $userdetails->facebook_id != null) { ?>
                                            <a target="_blank" href="https://www.facebook.com/<?php echo $userdetails->facebook_id ?>"><i class="fa fa-facebook" style="font-size: 20px;color:white"></i></a>&nbsp;&nbsp;
                                        <?php } ?>
                                        <?php if ($userdetails != null && $userdetails->twitter_id != null) { ?>
                                            <a target="_blank" href="https://twitter.com/<?php echo $userdetails->twitter_id ?>"><i class="fa fa-twitter" style="font-size: 20px;color:white"></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                       <div class="user_profile_button">                               
                            <!-- <a href="{{URL::to('connect',array('id'=>$userdetails->id))}}" title="Connect" class="button connect"> -->
                            <?php if(checkConnectionReqStatus(Auth::user()->id,$userdetails->id)==1): ?>
                                <a data-val="{{$userdetails->id}}" id="userdetails_id" class="button connect" title="Connect">
                        <?php else: ?>
                            <a data-val="{{$userdetails->id}}" id="userdetails_id" class="button connect button_connect" title="Connect">
                                <?php endif; ?>
                                <?php if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==0 && checkConnectionReqStatus(Auth::user()->id,$userdetails->id)==0){ echo "Connect"; }else{ if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==0 && checkConnectionReqStatus(Auth::user()->id,$userdetails->id)==1){ echo "Request sent"; }else { echo "Connected";} }?>
                            </a>
                            <!-- <a href="{{URL::to('follow',array('id'=>$userdetails->id))}}" title="Follow" class="button follow"> -->
                            <a data-val="{{$userdetails->id}}" id="userdetails_id" class="button follow button_follow" title="Follow">
                            <?php if(checkFollowerStatus(Auth::user()->id,$userdetails->id)==0 || checkFollowerStatus(Auth::user()->id,$userdetails->id)==null){ echo "Follow"; }else{ echo "Following"; }?>
                            </a>                                 
                       </div>
                    </div>
                </div>
            </div> 
        </div>               
        @endforeach
        @else
            <div class="profile_page_main_section">
                <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center" style="background-color:#fff !important;">
                    <p class="content_text">No result found</span></p>
                </div>            
            </div>
    @endif
