@extends('layouts.app')
@section('title','Compose Blog')   
@section('content')
    <!-- main.css | /* Profile Page Section S */ -->
    <!-- @if ($errors->any()) -->
        <!-- <div class="alert alert-danger"> -->
            <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
           <!--  <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul> -->
        <!-- </div> -->
   <!--  @endif -->
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
                        <form name="frmCreateBlog" id="frmCreateBlog" method="POST" enctype="multipart/form-data" action="{{ route('blog.store') }}">
                            @csrf
                            <div class="profile_page_main_section margin-bottom-30">
                                <div class="profile_main_title_section title_secondary_section">
                                    <h2 class="title">
                                        New Blog 
                                    </h2>

                                    <a href="{{ route('profile') }}" class="edit_icon" title="edit">
                                        <i class="fa fa-close"></i>
                                        Close
                                    </a>
                                </div>
                                <div class="profile_main_section">
                                    <div class="blog_form">
                                        <div class="form-group">
                                            <input type="text" value="{{ old('txtBlogName') }}" class="form-control space"  placeholder="Title goes here" name="txtBlogName" id="txtBlogName">
                                            @if ($errors->has('txtBlogName'))
                                                <div class="error">{{ $errors->first('txtBlogName') }}</div>
                                            @endif
                                        </div>
                                        <!-- <div class="form-group">
                                            <input type="text" value="{{ old('txtBlogHeading') }}" class="form-control space" placeholder="Heading goes here" name="txtBlogHeading" id="txtBlogHeading">
                                            @if ($errors->has('txtBlogName'))
                                                <div class="error">{{ $errors->first('txtBlogHeading') }}</div>
                                            @endif
                                        </div> -->

        <div class="form-group">

            <strong>Select Genres:</strong>

            <select name='parent_genre_id' id='parent_genre_id' class='form-control'>
                <option>Select Genres</option>
                @foreach($genres as $genre)
                <option value="{{$genre->id}}">{{$genre->parent_name}}</option>
                @endforeach
           </select>
        </div>

        <div class="form-group">

            <strong>Select Child Genres:</strong>

            <select name='blog_genre' id='blog_genre' class='form-control'>
                <option>Select Genres</option>
                
           </select> 
           @if ($errors->has('blog_genre'))
            <div class="error">{{ $errors->first('blog_genre') }}</div>
        @endif
        </div>

                                       {{-- <div class="form-group">
                                            <strong>Genre</strong>
                                                <select name="smtp_security" class="form-control">
                                                    <option value="">Select Genre</option>
                                             @foreach ($genrearr as $genr)
                                                    <option value="{{$genr->id}}"
                                                     @if($genr->id == $genr->genre){{'selected'}} @endif >{{$genr->name}}</option>
                                              @endforeach
                                             
                                                </select>
                                                @if ($errors->has('smtp_security'))
                                                    <div class="error">{{ $errors->first('smtp_security') }}</div>
                                                @endif
                                        </div>--}}
                                        <div class="form-group">
                                            <strong>Blog Picture:</strong>
                                                {!! Form::file('blog_image', array('placeholder' => 'blog image','class' => 'form-control')) !!}
                                        </div>
                                        <!-- Froala Editor Start -->
                                        <div class="form-group">
                                            <label>Compose New</label>
                                            <textarea id="txtckDescription" rows="20" name="txtckDescription" class="form-control">{{ old('txtckDescription') }}</textarea>
                                        </div>
                                        <b><span id="descriptionErr" class="error"></span></b>
                                        @if ($errors->has('txtckDescription'))
                                            <div class="error">{{ $errors->first('txtckDescription') }}</div>
                                        @endif
                                        <!-- Froala Editor End -->
                                    </div>
                                    <!-- @if ($errors->any())
                                    <div style="color:red">
                                        <ul>
                                                @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                                @endforeach
                                        </ul>
                                    </div>
                                     @endif -->
                                </div>
                            </div>
                            <div class="profile_page_main_section margin-bottom-30">
                                <div class="profile_main_title_section title_secondary_section">
                                    <h2 class="title">
                                        SEO
                                    </h2>
                                </div>
                                <div class="profile_main_section  profile_page_main_section_secondary">
                                    <div class="blog_form">

                                        <div class="form-group form-group-info">
                                            <input type="text" class="form-control space" placeholder="Meta Description" name="txtBlogMetaDescription" id="txtBlogMetaDescription">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="The purpose of a meta description for your page is simple: to get someone searching on Google to click your link. In other words, meta descriptions are there to generate clickthroughs from search engines"></i>
                                        </div>
                                        <span style="color:#57bb47"> Total character count: <span id="display_meta_count">0</span> characters. Characters left: <span id="word_meta_left">170</span></span>
                                        <div class="form-group form-group-info">

                                            <input type="text" class="form-control" placeholder="Tags" name="txtBlogKeywords" id="txtBlogKeywords" data-role="tagsinput">
                                              <!-- <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Meta Keywords are a specific type of meta tag that appear in the HTML code of a Web page and help tell search engines what the topic of the page is. ... The most important thing to keep in mind when selecting or optimizing your meta keywords is to be sure that each keyword accurately reflects the content of your pages."></i> -->
                                              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Keywords can be entered as comma separated texts (... , ...)"></i>
                                        </div>
                                        <span id="error_keyword" style="color:red;display: none;">maximum limit keyword 100</span>
                                        <div class="btn_section">
                                            <button type="button" class="btn btn-default discard">Discard</button>
                                            <button class="btn btn-primary" type="submit" id="draft_btn" name="draft_btn">Save as Draft</button>
                                            <button class="btn btn-secondary" name="publish_btn" id="btn_submit" type="submit">Publish</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                             <div class="profile_page_main_section">
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
                                        <a href="{{ url('blog/'.$blog->blogid) }}" target="_blank"><img src="{{ asset('/public/blog_img/'.$blog->blog_image) }}" class="media-object"></a>
                                    <?php } else { ?>
                                        <a href="{{ url('blog/'.$blog->blog_slug) }}" target="_blank"><img src="{{ asset('/') }}public/blog_img/no_img.jpg" class="media-object"></a>
                                    <?php } ?>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="{{ url('blog/'.$blog->blog_slug) }}">{{ $blog->blog_title }}</a></h4>
                                    <p class="media-content">@php echo strip_tags(str_limit($blog->blog_description, 200)) @endphp</p>
                                    <?php
                                    $genre_name= "";
                                    if(!empty($blog->blog_genre)){
                                        $genre = DB::table('genres')->where('id',$blog->blog_genre)->first();
                                        $genre_name = $genre->name;
                                    }
                                    
                                    ?>
                                    <div class="media-sub-content"><strong>Genre: </strong>  {{$genre_name}}</div>
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
                                    <p class="content_text">Awww ! no blogs. Write now <span>Click on compose button to create a new blog</span></p>
                                </div>
                                @endif
                        </div>
                        <div class="load_more_blog">
                            <div class="ajax-load text-center" style="display:none" id="ajax-load-blogs">
                                <p> <img src="http://demo.itsolutionstuff.com/plugin/loader.gif"> Loading More post</p>
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
        </div>
    </section>
  <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/assets/bootstrap/js/bootstrap.min.js') }}"></script>  
