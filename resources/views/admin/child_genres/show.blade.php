@extends('admin.layouts.app')



@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Child Genres</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin-child-genre') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Child Genre Name:</strong>
                {{ $childgenre->child_genre_name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $childgenre->child_genre_detail }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">

            <strong>Child Picture:</strong>
            <?php if (isset($childgenre->child_genre_image) && $childgenre->child_genre_image != null && file_exists(public_path() . '/genre_img/' . $childgenre->child_genre_image)) { ?>
                <img src="{{ asset("/public/genre_img/".$childgenre->child_genre_image) }}" 
            <img src='{{ asset('public/genre_img/'.$childgenre->child_genre_image) }}' height='100' width='100'>
            <?php } else { ?>
                <img src="{{ asset('/') }}public/genre_img/no_img.jpg" alt="Child Genre" height='100' width='100'>
            <?php } ?>

        </div>
    </div>
@endsection