@extends('admin.layouts.app')
@section('content')
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Newsletter Management</h2>

        </div>        

    </div>

</div>
@if ($message = Session::get('success'))

<div class="alert alert-success">

  <p>{{ $message }}</p>

</div>

@endif
<table id="table-newsletter" class="display table table-hover table-striped" cellspacing="0" width="100%">
<thead>
 <tr>

   <th>No</th>
   <th>Newsletter email</th>
  
   <th>Subscribed Date</th>
    <th>Status</th>
   <th width="280px">Action</th>
 </tr>
</thead>
<tfoot>
    <th>No</th>
    <th>Newsletter email</th>
       
    <th>Subscribed Date</th>
    <th>Status</th>
   <th width="280px">Action</th>
</tfoot>

</table>
@endsection

@section('footer_script')

	<script src="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.js') }}"></script>
	<!-- datatable examples -->
	<script src="{{ url('/public/admin-assets/js/custom/table-newsletter.js') }}"></script>

@endsection

@section('header_css')
	<link rel="stylesheet" href="{{ url('/public/admin-assets/libs/tables-datatables/dist/datatables.min.css') }}">
@endsection
