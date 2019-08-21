@extends('layouts.app')
@section('title',"Request")
@section('content')

<!-- main.css | /* block-this-author Page Section S */ -->
<section <?php if(count($requserdata)<=0){ echo 'style="margin-bottom:32%"'; } ?> <?php if(count($requserdata)<=6){ echo 'style="margin-bottom:20%"'; } ?>>
    
    <div class="profile_page block_page">
        <div class="container">
            <?php if(count($requserdata)<=0){ ?>
            <div style="color:red;text-align: center;"> No any request found  </div>
            <?php }?>
            @foreach($requserdata as $req_udata)
            <div class="row">                
                <div class="col-lg-4 col-md-5">
                    <div class="profile_page_side_section">
                        <div class="user_profile block_user_profile margin-bottom-30">
                            <div class="user_image_section">
                                
                                <div class="profile_section media align-items-center">
                               
                                    <?php 
                                    $userdata=getUserdetailbyid($req_udata->user_id); 
                                    echo $userdata->name;
                                    ?> Sent you Request
                                </div>                              
                            </div>
                            
                            <div class="user_profile_button">                               
                                <a href="{{ url("acceptrequest/".$userdata->id) }}" title="Accept" class="button connect">
                                Accept
                                </a>
                                <a href="{{ url("rejectrequest/".$userdata->id) }}" title="Reject" class="button connect">
                                Reject
                                </a>                                 
                            </div>
                               
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script>
    
</script>
@endsection        