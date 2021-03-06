@extends('admin.layouts.app')







@section('content')



<div class="row">



    <div class="col-lg-12 margin-tb">



        <div class="pull-left">



            <h2>Edit New User</h2>



        </div>



        <div class="pull-right">



            <a class="btn btn-primary" href="{{ route('admin.users') }}"> Back</a>



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







{!! Form::model($user, ['method' => 'POST','files'=> true,'route' => ['admin.users.update', $user->id]]) !!}



<div class="row">



    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Name:</strong>



            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','required'=>'required')) !!}



        </div>



    </div>



    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Email:</strong>



            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','required'=>'required')) !!}



        </div>



    </div>



    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Password:</strong>



            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}



        </div>



    </div>



    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Confirm Password:</strong>



            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}



        </div>



    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Profile Picture:</strong>



            {!! Form::file('profile_image', array('placeholder' => 'profile image','class' => 'form-control')) !!}

            <?php 
            if(isset($user->profile_image) && $user->profile_image != null && file_exists(public_path() . '/user_img/' . $user->profile_image))
            { ?>
                <img src='{{ asset('public/user_img/'.$user->profile_image) }}' width="100px" height="100px" />
            <?php 
            }else{ ?>
                <img src="{{ asset('/') }}public/assets/image/profile.png" width="100px" height="100px" >
            <?php  } ?>
        </div>



    </div>

     <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Description:</strong>



            {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control')) !!}



        </div>



    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>User Verify:</strong>



            <input type="checkbox" name="is_verified" id="is_verified" <?php if($user->is_verified==1){ echo " checked"; }  ?> />



        </div>



    </div>



    <div class="col-xs-12 col-sm-12 col-md-12 text-center">



        <button type="submit" class="btn btn-primary">Submit</button>



    </div>



</div>



{!! Form::close() !!}







@endsection