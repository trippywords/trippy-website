@extends('admin.layouts.app')	
@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card  card-accent-theme">
                <div class="message-widget">
                    <h1> All User Comments
                        <i class="fa fa-comments-o float-right"></i>
                    </h1>
                    <ul id="messageList">

                        @if($comments)
                            @foreach($comments as $comment)
                                <li class="clearfix">
                                    <a href="{{ url('blog/'.$comment->blog_slug.'') }}" title="{{ $comment->blog_title }}" class="dropdown-item" target="_blank">
                                        <div class="message-box ">
                                            <div class="u-img float-left">
                                                <?php if (isset($comment->blog_image) && $comment->blog_image != null && file_exists(public_path() . '/blog_img/' . $comment->blog_image)) { ?>
                                                    <img src="{{ asset('/public/blog_img/'.$comment->blog_image) }}">
                                                <?php } else { ?>
                                                    <img src="{{ asset('/') }}public/blog_img/no_img.jpg" >
                                                <?php } ?>
                                                <span class="notification online"></span>

                                            </div>
                                            <div class="u-text float-left">
                                                <div class="u-name">
                                                    <strong>Posted by {{$comment->first_name}} {{$comment->last_name}}</strong>
                                                </div>
                                                <p class="text-muted">{{ $comment->comments }}</p>
                                            </div>
                                        </div>
                                        <small class="float-right">{{getDays($comment->created_at)}}</small>
                                    </a>
                                </li>
                            @endforeach
                        @endif    
                    </ul>
                </div>
                <!-- end card-body -->
               <!--  @if(isset($comments_count) && $comments_count > 10)
                    <div class="card-footer text-center">
                        <a href="javascript:void(0);" class="text-theme">
                            <strong>Show More</strong>
                        </a>
                    </div>
                @endif    -->
                <!-- end card-footer -->
            </div>
            <!-- end card -->
        </div>

    </div>

    <!-- end row -->

</div>
@endsection


@section('footer_script')

<!-- dashboard-pm -example -->

<script src="{{ url('/public/admin-assets/js/dashboard-pm-example.js') }}"></script>



@endsection