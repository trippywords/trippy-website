@extends('admin.layouts.app')
@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Create New User</h2>

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

@if(Session::has('error_message'))
    <div class="alert alert-danger">
        {{ Session::get('error_message') }}
    </div>
@endif



{!! Form::open(array('id'=>'user','route' => 'admin.users.store','method'=>'POST','files'=> true)) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>First Name:</strong>

            {!! Form::text('first_name', old('first_name'), array('placeholder' => 'First Name','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Last Name:</strong>

            {!! Form::text('last_name', old('last_name'), array('placeholder' => 'Last Name','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Username:</strong>

            {!! Form::text('name', old('name'), array('placeholder' => 'Username','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Email:</strong>

            {!! Form::email('email', old('email'), array('placeholder' => 'Email','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Password:</strong>

            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Confirm Password:</strong>

            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Profile Picture:</strong>

            {!! Form::file('profile_image', array('placeholder' => 'profile image','class' => 'form-control')) !!}

        </div>

    </div>
     <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Description:</strong>

            {!! Form::textarea('description', old('description'), array('placeholder' => 'Description','class' => 'form-control')) !!}

        </div>

    </div>

<!--    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Role:</strong>

            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}

        </div>

    </div>-->
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>User Verify:</strong>

            <input type="checkbox" name="is_verified" id="is_verified" />

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}
@endsection

<script src="{{ asset('public/assets/bootstrap/js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    
    <script>
         $(document).keyup(function(){

            $.validator.addMethod("firstAlfa", function(value, element) {
            return this.optional(element) || /^[A-Za-z_ ][A-Za-z0-9_ ]*$/.test(value);
            }, "First letter shuld be characters");

            $.validator.addMethod("specialChar", function(value, element) {
            return this.optional(element) || /^[ A-Za-z0-9_@./#&+-]*$/.test(value);
            }, "First letter shuld be characters");

           /*$.validator.addMethod("notEqualTo", function(value, element) {
                   return $('#name').val() != $('#first_name').val()
            }, "* First name and Username should not match");
*/
            $("#user").validate({

                rules: {      
                "first_name": {
                     required : true,
                     minlength :2,
                     firstAlfa : true,
                },
                "last_name": {
                     required : true,
                     minlength :2,
                     firstAlfa : true,
                },
                "name":{
                    required:true,
                    minlength:5,
                    specialChar:true,
                },
                "password":{
                    required:true,
                    minlength:6,
                    specialChar:true,
                },
                "confirm-password":{
                    required:true,
                    minlength:6,
                    specialChar:true,
                }
            },

                 messages: {    
                "first_name" :{
                    required: "Input required",
                    minlength: "Please, at least {0} characters are necessary",
                    firstAlfa:"First letter should be character and Special characters not allowed "
                },

                "first_name" :{
                    required: "Input required",
                    minlength: "Please, at least {0} characters are necessary",
                    firstAlfa:"First letter should be character and Special characters not allowed "
                },
                "name":{
                    required:"Input required",
                    minlength:"Please, at least {0} characters are necessary",
                    specialChar:"First letter should be character and can accept special character",
                    notEqualTo:"First name and Username should not match"
                    
                }
            }
            });
        });
        
    </script>