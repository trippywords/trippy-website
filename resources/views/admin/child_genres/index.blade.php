@extends('admin.layouts.app')


@section('content')
	
<div class="animated fadeIn">
	<h3>Child Genre</h3>
	<small>
		<a href="">Manage Child Genres</a>
	</small>
		<div class="pull-right">
			<!-- @can('genre-create') -->
			
			<!-- @endcan -->
			<a class="btn btn-success" href="{{ route('admin-child-genre.create') }}"> Create New Child Genre</a>
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
					<table id="table-child-genre" class="display table table-hover table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Img</th>
								 <th>Name</th>
								<th>Parent Genre</th>
								<th>Published</th>
								<th>Created</th>
								
								<th>Actions</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Img</th>
								<th>Name</th>
								<th>Parent Genre</th>
								<th>Published</th>
								 <th>Created</th>
								
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
	<script src="{{ url('/public/admin-assets/js/custom/table-child-genre.js') }}"></script>

@endsection

@section('header_css')
	<link rel="stylesheet" href="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.css') }}">
@endsection