<script src="{{ asset('public/assets/bootstrap/js/bootstrap-tagsinput.min.js') }}"></script> 
 <!-- <script src="{{ asset('public/assets/bootstrap/js/jquery.min.js') }}"></script>  -->
 
<script type="text/javascript">
   
   $(document).ready(function(){

    $('select[name="parent_genre_id"]').on('change',function(){
             var id=$(this).val();            
             if(id)
                {
                    $.ajax({
                        type:'GET',
                        dataType:'json',
                        url:"{{url('/dropdown')}}?id="+id,
                       
                        success:function(data)
                        {
                            console.log(data);
                            $('select[name="blog_genre"]').empty();
                            $.each(data,function(key,value){
                            $('select[name="blog_genre"]').append('<option value="'+key+'">'+value+'</option>');
                        });
                        },
                        error: function (e) {
                    
                    console.log("ERROR: ", e);
                }
                    });
                }

         });


        
     
        $("#txtBlogMetaDescription").keyup(function(){
            var txtBlogMetaDescription = $.trim($('#txtBlogMetaDescription').val());
            if (txtBlogMetaDescription!=undefined && txtBlogMetaDescription!='') {
                var str = $('#txtBlogMetaDescription').val()
                //var words = this.value.match(/\S+/g).length;
                var words = str.length;
                if (words > 170) {
                  //var trimmed = $(this).val().split(/\s+/, 170).join(" ");
                  //$(this).val(trimmed + " ");
                }else {
                  $('#display_meta_count').text(words);
                  $('#word_meta_left').text(170-words);
                } 
            }else{
                $('#display_meta_count').text(0);
                $('#word_meta_left').text(170-0);
            }    
        });


        $(".space").keydown(function (e) {
            if (e.keyCode == 32) { 
               $(this).val($(this).val() + " "); // append '-' to input
               return false; // return false to prevent space from being added
            }
            if (e.keyCode == 188) { 
               $(this).val($(this).val() + ","); // append '-' to input
               return false; // return false to prevent space from being added
            }
        });




        // $.validator.addMethod("customtxtckDescription", 
        //     function(value, element) {
        //         if ($('#txtckDescription').froalaEditor('core.isEmpty')) {           
        //             // e.preventDefault();
        //             // var error = "Please enter descriprion";
        //             // alert(error);
        //             // $('#descriptionErr').text(error);
        //             // $('#descriptionErr').show();
        //             return "Please enter descriprion";
        //         }
        // });

        $('form').on('submit','#frmCreateBlog', function (e) {
          if ($('#txtckDescription').froalaEditor('core.isEmpty')) {
            e.preventDefault();
            var error = "Please enter descriprion";
            $('#descriptionErr').text(error);
            $('#descriptionErr').show();
            return false;
          }else{
            $('#descriptionErr').text('');
            $('#descriptionErr').hide();
            return true;
          }
        });

        $("#btn_submit").click(function(e){
            $("#frmCreateBlog").validate({
                rules: {
                    txtBlogName: {
                        required: true
                    },
                    smtp_security: {
                        required: true
                    },
                    txtckDescription:{
                        required : true
                    },
                    txtBlogMetaDescription:{
                        maxlength:170
                    }
                },
                messages: {
                    txtBlogName: "Please enter blog title",
                    smtp_security: "Please select genre",
                    txtckDescription: {
                        required: "Please enter descriprion"
                    }
                },
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
            });
            // if ($('#txtckDescription').froalaEditor('core.isEmpty')) {
            //     e.preventDefault();
            //     var error = "Please enter descriprion";
            //     $('#descriptionErr').text(error);
            //     $('#descriptionErr').show();
            //     return false;
            // }
        });
        $("#draft_btn").click(function(e){
            $("#frmCreateBlog").validate({
                rules: {
                    txtBlogName: {
                        required: true
                    },
                    smtp_security: {
                        required: true
                    },
                    txtckDescription:{
                        required: true
                    },
                    txtBlogMetaDescription:{
                        maxlength:170
                    }
                },
                messages: {
                    txtBlogName: "Please enter blog title",
                    smtp_security: "Please select genre",
                    txtckDescription: {
                        required: "Please enter descriprion"
                    }
                }, 
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
            });
            // if ($('#txtckDescription').froalaEditor('core.isEmpty')) {           
            //     e.preventDefault();
            //     var error = "Please enter descriprion";
            //     $('#descriptionErr').text(error);
            //     $('#descriptionErr').show();
            //     return false;
            // }
        });

        $('[data-toggle="tooltip"]').tooltip();    
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
        
        $("body").on('click','#loadmore',function(){
            var page = $(this).attr('data-page');
            $('#ajax-load-blogs').show();
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
                        $('#ajax-load-blogs').hide();
                        $('#load_more_blog').hide();
                        $("#published_blogs").append(result);  
                    }
                }
            });
        });
    });
  
    $("#error_keyword").hide();
    // $("#txtBlogKeywords").blur(function(){
    //     var a = $("#txtBlogKeywords").val();
    //     var x = new Array();
    //     x = a.split(",");
    //     if(x.length>100){
    //         $("#error_keyword").show();
    //         $("#txtBlogKeywords").val('');
    //         return false;
    //     }else{
    //         $("#error_keyword").hide(); 
    //     }  
    // });
    $("body").on("click",".discard",function(){
        swal({
                title: "Are you sure you want to discard ?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            });
    });

    $("body").on("click",".swal-button--confirm",function(){
       window.location.href = "{{route('profile')}}";
    });
    
$(function(){
      $('#txtckDescription').froalaEditor({

        // Set the image upload parameter.
        imageUploadParam: 'image',
 
        // Set the image upload URL.
        imageUploadURL: "{{ route('uploadEditorImage') }}",
 
        // Additional upload params.
        imageUploadParams: {_token: '{{ csrf_token() }}'},
 
        // Set request type.
        imageUploadMethod: 'POST',
 
        // Set max image size to 5MB.
        imageMaxSize: 5 * 1024 * 1024,
 
        // Allow to upload PNG and JPG.
        imageAllowedTypes: ['jpeg', 'jpg', 'png'],

        // Set the video upload parameter.
        videoUploadParam: 'video',
 
        // Set the video upload URL.
        videoUploadURL: "{{ route('uploadEditorVideo') }}",
 
        // Additional upload params.
        videoUploadParams: {_token:'{{ csrf_token() }}'},
 
        // Set request type.
        videoUploadMethod: 'POST'
      });
    });

  </script>
@endsection