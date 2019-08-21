@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Blog Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('admin.blog.create') }}"> Create New Blog</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<table id="table-blog" class="display table table-hover table-striped" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th> # </th>
            <th>Blog Image</th>
            <th>Blog Title</th>
            <th>Blog Heading</th>
            <th>Blog Genre</th>
            <th>Created At</th>
            <th>Created By</th>
            <th>Blog Status</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th> # </th>
            <th>Blog Image</th>
            <th>Blog Title</th>
            <th>Blog Heading</th>
            <th>Blog Genre</th>
            <th>Created At</th>
            <th>Created By</th>
            <th>Blog Status</th>
            <th width="280px">Action</th>
        </tr>
    </tfoot>
    <tbody>

    </tbody>
</table>

@endsection
@section('footer_script')
<script src="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.js') }}"></script>
<!-- datatable examples -->
<script src="{{ url('/public/admin-assets/js/custom/table-blog.js') }}"></script>
@endsection
@section('header_css')
<link rel="stylesheet" href="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.css') }}">
@endsection
