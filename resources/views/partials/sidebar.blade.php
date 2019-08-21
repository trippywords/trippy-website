<div class="col-lg-4 col-md-5">
    <div class="profile_page_side_section">
        <div class="user_profile margin-bottom-30">
            <div class="user_image_section">
                <div class="edit_image" >
                    <a href="javascript:;" title="Edit Profile Pic" id="edit_user_image">
                    <i class="fa fa-edit"></i>
                </a>
                 @if(Auth::user()->profile_image != "")
                    <a href="javascript:;" title="Delete Profile Pic" id="del_user_image" >
                    <i class="fa fa-trash"></i>
                </a>
                @endif
                </div>
                <div class="profile_pic">
                    
                    <?php if (isset(Auth::user()->profile_image) && Auth::user()->profile_image != null && file_exists(public_path() . '/user_img/' .Auth::user()->profile_image)) { ?>
                        <img src="{{ asset("/public/user_img/".Auth::user()->profile_image) }}" alt="">
                    <?php } else { ?>
                        <img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">
                    <?php } ?>
                </div>
                <div class="text-right">
                <?php if(Auth::user()->social_icon_status=='1'){ ?>
                    <?php if(Auth::user()->facebook_profile_url!=null && Auth::user()->facebook_id != null){ ?>
                    <a target="_blank" href="<?php echo Auth::user()->facebook_profile_url ?>"><i class="fa fa-facebook" style="font-size: 20px;color:white"></i></a>&nbsp;&nbsp;
                    <?php } ?>
                    <?php if(Auth::user()->twitter_id!=null)
                    {                        
                    ?>
                <a target="_blank" href="https://twitter.com/<?php echo Auth::user()->twitter_username ?>"><i class="fa fa-twitter" style="font-size: 20px;color:white"></i></a>
                <?php } ?>
                            
                <?php } ?>
                </div>
            </div>
            <div class="user_details">
                <h2 class="user_name">{{ ucwords(Auth::user()->first_name) }} {{ ucwords(Auth::user()->last_name) }}</h2>
                <h3 class="user_id">{!!  "@".str_slug(Auth::user()->name, '-') !!}</h3>
                <p> 
                
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </p>
            </div>
        </div>
        <div class="follower_section_box">
            <div class="follower_section">
                <div class="number">{!! getBlogsCountByUser(); !!}</div>
                @if(getBlogsCountByUser() > 1)
                   <div class="text"><a href="{{ route('profile') }}">Blogs</a></div>
                @elseif(getBlogsCountByUser() == 1)
                    <div class="text"><a href="{{ route('profile') }}">Blog</a></div>
                @else
                   <div class="text">Blog</div>
                @endif
            </div>
            <div class="follower_section">
                <div class="number">{{ getConnectioncount(Auth::user()->id) }}</div>
                @if(getConnectioncount(Auth::user()->id) > 1)
                   <div class="text"><a href="{{ route('connections') }}">Connections</a></div>
                @elseif(getConnectioncount(Auth::user()->id) == 1)
                   <div class="text"><a href="{{ route('connections') }}">Connection</a></div>
                @else
                    <div class="text">Connection</div> 
                @endif
            </div>
            <div class="follower_section">
                <div class="number">{{ getFollowerscount(Auth::user()->id) }}</div>
                @if(getFollowerscount(Auth::user()->id) > 1)
                   <div class="text"><a href="{{ url('followers') }}">Followers</a></div>
                @elseif(getFollowerscount(Auth::user()->id) == 1)
                    <div class="text"><a href="{{ url('followers') }}">Follower</a></div>
                @else
                   <div class="text">Follower</div>
                @endif
            </div>
        </div> 
        <div class="rating_section_box margin-bottom-30">
            <div class="rating_section">
                <div class="row">
                    <div class="col-sm-4 custom-width">
                        <div class="title">RATING</div>
                    </div>
                    <div class="col-sm-8 custom-width">
                        <div class="stars">
                            No Rating Available
                        </div>
                    </div>
                </div>
            </div>
            <div class="rating_section">
                <div class="row">
                    <div class="col-sm-4 custom-width">
                        <div class="title">GENRE</div>
                    </div>

                    <div class="col-sm-8 custom-width">
                        <div class="details" style="word-wrap: break-word;">
                            @php getUsergenres(); @endphp
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row profile_page_side_section_button">
            <div class="col-sm-6 custom-padding">
                <a href="{{ route('compose') }}" class="btn compose" title="Compose">
                    <i class="fa fa-file-text"></i>
                    <span class="btn_name">COMPOSE</span>
                </a>
            </div>
            <div class="col-sm-6 custom-padding">
                <a href="{{ route('draft') }}" class="btn draft" title="Draft">
                    <div>
                        <i class="fa fa-folder-open"></i>
                        <span class="btn_name">DRAFT</span>
                    </div>
                    <div class="number">{!!getDraftsBlogsCountByUser()!!}</div>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog  modal-dialog-centered">
        
        <form name="frmUpdateDescription" id="frmUpdateDescription" action="{{route('update_description')}}" method="POST">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                  <h2 class="title">
                    Edit Summary
                  </h2>
                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <textarea required="required" id="txt_Description" name="txt_Description"  class="form-control" rows="15"><?php echo Auth::guard('web')->user()->description; ?></textarea><br>
                  <span style="color:#57bb47"> Total word count: <span id="display_count">0</span> words. Words left: <span id="word_left"><?php echo getLimitofsummery(); ?></span></span>
              </div>
             
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submit_summary">Update</button>
              </div>
            </div>
           </form>
      </div>
    </div>
    <div id="myModal1" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
       
        <form name="frmUpdateProfileImage" enctype="multipart/form-data" id="edit_profile" action="{{route('update_profile_image')}}" method="POST">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                 <h2 class="title">
                         Profile Image
                    </h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <input type="file" name="user_image" id="image_value" accept="image/*">
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" id="submit_profile_image" value="Update">
              </div>
            </div>
           </form>
           <div id="image_value_toast">Please select an image file</div>
      </div>
    </div>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">       
