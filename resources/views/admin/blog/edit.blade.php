@extends('admin.layouts.app')



@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Edit Blog</h2>

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



{!! Form::model($blog, ['method' => 'POST','files'=> true,'route' => ['admin.blog.update', $blog->blog_slug]]) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Title:</strong>

            {!! Form::text('blog_title', null, array('placeholder' => 'Blog Title','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>
    <!-- <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Heading:</strong>

            {!! Form::text('blog_heading', null, array('placeholder' => 'Blog Heading','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div> -->

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Select Genres:</strong>

            <select name='blog_genre' id='blog_genre' class='form-control'>
                <option>Select Genres</option>
                @foreach($genres as $genre)
                <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endforeach
           </select>
        </div>

    </div>
     <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Select Child Genres:</strong>

            <select name='blog_child_genre' id='blog_child_genre' class='form-control'>
                <option>Select Genres</option>
                
           </select> 
        </div>

    </div>
    <!-- <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Select Genres:</strong>

            <select name='blog_genre' class='form-control'>
                <option>Select Genres</option>
                @foreach($genres as $genre)
                <option value="{{$genre->id}}" @if($genre->id == $blog->blog_genre) {{'selected'}} @endif>{{$genre->name}}</option>
                @endforeach
           </select>
        </div>

    </div> -->
   <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Profile Picture:</strong>

            {!! Form::file('blog_image', array('placeholder' => 'blog image','class' => 'form-control')) !!}
            <?php if (isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image)) { ?>
                <img src="{{ asset("/public/blog_img/".$blog->blog_image) }}"  height='100' width='100'>
            <?php } else { ?>
                <img src="{{ asset('/') }}public/blog_img/no_img.jpg" alt="Blog" height='100' width='100'>
            <?php } ?>
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

            {!! Form::text('blog_keywords', null, array('placeholder' => 'Blog Keywords','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

         <div class="form-group test{{$blog->blog_status}}">
             <strong>Blog Status:</strong>
             <select name="blog_status">
             	 @if($blog->blog_status == 1)
                 <option value="1" selected="selected">Published</option>
                 <option value="2">Draft</option>
                 @else
                 <option value="1">Published</option>
                 <option value="2" selected="selected">Draft</option>
                 @endif
             </select>
         </div>
     </div>


     <div class="col-xs-12 col-sm-12 col-md-12">

         <div class="form-group">
             <strong>Featured:</strong>
             <input type="checkbox" name="is_featured" id="is_featured" value="1" <?php if(isset($blog->is_featured) && $blog->is_featured==1){ ?> checked='checked' <?php } ?>>
         </div>
     </div>

     <div class="col-xs-12 col-sm-12 col-md-12">

         <div class="form-group">
             <strong>Tranding:</strong>
             <input type="checkbox" name="is_tranding" id="is_tranding" value="1" <?php if(isset($blog->is_tranding) && $blog->is_tranding==1){ ?> checked='checked' <?php } ?>>
         </div>
     </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}



@endsection