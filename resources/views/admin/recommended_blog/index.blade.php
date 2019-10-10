@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Recommended Blogs</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('admin.recommended-blog.create') }}"> Create New Recommended blog</a>
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
            <th>Blog Genre</th>
            <th>Created At</th>
            <th>Created By</th>
            <th>Blog Status</th>
            <th>Featured</th>
            <th>Trending</th>
            <th>Recommended</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th> # </th>
            <th>Blog Image</th>
            <th>Blog Title</th>
            <th>Blog Genre</th>
            <th>Created At</th>
            <th>Created By</th>
            <th>Blog Status</th>
            <th>Featured</th>
            <th>Trending</th>
            <th>Recommended</th>
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
<script src="{{ url('/public/admin-assets/js/custom/table-recommended-blog.js') }}"></script>
<script >
$(document).ready(function(){
    $('body').on('click','#is_recommended',function(){
        var blog_id = $(this).attr('data-id');
        $(this).attr('disabled',true);
        $.ajax({
            url: "{{ route('admin.blog.update_recommended') }}",
            type:"POST", 
            data: {'is_recommended':0,'blog_id':blog_id,'_token':"{{ csrf_token() }}"},
            success: function (result) {  
                setTimeout(function(){location.reload();}, 1000);   
            }
        });
    });
});
</script>
@endsection
@section('header_css')
<link rel="stylesheet" href="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.css') }}">
@endsection
