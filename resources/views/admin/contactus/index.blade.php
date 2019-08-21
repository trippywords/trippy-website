@extends('admin.layouts.app')
@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Contactus Management</h2>
		</div>
	</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
	<p>{{ $message }}</p>
</div>
@endif
<table id="table-contactus" class="display table table-hover table-striped" cellspacing="0" width="100%">
	<thead>
 		<tr>
 			<th>Id</th>
 			<th>Name</th>
 			<th>Email</th>
 			<th>Message</th>
 			<th>Created date</th>
 			<th>Status</th>
 			<th width="280px">Action</th>
 		</tr>
	</thead>
	<tfoot>
			<th>Id</th>
 			<th>Name</th>
 			<th>Email</th>
 			<th>Message</th>
 			<th>Created date</th>
 			<th>Status</th>
 			<th width="280px">Action</th>
	</tfoot>
</table>
@endsection

@section('footer_script')

	<script src="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.js') }}"></script>
	<!-- datatable examples -->
	<script src="{{ url('/public/admin-assets/js/custom/table-contactus.js') }}"></script>

@endsection

@section('header_css')
	<link rel="stylesheet" href="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.css') }}">
@endsection

