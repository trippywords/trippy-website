@extends('admin.layouts.app')



@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Update Settings</h2>

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



{!! Form::model($settings, ['method' => 'POST','files'=> true,'route' => ['admin.settings.update', $settings->id]]) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Site Tagline:</strong>

            {!! Form::text('site_tagline', null, array('placeholder' => 'Site Tag line','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}

        </div>

    </div>
    
   <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Site Logo :</strong>

            {!! Form::file('site_logo', array('placeholder' => 'Site Logo','class' => 'form-control')) !!}
            <?php 
            if(!$settings->site_logo==NULL)
            {
            ?>
            <img src='{{ asset('/public/settings_img/'.$settings->site_logo) }}' width="250px" />
            <?php 
            }else{
                echo " no image avalible";
            } ?>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Site Favicon :</strong>

            {!! Form::file('site_fevicon', array('placeholder' => 'Site Favicon','class' => 'form-control')) !!}
            <?php 
            if(!$settings->site_fevicon==NULL)
            {
            ?>
            <img src='{{ asset('/public/settings_img/'.$settings->site_fevicon) }}' width="250px"  />
            <?php 
            }else{
                echo " no image avalible";
            } ?>
        </div>

    </div>
   
      	
   
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Site Phone Number:</strong>

            {!! Form::text('site_phonenumber', null, array('placeholder' => 'Site Phone number','class' => 'form-control','required'=>'required','maxlength'=>25)) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Site Email:</strong>

            {!! Form::email('site_email', null, array('placeholder' => 'Site Email','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}

        </div>

    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Facebook:</strong>
                {!! Form::text('site_facebook', null, array('placeholder' => 'Facebook','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Twitter:</strong>
                {!! Form::text('site_twitter', null, array('placeholder' => 'Twitter','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Linkedin:</strong>
                {!! Form::text('site_linkedin', null, array('placeholder' => 'Linkedin','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Instagram:</strong>
                {!! Form::text('site_instagram', null, array('placeholder' => 'Instagram','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Google+:</strong>
                {!! Form::text('site_google', null, array('placeholder' => 'Google+','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Site Copyright :</strong>

            {!! Form::text('site_copyright', null, array('placeholder' => 'Site Copy Right','class' => 'form-control','required'=>'required','maxlength'=>255)) !!}

        </div>

    </div>	
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Summary Length :</strong>

            {!! Form::text('summerylength', null, array('placeholder' => 'Summery Length','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>
    
   

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Update Settings</button>

    </div>

</div>

{!! Form::close() !!}



@endsection