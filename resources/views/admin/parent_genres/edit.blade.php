@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Parent Genre</h2>
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


    {!! Form::model($ParentGenre, ['method' => 'POST','files'=> true,'route' => ['admin-parent-genre.update',$ParentGenre->id]]) !!}

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
                     {!! Form::textarea('parent_detail', old('parent_detail'), array('placeholder' => 'Detail','class' => 'form-control','required'=>'required')) !!}
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Is Published:</strong>
                    <select class="form-control" required="required" name="selPublished">
                        <option value="">Select Status</option>
                        <?php if($ParentGenre->is_published == '1'){ ?>
                            <option value="1" selected="selected">Published</option>
                            <option value="0">Unpublished</option>
                        <?php }else{ ?>
                            <option value="1">Published</option>
                            <option value="0" selected="selected">Unpublished</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    
@endsection