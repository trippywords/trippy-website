@extends('admin.layouts.app')


@section('content')
	
<div class="animated fadeIn">
	<h3>Parent Genre</h3>
	<small>
		<a href="">Manage Parent Genres</a>
	</small>
		<div class="pull-right">
			<!-- @can('genre-create') -->
			
			<!-- @endcan -->
			<a class="btn btn-success" href="{{ route('admin-parent-genre.create') }}"> Create New Parent Genre</a>
		</div>
	<br/>
	<br/>

	<div class="row">
		<div class="col-md-12">
			<div class="card card-accent-theme">
				<div class="card-body">
					@if ($message = Session::get('success'))
								<div class="alert alert-success">
												<p>{{ $message }}</p>
								</div>
				@endif
					<table id="table-parent-genre" class="display table table-hover table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								
								<th>Created</th>
								<th>Published</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Name</th>
								
								<th>Created</th>
								<th>Published</th>
								<th>Actions</th>
							</tr>
						</tfoot>
						<tbody>
							
						</tbody>
					</table>
				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->
		</div>
		<!-- end col -->

	</div>
	<!-- end row -->

</div>
<!-- end animated fadeIn -->

@endsection

@section('footer_script')

	<script src="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.js') }}"></script>
	<!-- datatable examples -->
	<script src="{{ url('/public/admin-assets/js/custom/table-parent-genre.js') }}"></script>

@endsection

@section('header_css')
	<link rel="stylesheet" href="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.css') }}">
@endsection