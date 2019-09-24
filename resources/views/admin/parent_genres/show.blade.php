@extends('admin.layouts.app')



@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Genres</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin-parent-genre') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Parent Genre Name:</strong>
                {{ $genre->parent_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $genre->parent_detail }}
            </div>
        </div>
    </div>
@endsection