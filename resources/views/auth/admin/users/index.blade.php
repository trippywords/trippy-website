@extends('admin.layouts.app')
@section('content')
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Users Management</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('admin.users.create') }}"> Create New User</a>

        </div>

    </div>

</div>
@if ($message = Session::get('success'))

<div class="alert alert-success">

  <p>{{ $message }}</p>

</div>

@endif



<table id="table-user" class="display table table-hover table-striped" cellspacing="0" width="100%">
<thead>
 <tr>

   <th>No</th>
   <th>User Image</th>
   <th>Name</th>

   <th>Email</th>
   
   <th>Registration Date</th>
   <th>Last Login Date</th>
   <th>Status</th>

<!--   <th>Roles</th>-->

   <th width="280px">Action</th>

 </tr>
</thead>
<tfoot>
    <th>No</th>
   <th>User Image</th> 
   <th>Name</th>

   <th>Email</th>
   
   <th>Registration Date</th>
   <th>Last Login Date</th>
   <th>Status</th>
<!--   <th>Roles</th>-->

   <th width="280px">Action</th>
</tfoot>

</table>







@endsection

@section('footer_script')

	<script src="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.js') }}"></script>
	<!-- datatable examples -->
	<script src="{{ url('/public/admin-assets/js/custom/table-user.js') }}"></script>

@endsection

@section('header_css')
	<link rel="stylesheet" href="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.css') }}">
@endsection
