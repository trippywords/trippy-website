@extends('layouts.app')
@section("title","Profile")
@section('content')

    <!-- main.css | /* Profile Page Section S */ -->
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
                                    {!! nl2br(Auth::guard('web')->user()->description) !!}
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
                                <a href="javascript:;" class="edit_icon show_edit_section" title="Edit">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                @endif 
                            </div>
                            <div class="profile_main_section no-padding" id="published_blogs">
                                <?php if(count($publish_blogs) > 0){ ?>
                                @foreach ($publish_blogs as $blog)
                                <div class="media" data-val="<?php echo $blog->blogid; ?>">
                                    <div class="media-left">
                                        @if(isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image))
                                        <a href="{{ url('blog/'.$blog->blogid)}}" target="_blank"><img src="{{ asset("/") }}public/blog_img/{{ $blog->blog_image }}" class="media-object"></a>
                                        @else
                                        <a href="{{ url('blog/'.$blog->blogid)}}" target="_blank"><img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object"></a>
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a target="_blank" href="{{ url('blog/'.$blog->blogid)}}">{{ $blog->blog_title }}</a></h4>
                                        <p class="media-content">@php echo strip_tags(str_limit($blog->blog_description, 200)) @endphp</p>
                                        <?php
                                           /* $genre_name= "";
                                            if(!empty($blog->blog_genre)){
                                                $genre = DB::table('genres')->where('id',$blog->blog_genre)->first();
                                            }
                                            $genre_name = $genre->name;*/
                                        ?>
                                        <div class="media-sub-content"><strong>Genre: </strong> {{ $blog->child_genre_name }}</div>
                                    </div>
                                    <div class="media-edit" style="display: none;">
                                        <a href="{{ url('blog-edit/'.$blog->blogid)}}" class="edit" title="Edit">
                                            <i class="fa fa-pencil-square"></i>
                                        </a>
                                        <a onclick="delete_blog({{ $blog->blogid }})" class="trash" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <?php }else{ ?>
                                <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center" style="background-color:#fff !important;">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                        <p class="content_text">Awww ! no blog. Write now <span>Just click on edit</span></p>
                                </div>
                                <?php } ?>
                            </div>
                            <div id="load_more_blog">
                                <div class="ajax-load text-center" style="display:none">
                                    <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                                </div>
                                @if(isset($publish_total) && intval($publish_total) > 0)
                                    <div class="blog_button">
                                        <a href="javascript:;" class="btn btn-primary" id="loadmore" title="Load More" data-page="{{ $page }}">
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
        
        <script src="js/sweetalert.min.js"></script>
<script>            
$(document).ready(function () {

    $("body").on('click','#loadmore',function(){
        var page = $(this).attr('data-page');
        $('.ajax-load').show();
        $('#loadmore').hide();
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
                console.log(result);
                if(result) {
                    $('#loadmore').hide();
                    $('.ajax-load').hide();
                    $('#load_more_blog').hide();
                    $("#published_blogs").append(result);  
                }
            }
        });
    });

    $("#edit_description").click(function(){
        var words = $("#txt_Description").text().match(/\S+/g).length;
        var total_Word_limit = "<?php echo getLimitofsummery(); ?>";
        $("#display_count").text(words);
        $("#word_left").text((total_Word_limit - words));
        $('#myModal').modal('show');
    });
    var page = 1;
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
