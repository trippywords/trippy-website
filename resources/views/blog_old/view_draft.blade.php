@extends('layouts.app')
@section('title',"Draft Blog")
@section('content') 
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section>
    <div class="profile_page">
        <div class="container">
            <div class="row">
                @include('partials.sidebar')
                <div class="col-lg-8 col-md-7">
                    <div class="profile_page_main_section margin-bottom-30">
                        <div class="profile_main_title_section">
                            <h2 class="title">
                                <i class="fa fa-folder-open"></i>
                                Draft
                            </h2>
                            @if(!$draft_blogs->isEmpty())
                            <div>
                                <a href="javascript:;" class="edit_icon_blog" title="Edit">
                                    <i class="fa fa-edit mhyclas"></i>
                                    <span id="act_span">Edit</span>
                                </a>
                                    <a href="javascript:;" class="action_multiple" style="display:none" title="Delete">
                                 <i class="fa fa-trash-o"></i>Delete</a>
                            </div>
                        @endif
                        </div>
                        <div class="profile_main_section no-padding">
                            <table class="table table-striped" >
                               <tbody id="draft_blogs">
                                     @if(!$draft_blogs->isEmpty())
                                    @foreach ($draft_blogs as $blog)
                                    <tr>
                                        <td class="checkbox_td draft_td">
                                            <label class="checkbox-inline ad-checkbox-inline delete_btn" style="display: none;">
                                                <div class="ad-checkbox">
                                                    <input type="checkbox" class="chk" value="{{$blog->id}}">
                                                    <span></span>
                                                </div>
                                            </label>
                                        </td>
                                        <td>
                                        	<!-- <a href="javascript:;" title="Draft"></a> -->
                                            <span class="text_font_primary">{{ str_limit($blog->blog_title,30)}}</span>
                                        </td>
                                       
                                        <td class="text_content">
                                            <span class="text_font_secondary">{{ str_limit($blog->blog_heading,30)}}</span>
                                        </td>
                                        <td class="date_td date_edit_td">
                                            {{date('M d', strtotime($blog->updated_at))}}
                                        </td>
                                        <td class="delete_btn" style="display:none;">
                                            <a href="draft-edit/{{ $blog->blog_slug }}" class="edit" title="Edit">
                                                    <i class="fa fa-pencil-square"></i>
                                            </a>
                                            <a onclick="delete_draft('{{ $blog->id }}')" class="trash" title="Delete"> 
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center" style="background-color:#fff !important;">
                            <span>
                                <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                            </span>
                                <p class="content_text">Awww ! no draft. Write now <span>Click on compose button to create a new draft</span></p>
                        </div>
                                    @endif
                                </tbody>
                            </table>
                            @if(!$draft_blogs->isEmpty())
                            @if($draft_total > 4)
                            <div class="blog_button">
                                <a href="javascript:;" class="btn btn-primary" id="loadmore_draft_blog" title="Load More" data-val="{{$draft_total}}">
                                    LOAD MORE
                                </a>
                            </div>
                             @endif
                            @endif
                            </div>
                        </div>
                        <div class="profile_page_main_section">
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
                                @if(count($publish_blogs) > 0)
                                @foreach ($publish_blogs as $blog)
                            <div class="media" data-val="<?php echo $blog['id']; ?>">
                                <div class="media-left">
                                    @if($blog->blog_image!='')
                                    <a href="blog/{{ $blog->blog_slug}}" target="_blank"><img src="public/blog_img/{{ $blog->blog_image }}" class="media-object"></a>
                                    @else
                                    <a href="blog/{{ $blog->blog_slug }}" target="_blank"><img src="public/blog_img/blog-2.jpg" class="media-object"></a>
                                    @endif
                                </div>
                                <?php
                                    $genre_name= "";
                                    if(!empty($blog->blog_genre)){
                                        $genre = DB::table('genres')->where('id',$blog->blog_genre)->first();
                                    }
                                    $genre_name = $genre->name;
                                    ?>
                                <div class="media-body">

                                    <h4 class="media-heading"><a target="_blank" href="blog/{{ $blog->blog_slug }}">{{ $blog->blog_title }}</a></h4>
                                    <p class="media-content">@php echo strip_tags(str_limit($blog->blog_description, 200)) @endphp</p>
                                    <div class="media-sub-content"><strong>Genre: </strong> {{$genre_name}}</div>
                                </div>
                                @if(!$draft_blogs->isEmpty())
                                <div class="media-edit" style="display: none;">

                                    <a href="blog-edit/{{ $blog->blog_slug }}" class="edit" title="Edit">
                                    @if(!$draft_blogs->isEmpty())
                                    @endif
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <a onclick="delete_blog({{ $blog->id }})" class="trash" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                @endif
                            </div>
                            @endforeach
                            @else
                            <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center" style="background-color:#fff !important;">
                            <span>
                                <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                            </span>
                                <p class="content_text">Awww ! no blog. Write now <span>Click on compose button to create a new blog</span></p>
                        </div>
                            @endif
                        </div>
                        @if($publish_total > 4)
                        <div class="blog_button">
                            <a href="javascript:;" class="btn btn-primary" id="loadmore_published_blog" title="Load More" data-val="{{$publish_total}}">
                                LOAD MORE
                            </a>
                        </div> 
                        @endif
                        <div class="ajax-load-published text-center" style="display:none">
                            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{url('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script src="js/sweetalert.min.js"></script>
<script>
        $(document).ready(function () {
        var page = 1;
       $("body").on('click', '.cancel_blog_icon', function () {
           $(".delete_btn").each(function () {
               $(this).css('display', 'none').animate({}, 'slow');
           });
           $(".mhyclas").removeClass('fa-times').addClass('fa-edit');
           $("#act_span").text("Edit");
           $(".action_multiple").hide();
           $(this).removeClass("cancel_blog_icon").addClass("edit_icon_blog");
       });
       $("body").on('click', '.edit_icon_blog', function () {
           $(".delete_btn").each(function () {
               $(this).css('display', 'block').animate({}, 'slow');
           });
           $(".mhyclas").removeClass('fa-edit').addClass('fa-times');
           $("#act_span").text("Cancel");
           $(".action_multiple").show();
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
        $("#loadmore_draft_blog").click(function(){
            page++;
            var draft=1;
            var total = $(this).data('val');
            var token = "{{ csrf_token() }}";
            var ptotal = 4 * page;
            $.ajax({
                url: '?page=' + page,
                type: "get",
                data: {draft:draft,_token:token},
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
            })
            .done(function(data)
            {
                if(data.html != ""){
                    $('.ajax-load').hide();
                    $("#draft_blogs").append(data.html);
                } 
                if (ptotal >= total ) {
                    $("#loadmore_draft_blog").hide();
                    $('#loadmore_draft_blog').css('display','none');
                    return;
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                  alert('server not responding...');
            });
        });
    });
    var page = 1;
    $("#loadmore_published_blog").click(function(){
            page++;
            var total = $(this).data('val');
            var ptotal = 4 * page;
            $.ajax({
                url: '?page=' + page,
                type: "get",
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
            })
            .done(function(data)
            {
                if(data.html !== ""){
                    $('.ajax-load').hide();
                    $("#published_blogs").append(data.html);
                  /*  $("#load_more").hide();
                    $('.ajax-load').html("No more blogs found");
                    return;*/
                }
                if(ptotal >= total){
                    $("#loadmore_published_blog").hide();
                    $('#loadmore_published_blog').css('display','none');
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                  alert('server not responding...');
                                        });
        });

    

    
    $('textarea').ckeditor();

    function delete_draft(del_draft_id)
    {
    swal({
    title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this draft!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
            window.location.href = 'draft/delete/' + del_draft_id;
            }
            });
    }
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


        var arrayOfValues = [];
        $("body").on('click', '.action_multiple', function () {
            var total = $('.chk:checked').length;
            if (total == 0) {
                alert('Please select at least one record !!');
            }else{
           
            $('.chk:checked').each(function () {
                    arrayOfValues.push($(this).val());
            }).get();
               delete_draft_multiple(arrayOfValues);
            }
        });

         function delete_draft_multiple(array)
            {
                var url ="{{url('/draft/delete_multiple')}}";
                var token = "{{ csrf_token() }}";
                swal({
                    title: "Are you sure you want to delete?",
                    text: "Once deleted, you will not be able to recover this draft!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       $.ajax({
                          type: 'POST',
                          url: url,
                          data: {id:array,_token:token},
                         success: function (result) {
                             window.location.href = "{{url('/draft')}}";
                         }

                       });
                        //window.location.href = 'draft/delete_multiple/' + array;
                    }
                });
            }
</script>    
@endsection

