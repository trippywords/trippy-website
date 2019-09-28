@extends('admin.layouts.app')
@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Create New Blog</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('admin.blog') }}"> Back</a>

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




{!! Form::open(array('route' => 'admin.blog.store','method'=>'POST','files'=> true)) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Title:</strong>

            {!! Form::text('blog_title', null, array('placeholder' => 'Blog Title','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div>
   <!--  <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Heading:</strong>

            {!! Form::text('blog_heading', null, array('placeholder' => 'Blog Heading','class' => 'form-control','required'=>'required')) !!}

        </div>

    </div> -->
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Select Genres:</strong>

            <select name='blog_genre' id='blog_genre' class='form-control'>
                <option>Select Genres</option>
                @foreach($genres as $genre)
                <option value="{{$genre->id}}">{{$genre->parent_name}}</option>
                @endforeach
           </select>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Select Child Genres:</strong>

            <select name='blog_child_genre' id='blog_child_genre' class='form-control'>
                <option>Select Genres</option>
                
           </select> 
        </div>

    </div>


    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Picture:</strong>

            {!! Form::file('blog_image', array('placeholder' => 'blog image','class' => 'form-control')) !!}

        </div>

    </div>
    
    
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Description:</strong>            
            {!! Form::textarea('blog_description', null, array('placeholder' => 'Blog Description','class' => 'form-control','required'=>'required','rows'=>'2')) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Meta Description:</strong>            
            {!! Form::textarea('blog_meta_description', null, array('placeholder' => 'Blog Meta Description','class' => 'form-control','required'=>'required','rows'=>'2')) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Blog Keywords:</strong>

            {!! Form::text('blog_keywords', null, array('placeholder' => 'Blog Keywords','class' => 'form-control','required'=>'required','id'=>'blog_keywords')) !!}

        </div>
        <span id="error_keyword" style="color:red;display: none">maximum limit keyword 100</span>

    </div>
     <div class="col-xs-12 col-sm-12 col-md-12">

         <div class="form-group">
             <strong>Blog Status:</strong>
             <select name="blog_status">
                 <option value="1">Published</option>
                 <option value="2">Draft</option>
             </select>
         </div>
     </div>

      <div class="col-xs-12 col-sm-12 col-md-12">

         <div class="form-group">
             <strong>Featured:</strong>
             <input type="checkbox" name="is_featured" id="is_featured" value="1">
         </div>
     </div>

     <div class="col-xs-12 col-sm-12 col-md-12">

         <div class="form-group">
             <strong>Tranding:</strong>
             <input type="checkbox" name="is_tranding" id="is_tranding" value="1">
         </div>
     </div>
     
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}
@endsection

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<script>  

 $(document).ready(function(){
      
            $('select[name="blog_genre"]').on('change',function(){
                var id=$(this).val();
                
                if(id)
                {
                    //console.log(id);
                    $.ajax({
                        //url: ADMIN_URL+'/adminpanel/blog/ajax'+id,
                        type:'GET',
                        dataType:'json',

                        url:"{{url('/adminpanel/blog/ajax')}}?id="+id,
                         
                        success:function(data)
                        {
                            console.log(data);
                            $('select[name="blog_child_genre"]').empty();
                            $.each(data,function(key,value){
                            $('select[name="blog_child_genre"]').append('<option value="'+key+'">'+value+'</option>');
                            
                               });                   
                        },
                        error: function (e) {
                    
                    console.log("ERROR: ", e);
                }

                    });
                }
                else{
                    $('select[name="blog_child_genre"]').empty();
                }
            });
        });  
    </script>
    <script >
    $("#error_keyword").hide();
    $("#blog_keywords").blur(function(){
            var a = $("#blog_keywords").val();
            var x = new Array();
            x = a.split(",");
            if(x.length>100){
                //alert("keyword max limit only 100 words");
                //console.log(x.length);
                $("#error_keyword").show();
                $("#blog_keywords").val('');
                return false;
            }else{
                $("#error_keyword").hide();
            }
            
    });
 </script>
 