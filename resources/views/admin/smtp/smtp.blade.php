@extends('admin.layouts.app')



@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Update Smtp Configration</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('admin-panel') }}"> Back</a>

        </div>

    </div>

</div>



@if (count($errors) > 0)

  <div class="alert alert-danger">

    <strong>Whoops!</strong> There were some problems with your input.<br><br>

    <ul>

       @foreach ($errors->all() as $error)

         <li>{{ $error }}</li>

       @endforeach

    </ul>

  </div>

@endif



{!! Form::model($smtp, ['method' => 'POST','files'=> true,'route' => ['admin.smtp.update', $smtp->id]]) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Smtp Host :</strong>

            {!! Form::text('smtp_host', null, array('placeholder' => 'Smtp Host','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Smtp Username :</strong>

            {!! Form::text('smtp_username', null, array('placeholder' => 'Smtp Username','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Smtp Password :</strong>

            {!! Form::text('smtp_password', null, array('placeholder' => 'Smtp Password','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}

        </div>

    </div>
    
     <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Smtp Port:</strong>

            {!! Form::text('smtp_port', null, array('placeholder' => 'Smtp Port','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}

        </div>

    </div>
    	    	
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Smtp Security:</strong>

            
            <select name="smtp_security" class="form-control" required>
                <option value="">Select</option>
                <option value="SSL">SSL</option>
                <option value="TLS" selected="">TLS</option>
            </select>

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>From Name:</strong>

            {!! Form::text('from_name', null, array('placeholder' => 'From Name','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}

        </div>

    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>From Email:</strong>

            {!! Form::email('from_email', null, array('placeholder' => 'From Email','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}

        </div>

    </div>
    

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Update Settings</button>

    </div>

</div>

{!! Form::close() !!}



@endsection