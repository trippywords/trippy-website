@extends('admin.layouts.app')
@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Create New Blog</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('admin.blog') }}"> Back</a>

        </div>

    </div>

</div>



@if (count($errors) > 0)

  <div class="alert alert-danger">

    <strong>Whoops!</strong> There were some problems with your input.<br><br>

    <ul>

       @foreach ($errors->all() as $error)

         <li>{{ $error }}</li>

       @endforeach

    </ul>

  </div>

@endif




<!-- {!! Form::open(array('id'=>'blog','route' => 'admin.blog.store','method'=>'POST','files'=> true)) !!} -->
<!-- {!! Form::open(array('id'=>'blog','route' => 'admin.blog.store','method'=>'POST','files'=> true)) !!} -->
<form id="blog" action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
<div class="row">
    {{ csrf_field() }}

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Title:</strong>

            {!! Form::text('blog_title', null, array('placeholder' => 'Blog Title','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>
   <!--  <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Heading:</strong>

            {!! Form::text('blog_heading', null, array('placeholder' => 'Blog Heading','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div> -->
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Select Genres:</strong>

            <select name='parent_genre_id' id='parent_genre_id' class='form-control'>
                <option value="">Select Genres</option>
                @foreach($genres as $genre)
                <option value="{{$genre->id}}">{{$genre->parent_name}}</option>
                @endforeach
           </select>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Select Child Genres:</strong>

            <select name='blog_genre' id='blog_genre' class='form-control'>
                <option value="">Select Genres</option>
                
           </select> 
        </div>

    </div>


    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Picture:</strong>

            <input type="file" name="blog_image" class="form-control" role="form">

            <!-- {!! Form::file('blog_image', array('placeholder' => 'blog image','class' => 'form-control','required'=>'required')) !!} -->

        </div>

    </div>
    
    
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Description:</strong>            
            {!! Form::textarea('blog_description', null, array('placeholder' => 'Blog Description','class' => 'form-control','required'=>'required','rows'=>'2')) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Meta Description:</strong>            
            {!! Form::textarea('blog_meta_description', null, array('placeholder' => 'Blog Meta Description','class' => 'form-control','required'=>'required','rows'=>'2')) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Keywords:</strong>

            {!! Form::text('blog_keywords', null, array('placeholder' => 'Blog Keywords','class' => 'form-control','required'=>'required','id'=>'blog_keywords')) !!}

        </div>
        <span id="error_keyword" style="color:red;display: none">maximum limit keyword 100</span>

    </div>
     <div class="col-xs-12 col-sm-12 col-md-12">

         <div class="form-group">
             <strong>Blog Status:</strong>
             <select name="blog_status">
                 <option value="1">Published</option>
                 <option value="0">Un-Published</option>
                 <option value="2">Draft</option>
             </select>
         </div>
     </div>

      <div class="col-xs-12 col-sm-12 col-md-12">

         <div class="form-group">
             <strong>Featured:</strong>
             <input type="checkbox" name="is_featured" id="is_featured" value="1">
         </div>
     </div>

     <div class="col-xs-12 col-sm-12 col-md-12">

         <div class="form-group">
             <strong>Trending:</strong>
             <input type="checkbox" name="is_trending" id="is_trending" value="1">
         </div>
     </div>
     
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}
@endsection




<!-- <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script> -->
  <script src="{{ asset('public/assets/bootstrap/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/admin-assets/js/custom/admin-multilevel-dropdown.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script >

    
        $(document).keyup(function(){
            $("#blog").validate({
              // Specify vaidation rules

              rules: {      
                "blog_title": {
                     required : true,
                     minlength :15,
                },

                "parent_genre_id" : {
                    required : true
                },

                "blog_genre" : {
                    required : true
                },

                "blog_image" : {
                    required : true,
                    
                },
                "blog_description":{
                    required:true,
                },

                "blog_meta_description":{
                    required:true,
                },

                "blog_keywords" :{
                    required : true,
                }

            },
            messages: {    
                "blog_title" :{
                    required: "Input required",
                    minlength: "Please, at least {0} characters are necessary",
                    },
                "parent_genre_id" :{
                    required: "Please select parent genre",
                    },
                "blog_genre" :{
                    required: "Please select child genre",
                },
                "blog_image" : {
                    required : "Please upload file",
                },
                "blog_keywords":{
                    required : "This field is required",
                }
                
                }
            });
        });
        
    $("#error_keyword").hide();
    $("#blog_keywords").blur(function(){
            var a = $("#blog_keywords").val();
            var x = new Array();
            x = a.split(",");
            if(x.length>100){
                //alert("keyword max limit only 100 words");
                //console.log(x.length);
                $("#error_keyword").show();
                $("#blog_keywords").val('');
                return false;
            }else{
                $("#error_keyword").hide();
            }
            
    });
 </script>
 