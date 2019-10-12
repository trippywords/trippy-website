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
                                            <strong>Parent Genre</strong>
                                                <select name="parent_genre_id" id="parent_genre_id" class="form-control">
                                                    <option value="">Select Parent Genre</option>
                                             @foreach ($genres as $genr)
                                                    <option value="{{$genr->id}}"
                                                     @if($genr->id == $blog->parent_genre_id){{'selected'}} @endif >{{$genr->parent_name}}</option>
                                              @endforeach
                                             
                                                </select>
                                                @if ($errors->has('parent_genre_id'))
                                                    <div class="error">{{ $errors->first('parent_genre_id') }}</div>
                                                @endif
                                        </div>

                                        <div class="form-group">
                                            <strong>Child Genre</strong>
                                                <select name="blog_genre" id="blog_genre" class="form-control">
                                                    <option value="">Select child Genre</option>
                                             @foreach ($childgenres as $genr)
                                                    <option value="{{$genr->id}}"
                                                     @if($genr->id == $blog->blog_genre){{'selected'}} @endif >{{$genr->child_genre_name}}</option>
                                              @endforeach
                                             
                                                </select>
                                                @if ($errors->has('blog_genre'))
                                                    <div class="error">{{ $errors->first('blog_genre') }}</div>
                                                @endif
                                        </div>



                                        <div class="form-group">

                                            <strong>Blog Picture:</strong>

                                            {!! Form::file('blog_image', array('placeholder' => 'blog image','class' => 'form-control')) !!}

                                        </div>
                                        <div class="form-group">
                                            @if(isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image))
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
                                        <span style="color:#57bb47"> Total character count: <span id="display_meta_count">0</span> characters. Characters left: <span id="word_meta_left">170</span></span>
                                        <div class="form-group form-group-info">
                                            <input type="text" class="form-control" placeholder="Tags" name="txtBlogKeywords" id="txtBlogKeywords" data-role="tagsinput"  value="{{ $blog->blog_keywords }}">
                                            <!-- <input type="text" class="form-control tags" placeholder="Keywords" name="txtBlogKeywords" id="txtBlogKeywords" value="{{ $blog->blog_keywords }}"> -->
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Keywords can be entered as comma separated texts (... , ...)"></i>
                                        </div>
                                        <span id="error_keyword" style="display: none;color:red">maximum limit keyword 100</span>
                                        <div class="btn_section">
                                            <button type="button" class="btn btn-default discard" name="discard_btn">Discard</button>
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
<script src="{{ asset('public/assets/bootstrap/js/bootstrap.min.js') }}"></script>  
<script src="{{ asset('public/assets/bootstrap/js/bootstrap-tagsinput.min.js') }}"></script> 
<script src="{{ asset('public/assets/bootstrap/js/jquery.min.js') }}"></script> 
<script type="text/javascript">
    $(document).ready(function(){

         $('select[name="parent_genre_id"]').on('change',function(){
             var id=$(this).val();
             
            // console.log(id);
             if(id)
                {
                    $.ajax({
                        type:'GET',
                        dataType:'json',
                        url:"{{url('/dropdown')}}?id="+id,
                        success:function(data)
                        {
                            //console.log(data);
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
        }).trigger('keyup');

        // $('#txtBlogKeywords').bind('keypress', function (event) {
        //     var regex = new RegExp("^[a-zA-Z0-9@_.]+$");
        //     var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        //     if (!regex.test(key)) {
        //        event.preventDefault();
        //        return false;
        //     }
        // });

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
    // $("#txtBlogKeywords").blur(function(){
    //         var a = $("#txtBlogKeywords").val();
    //         var x = new Array();
    //         x = a.split(",");
    //         if(x.length>100){
    //             //alert("keyword max limit only 100 words");
    //             //console.log(x.length);
    //             $("#error_keyword").show();
    //             $("#txtBlogKeywords").val('');
    //             return false;
    //         }else{
    //             $("#error_keyword").hide();
    //         }
            
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

    $('form').on('submit', function (e) {
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

    $("#btn_submit").click(function(){
            $("#frmEditBlog").validate({
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
                    txtckDescription : "Please enter descriprion"
                },
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
            });
        });
            

        $("#draft_btn").click(function(){
           $("#frmEditBlog").validate({
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
                   txtckDescription : "Please enter descriprion"
               }, 
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
           });
       });
    });
  </script>

@endsection