$(document).ready(function(){


    /*$('#image_value').checkFileType({
        allowedExtensions: ['jpg', 'jpeg' ,'png', 'gif' ,'tif'],
        error: function() {
            var x = document.getElementById("image_value_toast");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            return false; 
        }
    });*/

$('#del_user_image').click(function(){
        swal({
            title: "Are you sure you want to delete ?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var url ="{{url('profile/delete_image')}}"
                var token = "{{ csrf_token() }}"
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {_token:token},
                    success: function (result) {
                        window.location.href = "{{url('/dashboard')}}";
                    }
                });
            }
        });
    });
    $(function () {
        $(document).on("hidden.bs.modal", "#myModal1", function () {
           $(this).find("#image_value").val("");
           $("#image_value-error").css('display','none');
        });
   }); 
    $("#txt_Description").keyup(function(){
        var txt_Description = $.trim($('#txt_Description').val());
        if (txt_Description!=undefined && txt_Description!='') {
            var words = this.value.match(/\S+/g).length;
            if (words > <?php echo getLimitofsummery(); ?>) {
              var trimmed = $(this).val().split(/\s+/, <?php echo getLimitofsummery(); ?>).join(" ");
              $(this).val(trimmed + " ");
            }else {
              $('#display_count').text(words);
              $('#word_left').text(<?php echo getLimitofsummery(); ?>-words);
            } 
        }else{
            $('#display_count').text(0);
            $('#word_left').text(<?php echo getLimitofsummery(); ?>-0);
        }    
    });
    $("#txt_Description").blur(function(){
         var txt_Description = $.trim($('#txt_Description').val());
        if (txt_Description!=undefined && txt_Description!='') {
            var words = this.value.match(/\S+/g).length;
            if (words > <?php echo getLimitofsummery(); ?>) {
              var trimmed = $(this).val().split(/\s+/, <?php echo getLimitofsummery(); ?>).join(" ");
              $(this).val(trimmed + " ");
            }else {
              $('#display_count').text(words);
              $('#word_left').text(<?php echo getLimitofsummery(); ?>-words);
            } 
        }else{
            $('#display_count').text(0);
            $('#word_left').text(<?php echo getLimitofsummery(); ?>-0);
        } 
    });

    $("#edit_description").click(function(){
        $('#myModal').modal('show');
    });
    $("#edit_user_image").click(function(){
        $('#myModal1').modal('show');
    });

    $('#submit_summary').click(function(){
        $("#frmUpdateDescription").validate({
            rules: {
                txt_Description: {
                    required: true
                }
            }         
        });
    });
       
});
$('#plus_icon').click(function(){
        $('#last_nodes').slideToggle();
        $('#plus_icon').toggle();
        $('#minus_icon').toggle();
        $('#minus_icon').css('display','inline-block');
    });
    $('#minus_icon').click(function(){
        $('#last_nodes').slideToggle();
        $('#minus_icon').toggle();
        $('#plus_icon').toggle();
        $('#plus_icon').css('display','inline-block');
    });
    $("#submit_profile_image").click(function(){
        $("#edit_profile").validate({
            rules: {
                user_image: {
                    required: true
                }
            },
            messages: {
                user_image: "Please select image",
            },          
        });
    });

 /*Validation for image starts*/
   (function($) {
    $.fn.checkFileType = function(options) {
        var defaults = {
            allowedExtensions: [],
            success: function() {},
            error: function() {}
        };
        options = $.extend(defaults, options);

        return this.each(function() {

            $(this).on('change', function() {
                var value = $(this).val(),
                    file = value.toLowerCase(),
                    extension = file.substring(file.lastIndexOf('.') + 1);

                if ($.inArray(extension, options.allowedExtensions) == -1) {
                    options.error();
                    $(this).focus();
                } else {
                    options.success();

                }

            });

        });
    };

})(jQuery);

/*Validation for image ends*/
</script>