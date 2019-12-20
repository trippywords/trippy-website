@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Child Genre</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin-child-genre') }}"> Back</a>
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
    {!! Form::open(array('route' => 'admin-child-genre.store','method'=>'POST','files'=> true)) !!}

    	@csrf
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
                    {!! Form::text('child_genre_name', old('child_genre_name'), array('placeholder' => 'Name','class' => 'form-control','required'=>'required')) !!}
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
                     {!! Form::textarea('child_genre_detail', old('child_genre_detail'), array('placeholder' => 'Summary of Child Genre','class' => 'form-control','required'=>'required')) !!}
		        </div>
		    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Parent Genre:</strong>
                    {!! Form::select('selParent',([null=>'Select Genre'] + $ParentGenres), 
                            null, array('class' => 'form-control','required'=>'required')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
               <strong>Is Published:</strong>     
             {!! Form::select('selPublished', ['' => 'Select Status', '1' => 'Yes', '0' => 'No'],null,array('class'=>'form-control','required'=>'required')) !!}
                 </div>
             </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    {!! Form::file('genImage',null,array('class'=>'form-control','required'=>'required'))!!}
                </div>
            </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>
    </form>
@endsection