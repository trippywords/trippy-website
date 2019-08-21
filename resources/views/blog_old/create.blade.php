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

                                    <a href="{{ route("profile") }}" class="edit_icon" title="edit">
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
                                        <div class="form-group">
                                            <input type="text" value="{{ old('txtBlogHeading') }}" class="form-control space" placeholder="Heading goes here" name="txtBlogHeading" id="txtBlogHeading">
                                            @if ($errors->has('txtBlogName'))
                                                <div class="error">{{ $errors->first('txtBlogHeading') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
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
                                        </div>
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
                                        <div class="form-group form-group-info">

                                            <input type="text"  
                                              class="form-control space" placeholder="Keywords" name="txtBlogKeywords" id="txtBlogKeywords">
                                              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Meta Keywords are a specific type of meta tag that appear in the HTML code of a Web page and help tell search engines what the topic of the page is. ... The most important thing to keep in mind when selecting or optimizing your meta keywords is to be sure that each keyword accurately reflects the content of your pages."></i>
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
                            <div class="media" data-val="<?php echo $blog['id']; ?>">
                                <div class="media-left">
                                    @if($blog->blog_image!='')
                                    <a href="blog/{{ $blog->blog_slug }}" target="_blank"><img src="public/blog_img/{{ $blog->blog_image }}" class="media-object"></a>
                                    @else
                                    <a href="blog/{{ $blog->blog_slug }}" target="_blank"><img src="public/blog_img/blog-2.jpg" class="media-object"></a>
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="blog/{{ $blog->blog_slug }}">{{ $blog->blog_title }}</a></h4>
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
                                    <a href="blog-edit/{{ $blog->blog_slug }}" class="edit" title="Edit">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <a onclick="delete_blog({{ $blog->id }})" class="trash" title="Delete">
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
                        <div class="ajax-load text-center" style="display:none">
                            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                        </div>
                            @if($publish_total > 4)
                        <div class="blog_button">
                            <input type="hidden" name="publishtotal" id="publishtotal" value="{{$publish_total}}">
                            <a href="javascript:;" class="btn btn-primary" id="loadmore" title="Load More">
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
      <!--   <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
       
        <form name="frmUpdateDescription" id="frmUpdateDescription" action="{{route('update_description')}}" method="POST">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                 <textarea  required="required" id="txt_Description" name="txt_Description" onkeyup="summery_word_limit()" class="form-control" rows="15"><?php //echo Auth::guard('web')->user()->description; ?></textarea><br>
                  Total word count: <span id="display_count">0</span> words. Words left: <span id="word_left"><?php //echo getLimitofsummery(); ?></span> 
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Update">
              </div>
            </div>
           </form>
      </div>
    </div> -->
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
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

       /* $('#txtBlogKeywords').keypress(function(){
           var str = this.value.replace(/(\w)[\s,]+(\w?)/g, '$1, $2');
           // if (str!=this.value) this.value = str;
        });*/
        $("#btn_submit").click(function(e){
        if ($('#txtckDescription').froalaEditor('core.isEmpty')) {
            
           e.preventDefault();
   	   var error = "Please enter descriprion";
           $('#descriptionErr').text(error);
           $('#descriptionErr').show();
           return false;

          }
            $("#frmCreateBlog").validate({
                rules: {
                    txtBlogName: {
                        required: true
                    },
                    txtBlogHeading: {
                        required: true
                    },
                
                    smtp_security: {
                        required: true
                    },
                    txtckDescription:{
                        required : true
                    }
                },
                messages: {
                    txtBlogName: "Please enter blog title",
                    txtBlogHeading: "Please enter blog heading",
                    smtp_security: "Please select genre",
                    txtckDescription : "Please enter descriprion",
                },
            });
        });
            

        $("#draft_btn").click(function(e){
         if ($('#txtckDescription').froalaEditor('core.isEmpty')) {
            e.preventDefault();
            var error = "Please enter descriprion";
            $('#descriptionErr').text(error);
            $('#descriptionErr').show();
            return false;

          }
            $("#frmCreateBlog").validate({
                rules: {
                    txtBlogName: {
                        required: true
                    },
                    txtBlogHeading: {
                        required: true
                    },
                
                    smtp_security: {
                        required: true
                    },
                    txtckDescription:{
                        required : true
                    }
                },
                messages: {
                    txtBlogName: "Please enter blog title",
                    txtBlogHeading: "Please enter blog heading",
                    smtp_security: "Please select genre",
                    txtckDescription : "Please enter descriprion",
                },
            });
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
        $("#loadmore").click(function(){
            page++;
            var total = $("publishtotal").val();
            var dtotal = 4 * page;
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
                if(data.html == ""){
                    $("#loadmore").hide();
                    $('.ajax-load').html("No more blogs found");
                    return;
                }
                $('.ajax-load').hide();
                $("#published_blogs").append(data.html);
                if (dtotal >= total) {
                    $("#loadmore").hide();
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                  alert('server not responding...');
            });
        });
    });
    // var config = {
    // filebrowserBrowseUrl: 'public/assets/libraries/ckfinder_php_3.4.2/ckfinder/ckfinder.html?resourceType=Files',
    //         filebrowserUploadUrl: 'public/assets/libraries/ckfinder_php_3.4.2/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    //         simpleuploads_acceptedExtensions : 'gif|jpeg|jpg|png'            
    // };
    // config.removePlugins= "link";
    // CKEDITOR.replace('txtckDescription',config);
    /*CKEDITOR.instances.txtckDescription.updateElement();*/
   
    $("#error_keyword").hide();
    $("#txtBlogKeywords").blur(function(){
            var a = $("#txtBlogKeywords").val();
            var x = new Array();
            x = a.split(",");
            if(x.length>100){
                //alert("keyword max limit only 100 words");
                //console.log(x.length);
                $("#error_keyword").show();
                $("#txtBlogKeywords").val('');
                return false;
            }else{
                $("#error_keyword").hide(); 
            }
            
    });
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
</script>
<script src="{{URL::asset('public/assets/frola/js/plugins/video.min.js')}}"></script>
<script>
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
        videoUploadMethod: 'POST',
        // Set max video size to 50MB.
        videoMaxSize: 500 * 1024 * 1024,
 
        // Allow to upload MP4, WEBM and OGG
       // videoAllowedTypes: ["mp4","webm","ogg"]
      });

      
    });
  </script>

@endsection

