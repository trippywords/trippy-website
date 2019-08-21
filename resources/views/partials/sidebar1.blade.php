<div class="col-lg-4 col-md-5">

    <div class="profile_page_side_section">

        <div class="user_profile margin-bottom-30">

            <div class="user_image_section">

                <div class="edit_image" id="edit_user_image">

                    <a href="javascript:;" title="Edit Profile Pic">

                        <i class="fa fa-edit"></i>

                    </a>

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

                    <?php if(Auth::user()->facebook_id!=null){ ?>

                    <a target="_blank" href="https://www.facebook.com/<?php echo Auth::user()->facebook_id ?>"><i class="fa fa-facebook" style="font-size: 20px;color:white"></i></a>&nbsp;&nbsp;

                    <?php } ?>

                    <?php if(Auth::user()->twitter_id!=null)

                    {                        

                    ?>

                <a target="_blank" href="https://twitter.com/<?php echo Auth::user()->twitter_id ?>"><i class="fa fa-twitter" style="font-size: 20px;color:white"></i></a>

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

                   <div class="text">Blogs</div>

                @else

                   <div class="text">Blog</div>

                @endif

            </div>

            <div class="follower_section">

                <div class="number">{{ getConnectioncount(Auth::user()->id) }}</div>

                @if(getConnectioncount(Auth::user()->id) > 1)

                   <div class="text">Connections</div>

                @else

                   <div class="text">Connection</div>

                @endif

            </div>

            <div class="follower_section">

                <div class="number">{{ getFollowercount(Auth::user()->id) }}</div>

                @if(getConnectioncount(Auth::user()->id) > 1)

                   <div class="text">Followers</div>

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

      <div class="modal-dialog">

        

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

                  <script>CKEDITOR.replace( 'txt_Description' );</script>                  

                  <span style="color:#57bb47"> Total word count: <span id="display_count"></span> words. Words left: <span id="word_left"><?php echo getLimitofsummery(); ?></span></span>

              </div>

             

            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Update</button>

              </div>

            </div>

           </form>

      </div>

    </div>

    <div id="myModal1" class="modal fade" role="dialog">

      <div class="modal-dialog">

       

        <form name="frmUpdateProfileImage" enctype="multipart/form-data" id="frmUpdateProfileImage" action="{{route('update_profile_image')}}" method="POST">

            @csrf

            <div class="modal-content">

              <div class="modal-header">

                 <h2 class="title">

                        Edit Profile Image

                    </h2>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>

              <div class="modal-body">

                <input type="file" name="user_image" required="required" accept="image/*">

              </div>

              <div class="modal-footer">

                <input type="submit" class="btn btn-primary" value="Update">

              </div>

            </div>

           </form>

      </div>

    </div>

<script type="text/javascript">       

$(document).ready(function(){

    

    $("#txt_Description").keyup(function(){

        var words = this.value.match(/\S+/g).length;



    if (words > <?php echo getLimitofsummery(); ?>) {

      

      var trimmed = $(this).val().split(/\s+/, <?php echo getLimitofsummery(); ?>).join(" ");

      

      $(this).val(trimmed + " ");

    }

    else {

      $('#display_count').text(words);

      $('#word_left').text(<?php echo getLimitofsummery(); ?>-words);

    } 

    });

    $("#edit_description").click(function(){

        $('#myModal').modal('show');

    });

    $("#edit_user_image").click(function(){

        $('#myModal1').modal('show');

    }

    });

       

});

$('#plus_icon').click(function(){

        $('#last_nodes').toggle();

        $('#plus_icon').toggle();

        $('#minus_icon').toggle();

        $('#minus_icon').css('display','inline-block');

    });

    $('#minus_icon').click(function(){

        $('#last_nodes').toggle();

        $('#minus_icon').toggle();

        $('#plus_icon').toggle();

        $('#plus_icon').css('display','inline-block');

    });

</script>