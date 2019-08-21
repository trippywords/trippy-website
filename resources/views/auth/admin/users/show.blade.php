@extends('admin.layouts.app')







@section('content')



<div class="row">



    <div class="col-lg-12 margin-tb">



        <div class="pull-left">



            <h2> Show User</h2>



        </div>



        <div class="pull-right">



            <a class="btn btn-primary" href="{{ route('admin.users') }}"> Back</a>



        </div>



    </div>



</div>







<div class="row">



    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Name:</strong>



            {{ $user->name }}



        </div>



    </div>



    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Email:</strong>



            {{ $user->email }}



        </div>



    </div>

     <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Profile Picture:</strong>

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



            {{ $user->description }}



        </div>



    </div>

    

<!--    <div class="col-xs-12 col-sm-12 col-md-12">



        <div class="form-group">



            <strong>Roles:</strong>

            

            @if(!empty($user->getRoleNames()))



                @foreach($user->getRoleNames() as $v)



                    <label class="badge badge-success">{{ $v }}</label>



                @endforeach



            @endif



        </div>



    </div>-->



</div>



@endsection