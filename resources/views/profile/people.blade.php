@extends('layouts.app')

@section('title',"Authors")

@section('content')
<section <?php if(count($ouserdetails)<=0) ?> <?php if(count($ouserdetails)<=6) ?> >

    <div class="profile_page block_page preference-no-person margin-bottom-30">

        <div class="container">

            <form method="post" id="searching_people" class="profile_search" action="" style="width: 264px;
margin-left: 877px;">

                @csrf

                <div class="input-group search">

                    <input type="text" name="title" id="search_people" class="form-control spacebar searchpeople" value="" placeholder="Search people">

                    <div class="input-group-append">

                        <button type="button" class="btn-search btn-primary" id="btn_search_people">

                            <i class="fa fa-search" aria-hidden="true"></i>

                        </button>

                    </div>

                </div>

            </form>

            <div class="row" id="serach_result">

                @if(count($ouserdetails)>0)

                    @foreach($ouserdetails as $userdetails)

                    <div class="col-lg-4 col-md-6" id="s1Result">

                        <div class="profile_page_side_section">

                            <div class="user_profile block_user_profile margin-bottom-30">

                                <div class="user_image_section">                                    

                                    <div class="profile_section media align-items-center">

                                        <div class="profile_pic media-left">

                                            <?php

                                            if (isset($userdetails->profile_image) && $userdetails->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetails->profile_image)) {

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

                                                    <div class="followers"><span class="number"><?php echo getFollowercount($userdetails->id); ?></span> Followers</div>



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

                                                    <a target="_blank" href="<?php echo $userdetails->facebook_profile_url ?>"><i class="fa fa-facebook" style="font-size: 20px;color:white"></i></a>&nbsp;&nbsp;

                                                <?php } ?>
                                            <?php } ?>

                                        </div>

                                    </div>

                                </div>

                                

                               <div class="user_profile_button">                               

                                    <!-- <a href="{{URL::to('connect',array('id'=>$userdetails->id))}}" title="Connect" class="button connect"> -->
                                    <?php $connection = getConnection(Auth::user()->id,$userdetails->id); ?>

                                    <?php if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==0 && checkConnectionReqStatus(Auth::user()->id,$userdetails->id)==0){ 
                                         $title = "Connected";
                                         $data_title = "Disconnect";
                                    }else{ if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==1){
                                        $title="Cancel Request" ;
                                        $data_title="Cancel Request" ;
                                    }elseif (checkConnectionStatus($userdetails->id,Auth::user()->id)==1) {
                                        $title = "Accept Request"; 
                                        $data_title = "Accept Request"; 
                                    }else {
                                        $title="Connect" ;
                                        $data_title="Connect" ;
                                    } } ?>
                                    
                                    <a  data-val="{{$userdetails->id}}" data-title="{{$data_title}}" id="userdetails_id" class="button connect button_connect" title="<?php echo $title; ?>"  <?php if (isset($connection->is_block) && $connection->is_block==1): ?> disabled="disabled" <?php endif ?> >

                                    <?php if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==0 && checkConnectionReqStatus(Auth::user()->id,$userdetails->id)==0){ echo "Connected"; }else{ if(checkConnectionStatus(Auth::user()->id,$userdetails->id)==1){ echo "Cancel Request"; }elseif (checkConnectionStatus($userdetails->id,Auth::user()->id)==1) { echo "Accept Request"; }else { echo "Connect";} }?>
                                    </a>

                                    <!-- <a href="{{URL::to('follow',array('id'=>$userdetails->id))}}" title="Follow" class="button follow"> -->
                                    <?php if(checkFollowerStatus(Auth::user()->id,$userdetails->id)==0){ ?> 
                                        <a data-val="{{$userdetails->id}}" id="userdetails_id" class="button follow button_unfollow" title="Followed" <?php if (isset($connection->is_block) && $connection->is_block==1): ?> disabled="disabled" <?php endif ?>>
                                    <?php }else{ ?>
                                        <a data-val="{{$userdetails->id}}" id="userdetails_id" class="button follow button_follow" title="Follow" <?php if (isset($connection->is_block) && $connection->is_block==1): ?> disabled="disabled" <?php endif ?>>
                                    <?php } ?>

                                    <?php $checkFollowerStatus = checkFollowerStatus(Auth::user()->id,$userdetails->id);
                                 if(isset($checkFollowerStatus) && intval($checkFollowerStatus)==0){ echo "Followed"; }else{ echo "Follow"; }?>

                                    </a>                                 

                                </div>

                                   

                            </div>

                        </div>

                    </div>                

                    @endforeach

                @else

                <div class="profile_page_main_section">

                    <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center" style="background-color:#fff !important;">

                        <p class="content_text">Please select preferences to view peoples</p>

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</section>

