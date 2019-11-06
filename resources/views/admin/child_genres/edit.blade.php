@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Child Genre</h2>
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


    {!! Form::model($ChildGenre, ['method' => 'POST','files'=> true,'route' => ['admin-child-genre.update',$ChildGenre->id]]) !!}

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
                     {!! Form::textarea('child_genre_detail', old('child_genre_detail'), array('placeholder' => 'Detail','class' => 'form-control','required'=>'required')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Parent Genre:</strong>
                    <select class="form-control" name="selParent">
                        <option value="0">Select Genre</option>
                        <?php foreach($ParentGenres as $g): ?>
                            <?php if($g->id == $ChildGenre->parent_genre_id): ?>
                                <option value="<?php echo $g->id; ?>" selected="selected"><?php echo $g->parent_name; ?></option>
                            <?php else: ?>
                                <option value="<?php echo $g->id; ?>"><?php echo $g->parent_name; ?></option>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Is Published:</strong>
                    <select class="form-control" required="required" name="selPublished">
                        <option value="">Select Status</option>
                        <?php if($ChildGenre->is_published == '1'){ ?>
                            <option value="1" selected="selected">Published</option>
                            <option value="0">Unpublished</option>
                        <?php }else{ ?>
                            <option value="1">Published</option>
                            <option value="0" selected="selected">Unpublished</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="genImage">
                    <?php if($ChildGenre->child_genre_image != ""): ?>
                        <img src="<?php echo URL::to('/'); ?>/public/genre_img/<?php echo $ChildGenre->child_genre_image ?>" style="height: 100px;width: 100px;"/>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    
@endsection