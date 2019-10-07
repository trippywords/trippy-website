@extends('layouts.app')

@section('title','Dashboard')
@section('content')
<section>
        <div class="profile_page">
            <div class="container">
                <div class="row">
                    @include('partials.sidebar')
                    <div class="col-lg-8 col-md-7">
                        <div class="profile_page_main_section margin-bottom-30">
                            <div class="profile_main_title_section">
                                <h2 class="title">
                                    <i class="fa fa-file-text"></i>
                                    Summary
                                </h2>

                                <a href="javascript:;" class="edit_icon" title="edit" id="edit_description">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                            </div>

                            @if(Auth::guard('web')->user()->description == "")
                            <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center">
                                <span>
                                    <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                </span>
                                <p class="content_text">Awww ! no summary. Write now <span>Just click on edit</span></p>
                            </div>
                            @else
                            
                            <div class="profile_main_section">
                                <p class="content" style="word-wrap: break-word;">
                                    <?php echo nl2br(Auth::guard('web')->user()->description); ?>
                                </p> 
                            </div>
                            @endif
                    </div>
                        <div class="profile_page_main_section margin-bottom-30">
                        <div class="profile_main_title_section">
                            <h2 class="title">
                                <i class="fa fa-pencil-square"></i>
                                Recent Blogs 
                            </h2>

                              @if(!$publish_blogs->isEmpty())
                                <a href="javascript:;" class="edit_icon show_edit_section" title="edit">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                </a> 
                              @endif
                        </div>
                        <div class="profile_main_section no-padding" id="published_blogs">
                            @if(count($publish_blogs) > 0)
                            @foreach ($publish_blogs as $blog)
                            <div class="media" data-val="<?php echo $blog->blogid; ?>">
                                <div class="media-left">
                                    <?php if (isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image)) { ?>
                                        <a href="{{ url('blog/'.$blog->blogid) }}" target="_blank"><img src="{{ asset("/public/blog_img/".$blog->blog_image) }}" class="media-object"></a>
                                    <?php } else { ?>
                                        <a href="{{ url('blog/'.$blog->blogid) }}" target="_blank"><img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object"></a>
                                    <?php } ?>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="{{ url('blog/'.$blog->blogid) }}" target="_blank">{{ $blog->blog_title }}</a></h4>
                                    <p class="media-content">@php echo strip_tags(str_limit($blog->blog_description, 200 )) @endphp</p>
                                    <?php
                                        $genre_name= "";
                                        if(!empty($blog->blog_genre)){
                                            $genre = DB::table('genres')->where('id',$blog->blog_genre)->first();
                                        }
                                        $genre_name = $genre->name;
                                    ?>
                                    <div class="media-sub-content">Genre:  {{ $genre_name }}</div>

                                </div>

                                <div class="media-edit" style="display: none;">
                                    <a href="{{ url('blog-edit/'.$blog->blogid) }}" class="edit" title="Edit">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <a onclick="delete_blog({{ $blog->blogid }})" class="trash" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>

                            </div>

                            @endforeach

                            @else

                            <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                    <p class="content_text">Awww ! no blogs. Write now <span>Click on Compose button to create a new blog.</span></p>
                                </div>

                            @endif

                        </div>
                        <div id="load_more_blog">
                            <div class="ajax-load text-center" style="display:none">
                                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                            </div>

                            @if(isset($publish_total) && intval($publish_total) > 0)

                                <div class="blog_button">
                                    <a href="javascript:;" class="btn btn-primary" id="load_more" title="Load More" data-page="4">
                                        LOAD MORE
                                    </a>

                                </div>
                            @endif
                        </div>
                    </div>
        </div>
                </div>
            </div>
        </div>
    </section>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
       
        <form name="frmUpdateDescription" id="frmUpdateDescription" action="{{route('update_description')}}" method="POST">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                 <textarea  required="required" id="txt_Description" name="txt_Description" onkeyup="summery_word_limit()" class="form-control" rows="15"><?php echo Auth::guard('web')->user()->description; ?></textarea><br>
                  Total word count: <span id="display_count"></span> words. Words left: <span id="word_left"><?php echo getLimitofsummery(); ?></span> 
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Update">
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
    
            var page = 1;
            $("#edit_description").click(function(){
                var words = $("#txt_Description").text().match(/\S+/g).length;
                var total_Word_limit = "<?php echo getLimitofsummery(); ?>";
                $("#display_count").text(words);
                $("#word_left").text((total_Word_limit - words));
                $('#myModal').modal('show');
            });
            $("#edit_user_image").click(function(){
                $('#myModal1').modal('show');
            });
            $("body").on('click', '.cancel_blog_icon', function () {
                $(".delete_btn").each(function () {
                    $(this).css('display', 'none').animate({}, 'slow');
        });
                $(".mhyclas").removeClass('fa-times').addClass('fa-edit');
                $("#act_span").text("Edit");
                $(this).removeClass("cancel_blog_icon").addClass("edit_icon_blog");
            });
            $("body").on('click', '.edit_icon_blog', function () {
                $(".delete_btn").each(function () {
                    $(this).css('display', 'block').animate({}, 'slow');
                });
                $(".mhyclas").removeClass('fa-edit').addClass('fa-times');
                $("#act_span").text("Cancel");
                $(this).removeClass("edit_icon_blog").addClass("cancel_blog_icon");
            });
            $("body").on('click', '.show_edit_section', function () {
                $(".media-edit").css('display', 'block');
                $(this).removeClass("show_edit_section").addClass("remove_edit_section");
            });
            $("body").on('click', '.remove_edit_section', function () {
                $(".media-edit").css('display', 'none');
                $(this).removeClass("remove_edit_section").addClass("show_edit_section");
            });


             $("body").on('click','#load_more',function(){
                console.log("chita");
                var page = $(this).attr('data-page');
                $('.ajax-load').show();
                $('#load_more').hide();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('getBlogs')}}",
                    type: "POST",
                    data: {'page':page}, 
                    success: function (result) {
                        if(result) {
                            $('#load_more').hide();
                            $('#load_more_blog').hide();
                            $("#published_blogs").append(result);  
                        }
                    }
                });
    });
        });
        function delete_blog(del_blog_id)
        {
            swal({
                title: "Are you sure you want to delete ?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = 'blog/delete/' + del_blog_id;
                }
            });
        }


     
        
    </script>
@endsection
