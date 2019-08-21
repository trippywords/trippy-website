<div class="connection-main-section ajaxconnlistaz">
                            <?php
                            foreach ($user_connection as $uc) {
                                $userdetail = getUserdetailbyid($uc->connect_user_id);
                                
                            
                            ?>
                            @if($userdetail!=null)
                            <div class="connection-section display-flex-custom blockhide{{$uc->connect_user_id}}">

                                <div class="media">

                                    <div class="media-left">

                                        <div class="profile_pic">
                                            <?php if($userdetail!=null && $userdetail->profile_image!=null && $userdetail->profile_image!=''){ ?>
                                            <img src="{{ asset('/public/user_img/'.$userdetail->profile_image) }}" style="width: 60px;height: 100%;border-radius: inherit;" alt="Profile">
                                            <?php }else{?>
                                            <img src="{{ asset('/public/assets/image/profile.png') }}" alt="Profile">
                                            <?php } ?>

                                        </div>

                                    </div>

                                    <div class="media-body">

                                        <a href="profile/{{ $userdetail->name }}"><div class="tabcontent-title connection-profile"> {{ $userdetail->first_name." ".$userdetail->last_name }}</div></a>

                                        <div class="connection-profile desc">Writer</div>

                                        <div class="connection-profile">Connected <?php echo gethumandate($uc->created_at) ?></div>

                                    </div> 

                                </div>

                                <div class="message-main text-right">

                                    
                                     <button type="button" class="btn btn-success message1" data-val="{{$uc->connect_user_id}}">Message</button>
                                    <button type="button" class="btn btn-danger" onclick="removeConnection(<?php echo $uc->connect_user_id; ?>)">Remove</button>

                                </div>

                            </div>
                            @endif
                            <?php
                            }
                            if(count($user_connection)<=0)
                            {
                            ?>                          
                            <h5 style="color:#57bb47;text-align: center">No Results Found!</h5>
                            <?php
                            }
                            ?>
                           

</div>