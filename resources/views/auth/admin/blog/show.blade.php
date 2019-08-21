@extends('admin.layouts.app')







@section('content')



<div class="row">



    <div class="col-lg-12 margin-tb">



        <div class="pull-left">



            <h2> Show Blog</h2>



        </div>



        <div class="pull-right">



            <a class="btn btn-primary" href="{{ route('admin.blog') }}"> Back</a>



        </div>



    </div>



</div>







<div class="row">



    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Blog Title:</strong>



            {{ $blog->blog_title }}



        </div>



    </div>

     <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Blog Heading:</strong>



            {{ $blog->blog_heading }}



        </div>



    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Blog Picture:</strong>

            <?php if (isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image)) { ?>
                <img src="{{ asset("/public/blog_img/".$blog->blog_image) }}" 
            <img src='{{ asset('public/blog_img/'.$blog->blog_image) }}' >
            <?php } else { ?>
                <img src="{{ asset('/') }}public/blog_img/no_img.jpg" alt="Blog">
            <?php } ?>



        </div>



    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Blog Create By:</strong>



            {{ $creator_name }}



        </div>



    </div>

   

    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Blog Description:</strong>



            {{ $blog->blog_description }}



        </div>



    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Blog Meta Description:</strong>



            {{ $blog->blog_meta_description }}



        </div>



    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Blog Keywords:</strong>



            {{ $blog->blog_keywords }}



        </div>



    </div>

     

</div>



@endsection