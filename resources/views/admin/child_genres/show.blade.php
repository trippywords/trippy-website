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
    </div>
@endsection