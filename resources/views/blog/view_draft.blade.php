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
                                                    <input type="checkbox" class="chk" value="{{$blog->blogid}}">
                                                    <span></span>
                                                </div>
                                            </label>
                                        </td>
                                        <td>
                                            <!-- <a href="javascript:;" title="Draft"></a> -->
                                            <span class="text_font_primary">{{ str_limit($blog->blog_title,30)}}</span>
                                        </td>
                                       
                                        <td class="text_content">
                                            <span class="text_font_secondary">{{ strip_tags(str_limit(isset($blog->blog_description)?$blog->blog_description:"", 30)) }}</span>
                                        </td>
                                        <td class="date_td date_edit_td">
                                            {{date('M d', strtotime($blog->created_at))}}
                                        </td>
                                        <td class="delete_btn" style="display:none;">
                                            <a href="{{ url('draft-edit/'.$blog->blogid) }}" class="edit" title="Edit">
                                                    <i class="fa fa-pencil-square"></i>
                                            </a>
                                            <a onclick="delete_draft('{{ $blog->blogid }}')" class="trash" title="Delete"> 
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
                            @if(isset($draft_total) && $draft_total > 0)
                            <div class="blog_button">
                                <a href="javascript:;" class="btn btn-primary" id="loadmore_draft_blog" title="Load More" data-page="4">
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
                            <div class="media" data-val="<?php echo $blog->blogid; ?>">
                                <div class="media-left">
                                    <?php if (isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image)) { ?>
                                        <a href="{{ url('blogs/'.$blog->blogid) }}" target="_blank"><img src="{{ asset("/public/blog_img/".$blog->blog_image) }}" class="media-object"></a>
                                    <?php } else { ?>
                                        <a href="{{ url('blogs/'.$blog->blogid) }}" target="_blank"><img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object"></a>
                                    <?php } ?>
                                </div>
                                <?php
                                   /* $genre_name= "";
                                    if(!empty($blog->blog_genre)){
                                        $genre = DB::table('genres')->where('id',$blog->blog_genre)->first();
                                    }
                                    $genre_name = $genre->name;*/
                                    ?>
                                <div class="media-body">

                                    <h4 class="media-heading"><a target="_blank" href="{{ url('blogs/'.$blog->blogid) }}">{{ $blog->blog_title }}</a></h4>
                                    <?php $content = preg_replace("/<img[^>]+\>/i", " ", $blog->blog_description); 
                                        $content = preg_replace("/<video[^>]+\>/i", " ", $content); 
                                        $content = str_replace("Your browser does not support HTML5 video.",'', $content); 
                                        $content = strip_tags($content); 
                                        if (isset($content) && trim($content)=='') {
                                            $content = '';
                                        } ?>
                                    <p class="media-content">@php echo substr($content, 0,200) @endphp</p>
                                    <div class="media-sub-content"><strong>Genre: </strong> {{ $blog->child_genre_name }}</div>
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
                            <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center" style="background-color:#fff !important;">
                                <span>
                                    <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                </span>
                                    <p class="content_text">Awww ! no blog. Write now <span>Click on compose button to create a new blog</span></p>
                            </div>
                            @endif
                        </div>
                        <div id="load_more_blog">
                            <div class="ajax-load text-center" style="display:none">
                                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                            </div>
                            @if(isset($publish_total) && intval($publish_total) > 0)
                                <div class="blog_button">
                                    <input type="hidden" name="publishtotal" id="publishtotal" value="{{$publish_total}}">
                                    <a href="javascript:;" class="btn btn-primary" id="loadmore" title="Load More" data-page="4">
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
        $("body").on('click','#loadmore_draft_blog',function(){
            var page = $(this).attr('data-page');
            $('#loadmore_draft_blog').hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('getBlogs')}}",
                type: "POST",
                data: {'page':page,'draft':1}, 
                success: function (result) {
                    if(result) {
                        $('#loadmore_draft_blog').hide();
                        $("#draft_blogs").append(result);  
                    }
                }
            });
        });
        
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
                        if(result) {
                            $('#loadmore').hide();
                            $('.ajax-load').hide();
                            $('#load_more_blog').hide();
                            $("#published_blogs").append(result);  
                        }
                    }
                });
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

