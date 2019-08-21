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




{!! Form::open(array('route' => 'admin.blog.store','method'=>'POST','files'=> true)) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Title:</strong>

            {!! Form::text('blog_title', null, array('placeholder' => 'Blog Title','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Heading:</strong>

            {!! Form::text('blog_heading', null, array('placeholder' => 'Blog Heading','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Select Genres:</strong>

            <select name='blog_genre' class='form-control'>
                <option>Select Genres</option>
                @foreach($genres as $genre)
                <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endforeach
           </select>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Picture:</strong>

            {!! Form::file('blog_image', array('placeholder' => 'blog image','class' => 'form-control')) !!}

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
                 <option value="2">Draft</option>
             </select>
         </div>
     </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}
@endsection

<script>    
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