<script src="{{ asset('js/jquery.validate.min.js') }}"></script>


<script type="text/javascript">

$(document).ready(function () {

    $('body').on('click','.button_follow',function(){
        button_follow($(this).attr('data-val'));
    });
    $('body').on('click',".button_unfollow",function(){
        button_unfollow($(this).attr('data-val'));
    });
    $("body").on('click',".button_connect",function(){
        button_connect($(this).attr('data-val'),$(this).attr('data-title'));
    });
    $(".spacebar").keydown(function (e) {
        if (e.keyCode == 32) { 
           $(this).val($(this).val() + " "); // append '-' to input
           return false; // return false to prevent space from being added
        }
        if (e.keyCode == 188) { 
           $(this).val($(this).val() + ","); // append '-' to input
           return false; // return false to prevent space from being added
        }
    });
    /*Enter key validation for searchin starts*/

    $("#search_people").keyup(function(event) {

      if (event.keyCode === 13) {

        $("#btn_search_people").click();

      }

      else {

        $("#btn_search_people").trigger('click');

      }

    });

    /*Enter key validation for searching ends*/



    $("#btn_search_people").on('click',function(e){

        var searchpeople =  $('#search_people').val();

        if ($("#searching_people").valid()==true) {

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $.ajax({

                url: "{{route('search/people')}}",

                type:"POST",

                data: {'searchpeople':searchpeople},

                success: function (result) {

                    $("#serach_result").html(result);

                }

                // return false;

            });

        }    

    });



   /* $("#search_people").keypress(function(e) {

        $("#btn_search_people").trigger('click');

    });*/



    /*$("#searching_people").validate({

        rules: {

            title: {

                required: true

            }

        },

        messages: {

            title: "Please enter name",

        }

    });*/

    /*Search People ends*/

}); 



 function button_follow(userid)

    {

    swal({

            title: "Are you sure you want to follow this user?",

            text: "",

            icon: "warning",

            buttons: true,

            dangerMode: true,

            })

            .then((willDelete) => {

            if (willDelete) {

            window.location.href = "<?php echo url('follow/"+userid+"'); ?>";

            }

            });

    }
    function button_unfollow(userid)

    {

    swal({

            title: "Are you sure you want to unfollow this user?",

            text: "",

            icon: "warning",

            buttons: true,

            dangerMode: true,

            })

            .then((willDelete) => {
            if (willDelete) {
                window.location.href = "<?php echo url('follow/"+userid+"'); ?>";
            }

            });

    }

    function button_connect(userid,title)

    {

    swal({

            title: "Do you want to "+title+" ?",

            text: "",

            icon: "warning",

            buttons: true,

            dangerMode: true,

            })

            .then((willDelete) => {

            if (willDelete) {
                if (title=='Accept Request') {
                    window.location.href = "<?php echo url('acceptrequest/"+userid+"'); ?>";
                }else{
                    if (title=='Disconnect') {
                        window.location.href = "<?php echo url('rejectrequest/"+userid+"'); ?>";
                    }else{
                        window.location.href = "<?php echo url('connect/"+userid+"'); ?>";
                    }    
                }
            }

            });

    }

</script>

@endsection        