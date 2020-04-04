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



{!! Form::model($blog, ['id'=>'blog','method' => 'POST','files'=> true,'route' => ['admin.blog.update', $blog->id]]) !!}

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

        

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

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

    </div>
    
   <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Picture:</strong>

            <input type="file" name="blog_image" class="form-control" />
            <?php if (isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image)) { ?>

              <img src="{{ asset('/public/blog_img/'.$blog->blog_image)}}" class="img-thumbnail" width="100" />
              <input type="text" name="hidden_image" value="{{ $blog->blog_image }}" />
             <?php  } else { ?>
                 <img src="{{ asset('/') }}public/blog_img/no_img.jpg" alt="Blog" height='100' width='100'> 
            <?php } ?> 

       </div>

            <!-- {!! Form::file('blog_image', array('placeholder' => 'blog image','class' => 'form-control')) !!}
            <?php //if (isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image)) { ?>
                <img src="{{ asset("/public/blog_img/".$blog->blog_image) }}"  height='100' width='100'>
            <?php // } else { ?>
                <img src="{{ asset('/') }}public/blog_img/no_img.jpg" alt="Blog" height='100' width='100'>
            <?php //} ?> -->
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
                 <option value="0">Un-published</option>
                 <option value="2">Draft</option>
                 @elseif($blog->blog_status == 0)
                 <option value="1">Published</option>
                  <option value="0" selected="selected">Un-published</option>
                 <option value="2">Draft</option>
                 @else
                 <option value="1">Published</option>
                 <option value="0">Un-published</option>
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
             <strong>Trending:</strong>
             <input type="checkbox" name="is_trending" id="is_trending" value="1" <?php if(isset($blog->is_trending) && $blog->is_trending==1){ ?> checked='checked' <?php } ?>>
         </div>
     </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}



@endsection

<script src="{{ asset('public/assets/bootstrap/js/jquery.min.js') }}"></script> 
<script src="{{ asset('public/admin-assets/js/custom/admin-multilevel-dropdown.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
