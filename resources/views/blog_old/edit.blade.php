@extends('layouts.app')
@section('title','Edit Blog')
@section('content')
<style>
    .fr-popup .fr-input-line label {
        display: none !important;
    }
</style>
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
                            <div class="profile_main_section">
                                <p class="content" style="word-wrap: break-word;">
                                     {!! nl2br(Auth::guard('web')->user()->description) !!}
                                </p>
                            </div>
                        </div>
                        <form name="frmEditBlog" id="frmEditBlog" method="POST" enctype="multipart/form-data" action="{{ route('updateblog') }}">
                            @csrf
                            <div class="profile_page_main_section margin-bottom-30">
                                <div class="profile_main_title_section title_secondary_section">
                                    <h2 class="title">
                                        Edit 
                                    </h2>

                                    <a href="{{ route('draft') }}" class="edit_icon" title="edit">
                                        <i class="fa fa-close"></i>
                                        Close
                                    </a>
                                </div>
                                <div class="profile_main_section">
                                    <div class="blog_form">
                                        <div class="form-group">
                                            <input type="hidden" name="txtBlogId" id="txtBlogId" value="{{ $blog->id }}">
                                            <input type="hidden" name="txtBlogSlug" id="txtBlogSlug" value="{{ $blog->blog_slug }}">
                                            <input type="text" class="form-control space" placeholder="Title goes here" name="txtBlogName" id="txtBlogName" value="{{ $blog->blog_title }}">
                                            @if ($errors->has('txtBlogName'))
                                                <div class="error">{{ $errors->first('txtBlogName') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control space" placeholder="Heading goes here" name="txtBlogHeading" id="txtBlogHeading" value="{{ $blog->blog_heading }}">
                                            @if ($errors->has('txtBlogHeading'))
                                                <div class="error">{{ $errors->first('txtBlogHeading') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <strong>Genre</strong>
                                                <select name="smtp_security" class="form-control">
                                                    <option value="">Select Genre</option>
                                             @foreach ($genrearr as $genr)
                                                    <option value="{{$genr->id}}"
                                                     @if($genr->id == $blog->blog_genre){{'selected'}} @endif >{{$genr->name}}</option>
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
                                        <div class="form-group">
                                            @if($blog->blog_image != "")
                                                <div>
                                                    <a class="example-image-link" href="{{ asset('/') }}public/blog_img/{{ $blog->blog_image }}" data-lightbox="example-1">
                                                        <img src="{{ asset('/') }}public/blog_img/{{ $blog->blog_image }}" height="200px;" width="200px;">
                                                    </a>
                                                    <!--<button class="btn btn-primary" type="submit" name="draft_btn">Remove Image</button>-->
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Compose New</label>
                                            <textarea rows="5" id="txtckDescription" name="txtDescription" class="form-control">{{ $blog->blog_description }}</textarea>
                                        </div>
                                        <b><span id="descriptionErr" class="error"></span></b>
                                        @if ($errors->has('txtckDescription'))
                                            <div class="error">{{ $errors->first('txtckDescription') }}</div>
                                        @endif
                                    </div>
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
                                            <input type="text" class="form-control space" placeholder="Meta Description" name="txtBlogMetaDescription" id="txtBlogMetaDescription" value="{{ $blog->blog_meta_description }}">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="The purpose of a meta description for your page is simple: to get someone searching on Google to click your link. In other words, meta descriptions are there to generate clickthroughs from search engines"></i>
                                        </div>
                                        <div class="form-group form-group-info">
                                            <input type="text" class="form-control space" placeholder="Keywords" name="txtBlogKeywords" id="txtBlogKeywords" value="{{ $blog->blog_keywords }}">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Meta Keywords are a specific type of meta tag that appear in the HTML code of a Web page and help tell search engines what the topic of the page is. ... The most important thing to keep in mind when selecting or optimizing your meta keywords is to be sure that each keyword accurately reflects the content of your pages."></i>
                                        </div><span id="error_keyword" style="display: none;color:red">maximum limit keyword 100</span>
                                        <div class="btn_section">
                                            <button type="button" class="btn btn-default discard">Discard</button>
                                            <button class="btn btn-primary" type="submit" name="draft_btn" id="draft_btn">Save as Draft</button>
                                            <button class="btn btn-secondary" name="publish_btn" id="btn_submit" type="submit">Publish</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            
    </section>
   <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
   <script src="{{URL::asset('public/assets/frola/js/plugins/video.min.js')}}"></script>
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
         
        $('[data-toggle="tooltip"]').tooltip(); 
        $("#edit_description").click(function(){
                var words = $("#txt_Description").text().match(/\S+/g).length;
                var total_Word_limit = "<?php echo getLimitofsummery(); ?>";
                $("#display_count").text(words);
                $("#word_left").text((total_Word_limit - words));
                $('#myModal').modal('show');
            });
    });
    // var config = {
    // filebrowserBrowseUrl: 'assets/libraries/ckfinder_php_3.4.2/ckfinder/ckfinder.html?resourceType=Files',
    //         filebrowserUploadUrl: 'assets/libraries/ckfinder_php_3.4.2/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    //         simpleuploads_acceptedExtensions : 'gif|jpeg|jpg|png'            
    // };
    /*CKEDITOR.replace('txtckDescription',config);*/
    
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
<script>
    $(function(){
    //$('#txtckDescription').froalaEditor();
 //    $.FroalaEditor.DefineIcon('imageInfo', {NAME: 'info'});
	// $.FroalaEditor.RegisterCommand('imageInfo', {
	//   title: 'Info',
	//   focus: false,
	//   undo: false,
	//   refreshAfterCallback: false,
	//   callback: function () {
	//     var $img = this.image.get();
	//     alert($img.attr('src'));
	//   }
	// });
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
        videoMaxSize: 500 * 1024 * 1024
      });

     $("#btn_submit").click(function(){
        if ($('#txtckDescription').froalaEditor('core.isEmpty')) {
            
            var error = "Please enter descriprion";
            $('#descriptionErr').text(error);
            $('#descriptionErr').show();
          }
            $("#frmEditBlog").validate({
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
                    txtckDescription : "Please enter descriprion"
                },
            });
        });
            

        $("#draft_btn").click(function(){
        if ($('#txtckDescription').froalaEditor('core.isEmpty')) {
           
           var error = "Please enter descriprion";
           $('#descriptionErr').text(error);
           $('#descriptionErr').show();
         }
           $("#frmEditBlog").validate({
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
                   txtckDescription : "Please enter descriprion"
               },
           });
       });
    });
  </script>

@endsection

