@extends('layouts.app')
@section('title',"Authors")
@section('content')
<section <?php if(count($ouserdetails)<=0) ?> <?php if(count($ouserdetails)<=6) ?> >
    <div class="profile_page block_page preference-no-person margin-bottom-30">
        <div class="container">
            <form method="post" id="searching_people" class="profile_search" action="">
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
                    @endforeach
                @else
                <div class="profile_page_main_section">
                    <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center" style="background-color:#fff !important;">
                        <p class="content_text">Please select preferences to view peoples</span></p>
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
    $(".button_follow").click(function(){
        button_follow($(this).attr('data-val'));
    });
    $(".button_connect").click(function(){
        button_connect($(this).attr('data-val'));
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
    $("#search_people").keyup(function(event) {
	  if (event.keyCode === 13) {
	    $("#btn_search_people").click();
	  }
          else{
             $("#btn_search_people").trigger('click');
           }
	});
    /*Search People starts*/
    // $("#searching_people").submit(function(e){
    //     e.preventDefault();
    // });
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

    $("#search_people").keypress(function(e) {
        $("#btn_search_people").trigger('click');
    });

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
function searchSuggestion(){
    var input, filter, ul, li, a, i;
    input = document.getElementById("search_people");
    filter = input.value.toUpperCase();
    alert(filter);
    ul = document.getElementById("serach_result");
    li = ul.getElementsByTagName("s1Result");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
/*var options = {
    url: "{{route('search/people')}}"
};
$("#search_people").easyAutocomplete(options);*/
 function button_follow(userid)
    {
    swal({
            title: "Are you sure follow this ?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
            window.location.href = 'follow/' + userid;
            }
            });
    }
    function button_connect(userid)
    {
    swal({
            title: "Are you sure connect this ?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
            window.location.href = 'connect/' + userid;
            }
            });
    }
</script>
@endsection        