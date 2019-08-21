@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Genre</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin-genre.index') }}"> Back</a>
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


    <form action="{{ route('admin-genre.update',$genre->id) }}" method="POST" enctype="multipart/form-data">
    	@csrf
        @method('PUT')


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" value="{{ $genre->name }}" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $genre->detail }}</textarea>
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Parent Genre:</strong>
                    <select class="form-control" name="selParent">
                        <option value="0">Select Genre</option>
                        <?php foreach($genres as $g): ?>
                            <?php if($g->id == $genre->parent_genre_id): ?>
                                <option value="<?php echo $g->id; ?>" selected="selected"><?php echo $g->name; ?></option>
                            <?php else: ?>
                                <option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
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
                        <?php if($genre->is_published == 'Y'){ ?>
                            <option value="Y" selected="selected">Published</option>
                            <option value="N">Unpublished</option>
                        <?php }else{ ?>
                            <option value="Y">Published</option>
                            <option value="N" selected="selected">Unpublished</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="genImage">
                    <?php if($genre->genre_image != ""): ?>
                        <img src="<?php echo URL::to('/'); ?>/public/genre_img/<?php echo $genre->genre_image ?>" style="height: 100px;width: 100px;"/>
                    <?php endif; ?>
                </div>
            </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


@endsection