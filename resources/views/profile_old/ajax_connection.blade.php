<div class="connection-main-section ajaxfolllist1">
@foreach ($user_connection as $uf)
    @php
        $userdetail = getUserdetailbyid($uf);
    @endphp
    <div id="{{$uf}}" class="connection-section display-flex-custom blockhide{{$uf}}">
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
                <a href="profile/{{ $userdetail->name }}">
                    <div class="tabcontent-title connection-profile">
                        {{ $userdetail->first_name." ".$userdetail->last_name }}
                    </div>
                </a>
                 <div class="connection-profile desc">Writer</div>
                    <div class="connection-profile">Connected <?php //echo gethumandate($uf);?></div>
            </div> 
        </div>
        <div class="message-main text-right">
            <button type="button" class="btn btn-danger" onclick="removeconnection(<?php echo $uf; ?>)">Remove</button>
        </div>
    </div>
@endforeach
    <?php 
        if(count($user_connection)<=0)
            {
            ?>                          
        <h5 style="color:#57bb47;text-align: center">No Results Found!</h5>
        <?php } ?>
</div>