@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Parent Genre</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin-parent-genre') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin-parent-genre.store') }}" method="POST" id="parent_form" >
    	@csrf
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
                    {!! Form::text('parent_name', old('parent_name'), array('placeholder' => 'Name','class' => 'form-control','required'=>'required')) !!}
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
                     {!! Form::textarea('parent_detail', old('parent_detail'), array('placeholder' => 'Summary of Parent Genre','class' => 'form-control','required'=>'required')) !!}
		        </div>
		    </div>
            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Parent Genre:</strong>
                    <select class="form-control" name="selParent">
                        <option value="0">Select Genre</option>
                        <?php //foreach($genres as $g): ?>
                            <option value="<?php //echo $g->id; ?>"><?php //echo $g->name; ?></option>
                        <?php //endforeach; ?>
                    </select>
                </div>
            </div> -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Is Published:</strong>
                    <select class="form-control" required="required" name="selPublished">
                        <option value="">Select Status</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>
    </form>
@endsection

<script src="{{ asset('public/assets/bootstrap/js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script >

    
        $(document).keyup(function(){

            $.validator.addMethod("firstAlfa", function(value, element) {
            return this.optional(element) || /^[A-Za-z_ ][A-Za-z0-9_ ]*$/.test(value);
            }, "First letter shuld be characters");

            $("#parent_form").validate({
              // Specify vaidation rules

              rules: {      
                "parent_name":{
                    required:true,
                    firstAlfa:true,
                    maxlength:50,
                }

            },
           
            });
        });
        
    
 </script>