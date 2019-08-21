<div class="connection-main-section ajaxconnlistaz">
                            <?php
    if (count($user_connection) > 0){
                            foreach ($user_connection as $uf) {
                                $userdetail = getUserdetailbyid($uf);
                                
                            
                            ?>
                            @if($userdetail!=null)
                            <div class="connection-section display-flex-custom blockhide{{$uf}}">

                                <div class="media">

                                    <div class="media-left">

                                        <div class="profile_pic">
                                            <?php if($userdetail!=null && $userdetail->profile_image!=null && $userdetail->profile_image!=''){ ?>
                                            <img src="{{ asset("/public/user_img/".$userdetail->profile_image) }}" style="width: 60px;height: 100%;border-radius: inherit;" alt="Profile">
                                            <?php }else{?>
                                            <img src="public/assets/image/profile.png" alt="Profile">
                                            <?php } ?>

                                        </div>

                                    </div>

                                    <div class="media-body">

                                        <a href="profile/{{ $userdetail->name }}"><div class="tabcontent-title connection-profile"> {{ $userdetail->first_name." ".$userdetail->last_name }}</div></a>

                                        <div class="connection-profile desc">Writer</div>

                                        <div class="connection-profile">Connected <?php echo gethumandate($uf);?></div>

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
                        }else{
?>
<div class="profile_main_section no_any_content d-flex align-items-center justify-content-center {{count($user_connection)}}">
                                <span>
                                    <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                </span>
                                <p class="content_text">Awww ! no connection.</p>
                            </div>

<?php
}
                            ?>
                           

</div>