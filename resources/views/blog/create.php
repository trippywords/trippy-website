@extends('layouts.app')

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

                            <div class="profile_main_section">

                                                            <p class="content" style="word-wrap: break-word;">

                                    <?php echo nl2br(Auth::guard('web')->user()->description); ?>

                                </p>

                            </div>

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

                                            <input type="text" value="{{ old('txtBlogName') }}" required="required" class="form-control" placeholder="Title goes here" name="txtBlogName" id="txtBlogName">

                                        </div>

                                        <div class="form-group">

                                            <input type="text" value="{{ old('txtBlogName') }}" required="required" class="form-control" placeholder="Heading goes here" name="txtBlogHeading" id="txtBlogHeading">

                                        </div>

                                        <div class="form-group">

                                            <strong>Genre</strong>

                                                <select name="smtp_security" class="form-control" required>

                                                    <option value="">Select Genre</option>

                                             @foreach ($genrearr as $genr)

                                                    <option value="{{$genr->id}}">{{$genr->name}}</option>

                                              @endforeach

                                                </select>

                                        </div>

                                        <div class="form-group">

                                            <strong>Blog Picture:</strong>

                                                {!! Form::file('blog_image', array('placeholder' => 'blog image','class' => 'form-control')) !!}

                                        </div>

                                        <div class="form-group">

                                            <label>Compose New</label>

                                                <textarea rows="5" id="txtckDescription" name="txtDescription"  class="form-control"></textarea>

                                        </div>

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

                                        <div class="form-group">

                                            <input type="text" value="{{ old('txtBlogName') }}" title="The purpose of a meta description for your page is simple: to get someone searching on Google to click your link. In other words, meta descriptions are there to generate clickthroughs from search engines"  class="form-control" placeholder="Meta Description" name="txtBlogMetaDescription" id="txtBlogMetaDescription">

                                        </div>

                                        <div class="form-group">

                                            <input type="text" value="{{ old('txtBlogName') }}" title="Meta Keywords are a specific type of meta tag that appear in the HTML code of a Web page and help tell search engines what the topic of the page is. ... The most important thing to keep in mind when selecting or optimizing your meta keywords is to be sure that each keyword accurately reflects the content of your pages."  class="form-control" placeholder="Keywords" name="txtBlogKeywords" id="txtBlogKeywords">

                                        </div>

                                                                                <span id="error_keyword" style="color:red">maximum limit keyword 100</span>

                                        <div class="btn_section">

                                            <button class="btn btn-default">Discard</button>

                                            <button class="btn btn-primary" type="submit" name="draft_btn">Save as Draft</button>

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

                            <a href="javascript:;" class="edit_icon show_edit_section" title="edit">

                                <i class="fa fa-edit"></i>

                                    Edit

                            </a>

                        </div>

                        <div class="profile_main_section no-padding" id="published_blogs">

                            @if(count($publish_blogs) > 0)

                            @foreach ($publish_blogs as $blog)

                            <div class="media" data-val="<?php echo $blog->id; ?>">

                                <div class="media-left">

                                    @if($blog->blog_image!='')

                                    <a href="blog/{{ $blog->blog_slug }}" target="_blank"><img src="public/blog_img/{{ $blog->blog_image }}" class="media-object"></a>

                                    @else

                                    <a href="blog/{{ $blog->blog_slug }}" target="_blank"><img src="public/blog_img/blog-2.jpg" class="media-object"></a>

                                    @endif

                                </div>

                                <div class="media-body">

                                    <h4 class="media-heading"><a target="_blank" href="blog/{{ $blog->blog_slug }}">{{ $blog->blog_title }}</a></h4>

                                    <p class="media-content">@php echo html_entity_decode(str_limit($blog->blog_description, 200)) @endphp</p>

                                    <div class="media-sub-content">Genre:  Design, Illustration</div>

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

                                    <p class="content_text">Awww ! no blogs. Write now <span>Just click on button</span></p>

                                </div>

                                @endif

                        </div>
                        <div id="load_more_blog">
                            <div class="ajax-load text-center" style="display:none">

                                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>

                            </div>

                            @if(count($publish_blogs) > 3)

                                <div class="blog_button">

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

                  Total word count: <span id="display_count">0</span> words. Words left: <span id="word_left"><?php echo getLimitofsummery(); ?></span> 

              </div>

              <div class="modal-footer">

                <input type="submit" class="btn btn-primary" value="Update">

              </div>

            </div>

           </form>

      </div>

    </div>

    <script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>

    <script src="{{url('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>

    <script>

       /* $('textarea').ckeditor();*/

        // $('#btn_submit').click(function(){

        //  $("#frmCreateBlog").submit();

        // })

    </script>

    

<script type="text/javascript">

    $(document).ready(function(){

        $("#edit_description").click(function(){

                var words = $("#txt_Description").text().match(/\S+/g).length;

                var total_Word_limit = "<?php echo getLimitofsummery(); ?>";

                $("#display_count").text(words);

                $("#word_left").text((total_Word_limit - words));

                $('#myModal').modal('show');

            });

    });

    var config = {

    filebrowserBrowseUrl: 'public/assets/libraries/ckfinder_php_3.4.2/ckfinder/ckfinder.html?resourceType=Files',

            filebrowserUploadUrl: 'public/assets/libraries/ckfinder_php_3.4.2/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

            simpleuploads_acceptedExtensions : 'gif|jpeg|jpg|png'            

    };

    CKEDITOR.replace('txtckDescription',config);

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

</script>



@endsection



