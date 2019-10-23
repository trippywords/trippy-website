@extends('layouts.app')
<style>
    .checked-custom {
        color:#58bb47;
        font-weight: 700;
    }
    .unchecked-custom {
        color:black;
        font-weight: 700;
    }
    input[type="checkbox"] {
        opacity: 0;
    }       
</style>
@section('title',isset($tab)?ucwords(str_replace("-"," ",$tab)):"Profile")

@section('content')
<section>
    <div class="profile_page user_menu_page">                                        
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="tab">
                        <a href="{{ url('account-details') }}" >
                            <div class="tablinks"  id="defaultOpen_usermenu">
                                <span class="icon icon-briefcase"></span>
                                <span class="link_text">Account Details</span>
                            </div>
                        </a>
                        <a href="{{ route('preference-list') }}" >
                            <div  class="tablinks " id="defaultOpen_preference">
                                <span class="icon icon-table-grid"></span>
                                <span class="link_text">Preferences</span>
                            </div>
                        </a>  
                        <a href="{{ route('connections') }}" >  
                            <div  class="tablinks " id="defaultOpen_connection">
                                <span class="icon icon-link"></span>
                                <span class="link_text">Connections</span>    
                            </div>
                        </a>
                        <a href="{{ route('following') }}" >
                            <div  class="tablinks " id="defaultOpen_following">
                                <span class="icon icon-wifi"></span>
                                <span class="link_text">Following</span>    
                            </div>
                        </a>
                        <a href="{{ url('followers') }}" >
                            <div class="tablinks " id="defaultOpen_followers">
                                <span class="icon icon-wifi"></span>
                                <span class="link_text">Followers</span>   
                            </div>
                        </a> 
                        <a href="{{ route('bookmarks') }}" >
                            <div  class="tablinks " id="defaultOpen_bookmarks">
                                <span class="icon icon-save-bookmark"></span>
                                <span class="link_text">Bookmarks</span> 
                            </div>
                        </a>   
                        <a href="{{ route('notification-list') }}" >
                            <div  class="tablinks " id="defaultOpen_notificationlist">
                                <span class="icon fa fa-bell"></span>
                                <span class="link_text">Notification List</span>
                            </div>
                        </a>
                        <a href="{{ route('social') }}" >
                            <div class="tablinks " id="defaultOpen_social">
                                <span class="icon fa fa-twitter"></span>
                                <span class="link_text">Social</span>
                            </div>
                        </a>
                        <a href="{{ route('request') }}" >
                            <div  class="tablinks " id="defaultOpen_request">
                                <span class="icon fa fa-user-plus"></span>
                                <span class="link_text">Request</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div id="Account" class="tabcontent profile_page_main_section margin-bottom-30"  <?php if ($tab != 'account-details') { ?> style="display: none;" <?php } ?>>
                        <div class="rows text-center" >
                            <div id="updateusernm">User Name updated Successfully</div>
                            <div id="existuser">This Username is Already associated with another user</div>
                            <span id="updatefastnm">User First Name Updated Successfully</span>
                            <span id="updatelastnm">User Last Name Updated Successfully</span>
                            <span id="updateemail_toats">This Email is Already associated with another user</span>
                            <span id="updatepassword">Your password updated Successfully</span>
                            <span id="passwordMismatch">Confirm Password Mismatch</span>
                            <span id="updateEmail">Your Email updated Successfully</span>
                            <span id="updateEmailVerify">Your Email updated Successfully, Please verify your email</span>
                            <!-- <span id="secondaryEmailError">Primary email and secondary email must be different.</span> -->
                            <div id="erroldpasss" class="errorpass" >Invalid Current Password</div>
                             <span id="samefirstname">Please enter new first name</span>
                            <span id="samelastname">Please enter new last name</span>
                            <span id="sameusername">Please enter new username</span>
                            <span id="sameuseremail">Please enter new email</span>
                            <span id="sameuserpassword">Please enter new password</span>
                        </div>
                        @if ($message = Session::get('verify_primary_email'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            @if ($message = Session::get('token_expired'))
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif    
                        <div class="profile_main_title_section">
                            
                            <h2 class="title">
                                <i class="fa fa-file-text"></i>
                                Account Details
                            </h2>
                        </div>
                        <div class="profile_main_section profile-bg">
                            <div class="account-details-main">
                                <div class="account-details-list">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-3">
                                            <label class="account-details-label">Username</label>
                                        </div>
                                        <div class="col-md-8 col-sm-9">
                                            <div class="account-details">
                                                <div class="user_info"><?php echo Auth::user()->name ?></div>
                                                <div class="edit">
                                                    <a href="javascript:;" id='edit_username'><i class="fa fa-edit"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form name="frmUpdateName" id="frmUpdateName" class="account-form" method="POST">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="Username" value="<?php echo Auth::user()->name ?>" required="" pattern="[A-Za-z0-9]*">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary account-form-button" id="btnusername" type="submit">
                                                    <i class="fa fa-save"></i>
                                                </button>
                                            </div>
                                            <!-- <div class="error-show"><label id="txtUsername1"></label></div> -->
                                        </div>
                                    </form>
                                </div>
                                <div class="account-details-list">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-3">
                                            <label class="account-details-label">First Name</label>
                                        </div>
                                        <div class="col-md-8 col-sm-9">
                                            <div class="account-details">
                                                <div class="user_info"><?php echo ucfirst(Auth::user()->first_name) ?></div>
                                                <div class="edit">
                                                    <a href="javascript:;" id='edit_fusername'><i class="fa fa-edit"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form name="frmUpdatefName" id="frmUpdatefName"  class="account-form" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtfUsername" id="txtfUsername" placeholder="First Name" value="<?php echo ucfirst(Auth::user()->first_name) ?>" required="" pattern="[A-Za-z]*">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary account-form-button" id="updatefirstnm" type="submit">
                                                    <i class="fa fa-save"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="account-details-list">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-3">
                                            <label class="account-details-label">Last Name</label>
                                        </div>
                                        <div class="col-md-8 col-sm-9">
                                            <div class="account-details">
                                                <div class="user_info"><?php echo ucfirst(Auth::user()->last_name) ?></div>
                                                <div class="edit">
                                                    <a href="javascript:;" id='edit_lusername'><i class="fa fa-edit"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form name="frmUpdatelName" id="frmUpdatelName" class="account-form" method="POST" >
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtlUsername" id="txtlUsername" placeholder="Last Name" value="<?php echo ucfirst(Auth::user()->last_name) ?>" required="" pattern="[A-Za-z]*">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary account-form-button" id="updatelast" type="submit">
                                                    <i class="fa fa-save"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="account-details-list">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-3">
                                            <label class="account-details-label">Email</label>
                                        </div>
                                        <div class="col-md-8 col-sm-9">
                                            <div class="account-details">
                                                <div class="user_info"><?php echo Auth::user()->email ?></div>
                                                <div class="edit">
                                                    <a href="javascript:;" id='edit_email'><i class="fa fa-edit"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form name="frmUpdateEmail" id="frmUpdateEmail" class="account-form" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="email" class="form-control account-form-input" name="primary_email" id="primary_email" placeholder="Email" value="<?php echo Auth::user()->email ?>" readonly="readonly" style="width: 270px;">
                                        </div>
                                        <div class="input-group">
                                            <input type="email" class="form-control account-form-input" name="txtEmail" id="txtEmail" placeholder="Email" value="<?php echo Auth::user()->primary_email ?>" required="" style="width: 270px;">
                                        </div>
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary account-form-button updemail-button" id="updatemail" type="submit">
                                                <i class="fa fa-save"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="account-details-list">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-3">
                                            <label class="account-details-label">Password</label>
                                        </div>
                                        <div class="col-md-8 col-sm-9">
                                            <div class="account-details">
                                                <div class="user_info">XXXXXXXXX</div>
                                                <div class="edit" id=''>
                                                    <a href="javascript:;" id='edit_password'><i class="fa fa-edit"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form name="frmUpdatePassword" id="frmUpdatePassword"  class="account-form" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="password" class="form-control account-form-input"  name="txtoPassword" id="txtoPassword" placeholder="Old Password">
                                        </div>
                                        <!-- <div id="succoldpass" style="color:green">Old password Matched</div> -->
                                        <div class="input-group">
                                            <input type="password" class="form-control account-form-input" name="txtnPassword" id="txtnPassword" placeholder="New Password">
                                        </div>
                                        <div class="input-group">
                                            <input type="password" class="form-control account-form-input"  name="txtcPassword" id="txtcPassword" placeholder=" Confirm Password">
                                        </div>
                                        <div id="errncpass" style="display: none;color:red">Password not match </div>
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary account-form-button" id="btnchangepass" type="submit">
                                                <i class="fa fa-save"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!--<div class="account-details-list">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="account-details-label">Export Blogs</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="account-details">
                                            <div class="user_info"><a href="javascript::void(0);">Download as .Zip Format</a></div>
                                        </div>
                                    </div>
                                </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div id="Preference" class="tabcontent prefrence-main"  <?php if ($tab != 'preference-list') { ?> style="display: none;" <?php } ?>>
                        <div class="prefrence-main-header display-flex-custom">
                            <div class="tabcontent-title">Category Name</div>
                            <!--<div class="subtitle">Select category name using toggle menu</div>-->
                            <!-- <div class="subtitle text-right" id="msguncheck" style="display: none;color:green;font-weight: bold">
                                <button onclick="myFunction()">
                                    <div id="">Category Deselected</div>
                                </button>
                            </div> -->
                            <span id="msguncheck">Category Deselected</span>
                            <!-- <div class="subtitle text-right" id="msgchecked" style="display: none;color:green;font-weight: bold">
                                    <button onclick="myFunction()">
                                    <div id="">Category Selected</div>
                                </button>
                            </div> -->
                            <span id="msgchecked">Category Selected</span>
                            <!-- <div class="subtitle text-right" id="msguncheck_one" style="display: none;color:green;font-weight: bold">Sub Category Unselected</div> -->
                            <span id="msguncheck_one">Sub Category Deselected</span>
                            <!-- <div class="subtitle text-right" id="msgchecked_one" style="display: none;color:green;font-weight: bold">Sub Category Selected</div> -->
                            <span id="msgchecked_one">Sub Category Selected</span>
                        </div>
                        <div class="prefrence-toggle-mainseciton">
                            <?php $preferences = getParrentgenres(); 
                            if (count($preferences) > 0) { ?>
                                @foreach($preferences as $pg)
                                    @php 
                                    $selected="";
                                    $checked="";
                                    @endphp
                                    @if(isSelectedPgenres($pg->id)>=1)
                                        @php 
                                            $selected=" style=color:black"; 
                                            $checked=" checked";
                                        @endphp
                                    @else
                                        @php 
                                            $selected="";
                                            $checked="";
                                        @endphp
                                    @endif
                                <div class="prefrence-toggle-main display-flex-custom">
                                    <div class="tabcontent-title" {{ $selected }}><a class="plusclick" style="color:#58bb47;font-weight: bolder;font-size:15px " data-toggle="collapse" href="#collapse{{ $pg->id }}"> + </a>  {{ $pg->parent_name }}</div>
                                    <div class="switch-main">
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-input pgclass" data-val="{{ $pg->parent_name}}" id="pg_{{ $pg->id }}" name="parrentgen[{{ $pg->id }}]"  value="{{ $pg->id }}"  {{ $checked }} />
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="prefrence-toggle-section panel-collapse collapse" id="collapse{{ $pg->id }}">
                                    @foreach(getChildgenres($pg->id) as $childgenres)
                                        @if(isSelectedCgenres($childgenres->id)>=1)
                                            @php 
                                            $checked=" checked-custom";
                                            @endphp
                                        @else
                                            @php 
                                            $checked=" unchecked-custom";
                                            @endphp
                                        @endif
                                    <div class="display-flex-custom">   
                                        <div class="prefrence-toggle-title">{{ $childgenres->child_genre_name }}</div>
                                        <div class="icon icon-check {{ $checked }} childgenres" data-val="{{ $childgenres->child_genre_name }}" data-pid="{{ $pg->id }}" data-id="{{ $childgenres->id }}" id="child_{{ $childgenres->id }}" ></div>
                                    </div>
                                    @endforeach        
                                </div>
                                @endforeach
                            <?php } else { ?>
                                <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                    <p class="content_text">Awww ! no preferences.</p>
                                </div>
                            <?php } ?>
                        </div>  
                    </div>
                    <div id="Connections" class="tabcontent connection-main"  <?php if ($tab != 'connections') { ?> style="display: none;" <?php } ?>>
                        <div class="connection-main-header">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="connections tabcontent-title">
                                        @if(count($user_connection)!=0)
                                            Connections
                                        @endif
                                    </div>
                                </div>
                                <div id="connection_remove">Removed Connection</div>
                                <div class="col-sm-6 text-center">
                                    <div class="sort-main dropdown">    
                                        <span class="sort-title">Sort by:</span>
                                        <a href="javascript:;" title="" class="sort-info tabcontent-title dropdown-toggle" data-toggle="dropdown">
                                            <span>Recently added</span>
                                            <span class="fa fa-chevron-down"></span>
                                        </a>
                                        <div class="dropdown-menu position">
                                            <a href="javascript:;" id="btnconnatoz" class="dropdown-item">Ascending</a>
                                            <a href="javascript:;" id="btnmaxblog" class="dropdown-item">Descending</a>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group search-main">
                                        <span class="input-group-addon"><i class="icon icon-search tabcontent-title searchconnection"></i></span>
                                        <input type="text" class="form-control" name="search_connection" id="search_connection" placeholder="Search by name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="connection-main-section connlist">
                            <?php if (count($user_connection ) > 0) { ?>
                                <div id="connections_more">
                               <?php foreach ($user_connection as $uc) {
                                $userdetail = getUserdetailbyid($uc->connect_user_id); ?>
                                @if($userdetail!=null)
                            <div class="connection-section display-flex-custom blockhide{{$uc->connect_user_id}}">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="profile_pic">
                                            <?php if(isset($userdetail->profile_image) && $userdetail->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetail->profile_image)){ ?>
                                            <img src='{{ asset("/public/user_img/".$userdetail->profile_image) }}' alt="Profile">
                                            <?php }else{?>
                                            <img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <a href="{{ url('profile/'.$userdetail->name) }}"><div class="tabcontent-title connection-profile">  {{ ucfirst($userdetail->first_name)." ".ucfirst($userdetail->last_name) }}</div></a>
                                        <div class="connection-profile desc">Writer</div>
                                        <div class="connection-profile">Connected <?php echo getDays($uc->connection_date) ?></div>
                                    </div>
                                </div>
                                <div class="message-main text-right">
                                    <!-- <a href="javascript:;" title="" class="message">Message</a>
                                    <a href="javascript:;" title="" class="remove">Remove</a> -->
                                    <button type="button" class="btn btn-success message open-message" data-toggle="modal" data-target="#myModal" data-val="{{$uc->connect_user_id}}" <?php if (isset($uc->is_block) && $uc->is_block==1) { ?> disabled="disabled" <?php } ?>>Message</button>
                                    <button type="button" class="btn btn-danger message-danger" onclick="removeConnection(<?php echo $uc->connect_user_id; ?>)">Remove</button>
                                </div>
                            </div>
                            @endif
                            <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                    <p class="content_text">Awww ! no connection.</p>
                                </div>
                                <?php } ?>
                        </div>
                        <div class="ajaxconnlist1"></div>
                        <div class="ajaxconnlistaz">
                            <div class="ajax-load text-center" id="ajax-load-connections" style="display:none">
                                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Connections</p>
                            </div>
                            <?php if (isset($user_connection_total) && intval($user_connection_total) > 0) { ?>
                                <div class="blog_button">
                                    <a href="javascript:;" class="btn btn-primary load_more_connections" data-page="4" title="Load More">
                                        LOAD MORE
                                    </a>
                                </div>
                            <?php } ?> 
                        </div>
                        <div class="ajaxconnlistmaxblog">
                            
                        </div>
                        
                    </div>
                    <div id="Following" class="tabcontent connection-main"  <?php if ($tab != 'following') { ?> style="display: none;" <?php } ?>>
                        <div class="connection-main-header">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="connections tabcontent-title">
                                        @if(count($user_follower)!=0)
                                            Following
                                        @endif
                                    </div>
                                </div>
                                <div id="following_remove">Removed Following</div>
                                <div class="col-sm-6 text-center">
                                    <div class="sort-main dropdown">    
                                        <span class="sort-title">Sort by:</span>
                                        <a href="javascript:;" title="" class="sort-info tabcontent-title dropdown-toggle" data-toggle="dropdown">
                                            <span>Recently added</span>
                                            <span class="fa fa-chevron-down"></span>
                                        </a>
                                        <div class="dropdown-menu position">
                                            <a href="javascript:;" id="following_ascending" class="dropdown-item">Ascending</a>
                                            <a href="javascript:;" id="following_descending" class="dropdown-item">Descending</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group search-main">
                                        <span class="input-group-addon"><i class="icon icon-search tabcontent-title searchfollowing"></i></span>
                                        <input type="text" class="form-control" name="search_following" id="search_following" placeholder="Search by name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="connection-main-section folllist">
                            <?php
                            if (count($user_follower ) > 0) { ?>

                            <div id="following_more">
                            <?php foreach ($user_follower as $uf) {
                                $userdetail = getUserdetailbyid($uf->follower_id);
                            ?>
                            @if($userdetail!=null)
                            <div class="connection-section display-flex-custom blockhide{{$uf->follower_id}}">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="profile_pic">
                                            <?php if(isset($userdetail->profile_image) && $userdetail->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetail->profile_image)){ ?>
                                            <img src='{{ asset("/public/user_img/".$userdetail->profile_image) }}' alt="Profile">
                                            <?php }else{?>
                                            <img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <a href="{{ url('profile/'.$userdetail->name) }}"><div class="tabcontent-title connection-profile" id="name{{$uf->follower_id}}" data-name="{{ ucfirst($userdetail->first_name).' '.ucfirst($userdetail->last_name) }}">{{ ucfirst($userdetail->first_name)." ".ucfirst($userdetail->last_name) }}</div></a>
                                        <div class="connection-profile desc">Writer</div>
                                        @if(!empty($uf->followed_at))
                                        <div class="connection-profile">Connected <?php echo getDays($uf->followed_at) ?></div>
                                        @endif
                                    </div> 
                                </div>
                                <div class="message-main text-right">
                                    <!-- <a href="javascript:;" title="" class="message">Following</a>
                                    <a href="javascript:;" title="" class="remove">Remove</a> --><!-- 
                                    <button type="button" class="btn btn-success">Following</button> -->
                                    <button type="button" class="btn btn-danger message-danger-full" onclick="removefollowing(<?php echo $uf->follower_id; ?>)">Remove</button>
                                </div>
                            </div>
                            @endif
                            <?php } ?>
                            </div>
                            <?php } else { ?>
                            <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                    <p class="content_text">Awww ! no following.</p>
                                </div>
                                <?php } ?>    
                        </div>
                        <div class="ajaxfolllist1"></div>
                        <div class="ajaxfollowlistaz"></div>
                        <div class="ajaxfollowlistza">
                            <div class="ajax-load text-center" id="ajax-load-followings" style="display:none">
                                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Followings</p>
                            </div>
                            <?php if (isset($user_follower_total) && intval($user_follower_total) > 0) { ?>
                                <div class="blog_button">
                                    <a href="javascript:;" class="btn btn-primary load_more_followings" data-page="4" title="Load More">
                                        LOAD MORE
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                         
                    </div>
                    <!-- Follower section start -->
                    <div id="Followers" class="tabcontent connection-main" <?php if ($tab != 'followers') { ?> style="display: none;" <?php } ?>>
                        <div class="connection-main-header">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="connections tabcontent-title">
                                        @if(count($user_followers)!= 0)
                                            Followers
                                        @endif
                                    </div>
                                </div>
                                <div id="follower_remove" >Removed Followers</div>
                                <div class="col-sm-6 text-center">
                                    <div class="sort-main dropdown">    
                                        <span class="sort-title">Sort by:</span>
                                        <a href="javascript:;" title="" class="sort-info tabcontent-title dropdown-toggle" data-toggle="dropdown">
                                            <span>Recently added</span>
                                            <span class="fa fa-chevron-down"></span>
                                        </a>
                                        <div class="dropdown-menu position">
                                            <a href="javascript:;" id="follower_ascending" class="dropdown-item">Ascending</a>
                                            <a href="javascript:;" id="follower_descending" class="dropdown-item">Descending</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="input-group search-main">
                                        <span class="input-group-addon"><i class="icon icon-search tabcontent-title searchfollowing"></i></span>
                                        <input type="text" class="form-control" name="search_follower" id="search_follower" placeholder="Search by name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="connection-main-section followerlist">
                            <?php
                            if (count($user_followers ) > 0) { ?>
                            <div id="followers_more">
                            <?php foreach ($user_followers as $uf) {
                                $userdetail = getUserdetailbyid(isset($uf->user_id)?$uf->user_id:0); ?>
                                <?php if($userdetail!=null){ ?>
                                    <div class="connection-section display-flex-custom blockhide{{$uf->user_id}}">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="profile_pic">
                                                    <?php if(isset($userdetail->profile_image) && $userdetail->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetail->profile_image)){ ?>
                                                    <img src='{{ asset("/public/user_img/".$userdetail->profile_image) }}' alt="Profile">
                                                    <?php }else{?>
                                                    <img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ url('profile/'.$userdetail->name) }}"><div class="tabcontent-title connection-profile" id="username{{$uf->user_id}}" data-name="{{ ucfirst($userdetail->first_name).' '.ucfirst($userdetail->last_name) }}">{{ ucfirst($userdetail->first_name)." ".ucfirst($userdetail->last_name) }}</div></a>
                                                <div class="connection-profile desc">Writer</div>
                                                <div class="connection-profile">Connected <?php echo getDays($uf->followed_at) ?></div>
                                            </div> 
                                        </div>
                                        <div class="message-main text-right">
                                            <!-- <a href="javascript:;" title="" class="message">Following</a>
                                            <a href="javascript:;" title="" class="remove">Remove</a> --><!-- 
                                            <button type="button" class="btn btn-success">Following</button> -->
                                            <button type="button" class="btn btn-danger" onclick="removefollower(<?php echo $uf->user_id; ?>)">Remove</button>

                                        </div>
                                    </div>
                            <?php } } ?>
                            </div>
                            <?php } else { ?>
                            <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                    <p class="content_text">Awww ! no followers.</p>
                                </div>
                                <?php } ?>
                        </div>
                        <div class="ajaxfollowerlist1"></div>
                        <div class="ajaxfollowerlistaz"></div>
                        <div class="ajaxfollowerlistza">
                            <div class="ajax-load text-center" id="ajax-load-followers" style="display:none">
                                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Followings</p>
                            </div>
                            <?php if (isset($user_followers_total) && intval($user_followers_total) > 0) { ?>
                                <div class="blog_button">
                                    <a href="javascript:;" data-page="4" class="btn btn-primary load_more_followers" title="Load More">
                                        LOAD MORE
                                    </a>
                                </div>
                            <?php } ?> 
                        </div>
                        
                    </div>
         <!-- Follower section end -->
                    <div id="Bookmarks" class="tabcontent bookmark-main connection-main" <?php if ($tab != 'bookmarks') { ?> style="display: none;" <?php } ?>>
                        <div id="bookmarkmsg" style="text-align: center; color: #28a745; font-size: medium;   margin-top: 10px; margin-bottom: 10px;display: none">Bookmark Removed</div>
                        <div id="bookmark_remove">Removed Bookmark</div>
                        <div class="bookmark-main-header">
                            <div class="blog-number tabcontent-title">
                                 @if(count($bookmarklist)!=0)
                                     Bookmarks
                                @endif
                            </div>
                        </div>
                        <?php
                        if (count($bookmarklist) > 0) { ?>
                        <div id="bookmarks_more">
                            <?php foreach($bookmarklist as $bookmark){
                                $blogd=getBlogDetails($bookmark->blog_id);                            
                            ?>
                            <div class="connection-main-section blockhide{{ $bookmark->blog_id }}">
                                <div class="connection-section display-flex-custom">
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="profile_pic">
                                                <?php if (isset($blogd->blog_image) && $blogd->blog_image != null && file_exists(public_path() . '/blog_img/' . $blogd->blog_image)) { ?>
                                                    <img src="{{ asset("/public/blog_img/".$blogd->blog_image) }}" alt="">
                                                <?php } else { ?>
                                                    <img src="{{ asset('/') }}public/blog_img/no_img.jpg" alt="Blog">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="tabcontent-title connection-profile">
                                                <a href="<?php echo URL::to('/').'/blog/'.$blogd->blog_slug;?>" target="_blank"><?php echo $blogd->blog_title; ?>
                                                </a>
                                            </div>
                                            <div class="connection-profile desc"><?php echo $blogd->blog_title; ?></div>
                                            <div class="connection-profile time">
                                                <!-- start -->
                                                <span class="font-primary">
                                                    <?php $userCre = getUserdetailbyid($blogd->created_by); ?>
                                                    <?php if (!empty($userCre)) { ?>
                                                        <a target="_blank" href="<?php echo URL::to('/') ?>/profile/<?php echo strtolower($userCre->name); ?>">
                                                        <?php echo ucfirst($userCre->first_name)." ".ucfirst($userCre->last_name) ?></a>
                                                    <?php } ?>
                                                </span>
                                                <!-- end -->
                                                <?php echo getDays($bookmark->bookmark_at) ?>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="message-main text-right">
                                        <!-- <a href="javascript:;" title="" class="remove" onclick="removeBookmark(<?php echo $bookmark->blog_id; ?>)">Remove</a> -->
                                        <button type="button" class="btn btn-danger message-danger-full" onclick="removeBookmark(<?php echo $bookmark->blog_id; ?>)">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="ajax-load text-center" id="ajax-load-bookmark" style="display:none">
                            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                        </div>
                        <?php if (isset($bookmarklist_total) && intval($bookmarklist_total) > 4) { ?>
                            <div class="blog_button">
                                <a href="javascript:;" class="btn btn-primary" id="load_more" title="Load More">
                                    LOAD MORE
                                </a>
                            </div>
                        <?php } ?>    
                        <?php } else { ?>
                            <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                    <p class="content_text">Awww ! no bookmark.</p>
                                </div>
                                <?php } ?>
                    </div>
                    <div id="Notifications-list" class="tabcontent prefrence-main notification-main" <?php if ($tab != 'notification-list') { ?> style="display: none;" <?php } ?>>
                        <!-- <div class="subtitle text-right" id="msguncheck_two" style="display: none;color:green;font-weight: bold">User Notification Off</div> -->
                        <span id="msguncheck_two">User Notification Off</span>
                        <!-- <div class="subtitle text-right" id="msgchecked_two" style="display: none;color:green;font-weight: bold">User Notification on</div> -->
                        <span id="msgchecked_two">User Notification On</span>
                        <?php if (count($notifications) > 0) { ?>
                            <div id="notifications_more">
                                @foreach($notifications as $notification)
                                    @php
                                    $usernotichecked="";
                                    @endphp    
                                    @if(getNotification_status($notification->id)==1)  
                                    @php
                                    $usernotichecked=" checked='checked'";
                                    @endphp
                                    @else
                                    @php
                                    $usernotichecked="";
                                    @endphp
                                    @endif
                                    <div class="prefrence-toggle-main display-flex-custom">
                                        <div class="tabcontent-title">{{ $notification->notification_title }}</div>
                                        <div class="switch-main">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-input chkunotification" id="chknotid_{{ $notification->id }}" value="{{ $notification->id }}" data-id='{{ $notification->id }}' name="checked_user_notification[]" {{ $usernotichecked }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>  
                                @endforeach 
                            <?php } else { ?>
                                <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                    <p class="content_text">Awww ! no notifications.</p>
                                </div>
                            <?php } ?>
                        </div>
                          
                    </div>
                    <div id="ajaxnotificationslistza">
                                    <div class="ajax-load text-center" id="ajax-load-notifications" style="display:none">
                                        <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                                    </div>
                                    <?php if (isset($notifications_total) && intval($notifications_total) > 0) { ?>
                                        <div class="blog_button">
                                            <a href="javascript:;" class="btn btn-primary" id="load_more_notifications" title="Load More" data-page="10">
                                                LOAD MORE
                                            </a>
                                        </div>
                                    <?php } ?> 
                                </div> 
                    <div id="Social" class="tabcontent social-main" <?php if ($tab != 'social') { ?> style="display: none;" <?php } ?>>
                        <div id="disconnect_fb">User Disconnected to Facebook Successfully</div>
                        <div id="disconnect_tw">User Disconnected to Twitter Successfully</div>
                        <div id="userNotFind">User Not Found</div>
                        <!-- <div class="subtitle text-center" id="msguncheck_three" style="display: none;color:green;font-weight: bold;margin-bottom: 10px;">Social icon hidden in profile</div> -->
                        <span id="msguncheck_three">Social icon hidden in profile</span>
                        <!-- <div class="subtitle text-center" id="msgchecked_three" style="display: none;color:green;font-weight: bold;margin-bottom: 10px;">Social icon visible in profile</div> -->
                        <span id="msgchecked_three">Social icon visible in profile</span>
                        <div class="display-flex-custom">
                            <div class="connected-content">
                                <script>
                                    // This is called with the results from from FB.getLoginStatus().
                                    function statusChangeCallback(response) {
                                        console.log('statusChangeCallback');
                                        console.log(response);
                                        // The response object is returned with a status field that lets the
                                        // app know the current login status of the person.
                                        // Full docs on the response object can be found in the documentation
                                        // for FB.getLoginStatus().
                                        if (response.status === 'connected') {
                                        // Logged into your app and Facebook.
                                        testAPI();
                                        } else {
                                        // The person is not logged into your app or we are unable to tell.
                                        document.getElementById('status').innerHTML = 'Please log ' +
                                            'into this app.';
                                        }
                                    }

                                    // This function is called when someone finishes with the Login
                                    // Button.  See the onlogin handler attached to it in the sample
                                    // code below.
                                    function checkLoginState() {
                                        FB.getLoginStatus(function(response) {
                                        statusChangeCallback(response);
                                        });
                                    }

                                    window.fbAsyncInit = function() {
                                        FB.init({
                                        appId      : '654679014932231',
                                        cookie     : true,  // enable cookies to allow the server to access 
                                                            // the session
                                        xfbml      : true,  // parse social plugins on this page
                                        version    : 'v2.8' // use graph api version 2.8
                                        });

                                        // Now that we've initialized the JavaScript SDK, we call 
                                        // FB.getLoginStatus().  This function gets the state of the
                                        // person visiting this page and can return one of three states to
                                        // the callback you provide.  They can be:
                                        //
                                        // 1. Logged into your app ('connected')
                                        // 2. Logged into Facebook, but not your app ('not_authorized')
                                        // 3. Not logged into Facebook and can't tell if they are logged into
                                        //    your app or not.
                                        //
                                        // These three cases are handled in the callback function.

                                        FB.getLoginStatus(function(response) {
                                        statusChangeCallback(response);
                                        });

                                    };

                                    // Load the SDK asynchronously
                                    (function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = "https://connect.facebook.net/en_US/sdk.js";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));

                                    // Here we run a very simple test of the Graph API after login is
                                    // successful.  See statusChangeCallback() for when this call is made.
                                    function testAPI() {
                                        console.log('Welcome!  Fetching your information.... ');
                                        FB.api('/me',{ locale: 'en_US', fields:'name, email,id,link' }, function(response) {
                                        /*$.ajax({
                                            url: "{{ url('user_facebook_id') }}",
                                            type:"GET",
                                            data: {'facebook_id': response.id},
                                            success: function (result) {
                                                // window.location.reload();
                                            }
                                        });*/
                                        console.log('Successful login for: ' + response.name);
                                        // document.getElementById('status').innerHTML =
                                        //     'Thanks for logging in, ' + response.name + '!';
                                        });
                                    }
                                </script>
                                @if(Auth::user()->facebook_id == "")
                                    <div class="connected-main tabcontent-title">Connect to Facebook</div>
                                    <p class="content">We will never post to Facebook or message your friends without your permission</p>
                                @else
                                    <div class="connected-main tabcontent-title">Connected to Facebook</div>
                                    <p class="content">We will never post to Facebook or message your friends without your permission</p>
                                @endif
                            </div>
                            <?php
                            if (Auth::user()->facebook_id == null || Auth::user()->facebook_id == '') {
                                ?>
                                <div class="connected-link">
                                    <a href="{{ route('connect_fb','facebook')}}" title="" class="facebook">
                                        <i class="fa fa-facebook"></i>
                                        <span class="connected-text">Connect to Facebook</span>
                                    </a>
                                </div>
                            <?php } else { ?>
                                <div class="connected-link">
                                    <!-- <a href="javascript:void(0);" title="" class="facebook">
                                        <i class="fa fa-facebook"></i>
                                        <span class="connected-text">Connected to Facebook</span>
                                    </a><br> -->
                                    <a href="javascript:void(0);" class="facebook disconnect_fb"><i class="fa fa-facebook"></i>
                                        <span class="connected-text">Disconnect</span></a>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- <div class="display-flex-custom">
                            <div class="connected-content">
                                <div class="connected-main tabcontent-title">Connect to Twitter</div>
                                <p class="content">We will never post to Twitter or message your friends without your permission</p>
                            </div>
                            <?php //if (Auth::user()->twitter_id == null || Auth::user()->twitter_id == '') { ?>
                                <div class="connected-link">
                                    <a href="{{ route('connect_fb','twitter')}}" title="" class="twitter">
                                        <i class="fa fa-twitter"></i>
                                        <span class="connected-text">Connect to Twitter</span>
                                    </a>
                                </div>
                            <?php //} else { ?>
                                <div class="connected-link">
                                    <!-- <a href="javascript:void(0);" title="" class="twitter">
                                        <i class="fa fa-twitter"></i>
                                        <span class="connected-text">Connected to Twitter</span>
                                    </a><br> 
                                    <a href="javascript:void(0);" class="twitter disconnect_tw"><i class="fa fa-twitter"></i>
                                        <span class="connected-text">Disconnect</span></a>
                                </div>
                            <?php //} ?>
                        </div>  -->                                                       
                        <div class="display-flex-custom">
                            <div class="connected-content">
                                <div class="connected-main tabcontent-title">Show links to FB on your profile page</div>
                                <p class="content">Your profile will include links to your Facebook page if this account is connected to your account.</p>
                            </div>                                                                
                            <div class="switch-main">
                                <label class="switch">
                                    <input type="checkbox" class="toggle-input fbtwshowstatus" name="chkfbtwshow" id="chkfbtwshow" value="<?php echo Auth::user()->social_icon_status; ?>" <?php if (Auth::user()->social_icon_status == '1') {
                                        echo ' checked';
                                    } ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="Request" class="tabcontent profile_page_main_section social-main" <?php if ($tab != 'request') { ?> style="display: none;" <?php } ?>>
                        <div class="profile_main_title_section">
                            <h2 class="title">
                                <i class="fa fa-file-text"></i>
                                Request
                            </h2>
                        </div>
                        <div class="profile_page block_page request_page" style="background: white;">
                            <div class="container">
                                <?php if(count($requserdata) > 0){ ?>
                                <div class="row" id="requests_more">
                                @foreach($requserdata as $req_udata)
                                    <div class="col-lg-6 col-md-12">
                                        <div class="profile_page_side_section">
                                            <div class="user_profile block_user_profile margin-bottom-30">
                                                <div class="user_image_section">
                                                    <div class="profile_section media align-items-center">
                                                        <div class="profile_pic media-left">
                                                            <?php $userdata=getUserdetailbyid($req_udata->user_id);  ?>
                                                            <?php
                                                            if (!empty($userdata) && $userdata->profile_image != null && file_exists(public_path() . '/user_img/' . $userdata->profile_image)) {
                                                                ?>
                                                                <img src="{{ asset("/public/user_img/".$userdata->profile_image) }}" alt="Profile">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="{{ asset('/') }}public/assets/image/profile.png" alt="User">
                                                                <?php
                                                            }
                                                            ?>      
                                                        </div>
                                                        <div class="media-body user_info">
                                                            <a class="name" href="{{ url('profile/'.$userdata['name']) }}">
                                                             <?php 
                                                              echo ucfirst($userdata['first_name'])." ".ucfirst($userdata['last_name']);
                                                              ?> <br>Sent you Request
                                                            </a>
                                                        </div>
                                                    </div>                              
                                                </div>
                                                <div class="user_profile_button">
                                                   <!-- start --><?php $connection = getConnection(Auth::user()->id,$userdata['id']); ?>
                                                            <a data-val="{{$req_udata->user_id}}" id="act_action" class="button connect button_accept button_connect" title="Accept" <?php if (isset($connection->is_block) && $connection->is_block==1): ?> disabled="disabled" <?php endif ?>>
                                                                Accept
                                                            </a>
                                                            <a data-val="{{$req_udata->user_id}}" id="reject_action" title="Reject" class="button connect button_reject button_connect">
                                                                Reject
                                                            </a>  
                                                    <!-- end -->        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                                <?php }else{ ?>
                                <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
                                    <span>
                                        <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
                                    </span>
                                    <p class="content_text">Awww ! no request.</p>
                                </div>
                                <?php } ?>
                                <div class="requestAZ">
                                <div class="ajax-load text-center" id="ajax-load-requests" style="display:none">
                                    <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                                </div>
                                <?php if (isset($requserdata_total) && intval($requserdata_total) > 0) { ?>
                                    <div class="blog_button">
                                        <a href="javascript:;" class="btn btn-primary" id="load_more_requests" title="Load More" data-page="4">
                                            LOAD MORE
                                        </a>
                                    </div>
                                <?php } ?> 
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="myModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" style="margin-top: 285px; ">
    <form name="frmSendMessage" id="frmSendMessage" action="{{route('sendMessage')}}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h3 id="myModalLabel">Send Message</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
             <input type="hidden" name="to_user_id" id="to_user_id" value="">
             <textarea placeholder="Enter Message" required="required" id="txt_message" name="txt_message" class="form-control"></textarea>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" id="messageSend" value="Send Message">
          </div>
        </div>
       </form>
  </div>
</div>

<!-- <script src="{{ asset('js/jquery.validate.min.js') }}"></script> -->
<script type="text/javascript">
$(document).ready(function () {

    $('body').on("click", ".open-message", function () {
        var myMessageId = $(this).attr('data-val');
        $(".modal-body #to_user_id").val( myMessageId );
    });
 /*start*/

        /*end*/
        $('.tablinks').on('click',function(){
            $('.tablinks').removeClass("active");
            $(this).addClass("active");
        });

        $('.disconnect_tw').on('click',function(){
            $.ajax({
                url: "{{route('disconnect_tw')}}",
                type:"POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if(result==0){
                       var x = document.getElementById("disconnect_tw");
                        x.className = "show";
                        setTimeout(
                            function(){ 
                                x.className = x.className.replace("show", ""); 
                            }, 5000);
                        setTimeout(function(){location.reload();}, 1000);
                        return false;    
                    }else{
                        var x = document.getElementById("userNotFind");
                        x.className = "show";
                        setTimeout(
                            function(){ 
                                x.className = x.className.replace("show", ""); 
                            }, 5000);
                        setTimeout(function(){location.reload();}, 1000);
                        return false;                          
                    }
                }
            });
        });

        $('.disconnect_fb').on('click',function(){
            $.ajax({
                url: "{{route('disconnect_fb')}}",
                type:"POST",
                data: {
                     _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if(result==0){
                       var x = document.getElementById("disconnect_fb");
                        x.className = "show";
                        setTimeout(
                            function(){ 
                                x.className = x.className.replace("show", ""); 
                            }, 5000);
                        setTimeout(function(){location.reload();}, 1000);
                        return false;    
                    }else{
                        var x = document.getElementById("userNotFind");
                        x.className = "show";
                        setTimeout(
                            function(){ 
                                x.className = x.className.replace("show", ""); 
                            }, 5000);
                        setTimeout(function(){location.reload();}, 1000);
                        return false;                          
                    }
                }
            });
        });

            
        $(".button_connect").click(function(){
            button_accept($(this).attr('data-val'));
        });
        $(".button_reject").click(function(){
            button_reject($(this).attr('data-val'));
        });
        /*end*/

        /*Message modal reset start*/
        $(function () {
            $(document).on("hidden.bs.modal", "#myModal", function () {
              $(this).find("#txt_message").val(""); 
              });
        });
        /*Message modal reset end*/

       /*Message validation start*/
        $("body").on('click',"#messageSend",function(){        
            $("#frmSendMessage").validate({
                rules: {      
                    txt_message: {
                        required: true,        
                    }
                },
                messages: {      
                    txt_message: "Please enter the message",
                },
            });
        });
        /*Message validation end*/
        $("#frmUpdateName").submit(function(e){
            e.preventDefault();
        });

        /*Message validation end*/
        $("#frmUpdateEmail").submit(function(e){
            e.preventDefault();
        });

        /*Message validation end*/
        $("#frmUpdatePassword").submit(function(e){
            e.preventDefault();
        });

        /*Message validation end*/
        $("#frmUpdatefName").submit(function(e){
            e.preventDefault();
        });

        /*Message validation end*/
        $("#frmUpdatelName").submit(function(e){
            e.preventDefault();
        });

        $("#btnusername").click(function(e){
            $("#frmUpdateName").validate({
                rules: {
                    txtUsername: {
                        required: true
                    }
                },
                messages: {
                    txtUsername: "Please enter username",
                },
                success: function(){
                     $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                     $.ajax({
                        url: "{{route('updatename')}}",
                        type:"POST",
                        data: {
                            'txtUsername': $('#txtUsername').val()
                        },
                        success: function (result) {
                            if(result==1){
                                var x = document.getElementById("existuser");
                                $('#txtUsername').val('{{ Auth::user()->name }}');
                                $("#frmUpdateName").hide();
                                x.className = "show";
                                setTimeout(
                                    function(){ 
                                        x.className = x.className.replace("show", ""); 
                                    }, 3000);
                                //setTimeout(function(){location.reload();}, 1000);
                                return false;    
                            }else{
                                if(result==2){
                                    var x = document.getElementById("sameusername");
                                    x.className = "show";
                                    setTimeout(
                                        function(){ 
                                            x.className = x.className.replace("show", ""); 
                                        }, 3000);
                                    //setTimeout(function(){location.reload();}, 1000);
                                    return false;   
                                }else{
                                    var x = document.getElementById("updateusernm");
                                    x.className = "show";
                                    setTimeout(
                                        function(){ 
                                            x.className = x.className.replace("show", ""); 
                                        }, 5000);
                                    setTimeout(function(){location.reload();}, 1000);
                                    return false;                          
                                }
                            }
                        }
                    });
                }
                    // return false;
            });
        });

        $("#frmUpdatePassword").validate({
            rules: {      
                txtoPassword: {
                    required: true,        
                },
                txtnPassword:{
                    required: true,
                },
                txtcPassword: {
                    required: true,
                    equalTo:  txtnPassword

                }
            },
            messages: {      
                txtoPassword: "Please enter old password",
                txtnPassword: "Please enter new password",
                txtcPassword: "Please enter confirm password",

            }
        });        
         /*Password validation start*/
         $("#btnchangepass").click(function(){        
            if ($("#frmUpdatePassword").valid()==true) {
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('update_password')}}" ,
                    type:"POST",
                    data: {
                        'txtoPassword' : $('#txtoPassword').val(),
                        'txtnPassword' : $('#txtnPassword').val(),
                        'txtcPassword' : $('#txtcPassword').val()
                    },
                    success: function(result){
                        if(result==0){
                           var x = document.getElementById("updatepassword");
                            x.className = "show";
                            setTimeout(
                                function(){ 
                                    x.className = x.className.replace("show", ""); 
                                }, 5000);
                            setTimeout(function(){location.reload();}, 1000);
                            return false;    
                        }else{
                            if (result==3) {
                                var x = document.getElementById("sameuserpassword");
                                    x.className = "show";
                                    setTimeout(
                                        function(){ 
                                            x.className = x.className.replace("show", ""); 
                                        }, 3000);
                                    //setTimeout(function(){location.reload();}, 1000);
                                    return false;
                            }else{
                                if (result==2) {
                                    var x = document.getElementById("passwordMismatch");
                                    $('#frmUpdatePassword').hide();
                                    $('#frmUpdatePassword')[0].reset();
                                    x.className = "show";
                                    setTimeout(
                                        function(){ 
                                            x.className = x.className.replace("show", ""); 
                                        }, 3000);
                                    //setTimeout(function(){location.reload();}, 1000);
                                    return false;   
                                }else{
                                    var x = document.getElementById("erroldpasss");
                                    $('#frmUpdatePassword').hide();
                                    $('#frmUpdatePassword')[0].reset();
                                    x.className = "show";
                                    setTimeout(
                                        function(){ 
                                            x.className = x.className.replace("show", ""); 
                                        }, 3000);
                                    //setTimeout(function(){location.reload();}, 1000);
                                    return false;   
                                }
                            }    
                        }
                    }
                });
            }     
        });
        
        /*Password validation end*/
        $("#updatefirstnm").click(function(){
            $("#frmUpdatefName").validate({
                rules: {
                    txtfUsername: {
                        required: true,
                        customNameText:true
                    }
                },
                messages: {
                    txtfUsername: "Please enter valid firstname",
                    customNameText: "Please enter letters only."
                },
                success: function(label){
                $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                    $.ajax({
                        url: "{{route('update_fname')}}",
                        method: "POST",
                        data: {
                            'txtfUsername': $('#txtfUsername').val()
                        },
                        success: function (result) {
                            //$('#succoldpass').fadeIn().delay(3000).fadeOut();
                           if(result==0){

                            var x = document.getElementById("samefirstname");
                            x.className = "show";
                            setTimeout(
                                function(){ 
                                    x.className = x.className.replace("show", ""); 
                                }, 3000);
                            //setTimeout(function(){location.reload();}, 1000);
                            return false;
                        }
                        else{
                            var x = document.getElementById("updatefastnm");
                            x.className = "show";
                            setTimeout(
                                function(){ 
                                    x.className = x.className.replace("show", ""); 
                                }, 5000);
                            setTimeout(function(){location.reload();}, 1000);
                            return false;      
                        }
                        }
                    });
                    return false;
                },
            });
        });
        $("#updatelast").click(function(){
            $("#frmUpdatelName").validate({
                rules: {
                    txtlUsername: {
                        required: true,
                        customNameText:true
                    }
                },
                messages: {
                    txtlUsername: "Please enter valid lastname",
                    customNameText: "Please enter letters only."
                },
                success: function(label){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $.ajax({
                url: "{{route('update_lname')}}",
                method : "POST",
                data: {
                    'txtlUsername': $('#txtlUsername').val()
                   },
                success: function (result) {

                    //$('#succoldpass').fadeIn().delay(3000).fadeOut();
                   if(result==0){
                        var x = document.getElementById("samelastname");
                        x.className = "show";
                        setTimeout(
                            function(){ 
                                x.className = x.className.replace("show", ""); 
                            }, 3000);
                        //setTimeout(function(){location.reload();}, 1000);
                        return false;    
                    }
                    else{
                        var x = document.getElementById("updatelastnm");
                        x.className = "show";
                        setTimeout(
                            function(){ 
                                x.className = x.className.replace("show", ""); 
                            }, 5000);
                        setTimeout(function(){location.reload();}, 1000);
                        return false;     
                    }
                }
            });
            return false;
            },
        });
        });
         $.validator.addMethod("customNameText", 
            function(value, element) {
                var re = /^[a-zA-Z]+$/;
                return re.test(value);
          });

         $("#frmUpdateEmail").validate({
                rules: {
                    txtEmail: {
                        required: true,
                        email:true
                    }
                },
                messages: {
                    txtEmail: {
                        required: "Please enter email",
                        email: "Please enter Valid email"
                    }

                },
            });
         $("#updatemail").click(function(e){
            if ($("#frmUpdateEmail").valid()==true) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('update_email') }}",
                    type:"POST",
                    data: {
                        'txtEmail': $('#txtEmail').val()
                    },
                    success: function (result) {
                        if(result==1){
                           var x = document.getElementById("updateemail_toats");
                            $('#txtEmail').val('{{ Auth::user()->primary_email }}');
                            $("#frmUpdateEmail").hide();
                            $(".lblemail").hide();
                            x.className = "show";
                            setTimeout(
                                function(){ 
                                    x.className = x.className.replace("show", ""); 
                                }, 3000);
                            //setTimeout(function(){location.reload();}, 1000);
                            return false;    
                        }else{
                            if (result==3) {
                                var x = document.getElementById("sameuseremail");
                                x.className = "show";
                                setTimeout(
                                    function(){ 
                                        x.className = x.className.replace("show", ""); 
                                    }, 3000);
                                //setTimeout(function(){location.reload();}, 1000);
                                return false; 
                            }else{
                                if(result==2){
                                    var x = document.getElementById("updateEmailVerify");
                                    x.className = "show";
                                    setTimeout(
                                        function(){ 
                                            x.className = x.className.replace("show", ""); 
                                        }, 5000);
                                    setTimeout(function(){location.reload();}, 1000);
                                    return false;    
                                }else{
                                    var x = document.getElementById("updateEmail");
                                    x.className = "show";
                                    setTimeout(
                                        function(){ 
                                            x.className = x.className.replace("show", ""); 
                                        }, 5000);
                                    setTimeout(function(){location.reload();}, 1000);
                                    return false;
                                }    
                            }                          
                        }
                    }
                });
            }
        });
         $(".message1").click(function(){
            $("#to_user_id").val($(this).attr('data-val'));
            $("#myModal").modal('show');
        });

        $(".pgclass").change(function () {
            //alert("Hello");
            $("#msgchecked").hide();
            $("#msguncheck").hide();
            var cat_name = $(this).attr('data-val');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updateupbyid') }}", type: 'POST', data: {parrent_id: $(this).val()},
                success: function (result) {
                    
                    for (var prop in result.childelement) {
                        if (result.childelement.hasOwnProperty(prop)) {
                            // or if (Object.prototype.hasOwnProperty.call(obj,prop)) for safety...
                            //alert("prop: " + prop + " value: " + result.childelement[prop].id)
                            if (result.status == 0) {
                                $("#child_" + result.childelement[prop].id).addClass('unchecked-custom');
                                $("#child_" + result.childelement[prop].id).removeClass('checked-custom');
                            } else {
                                $("#child_" + result.childelement[prop].id).addClass('checked-custom');
                                $("#child_" + result.childelement[prop].id).removeClass('unchecked-custom');
                            }
                        }
                    }
                    if (result.status == 0) {
                        $("#msguncheck").fadeIn().delay(1000).fadeOut();
                        var x = document.getElementById("msguncheck");
                        $("#msguncheck").text(cat_name+" Category Deselected");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                    } else {
                        $("#msgchecked").fadeIn().delay(1000).fadeOut();
                        var x = document.getElementById("msgchecked");
                        $("#msgchecked").text(cat_name+" Category Selected");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                    }
                }
            });
        });
        $(".childgenres").click(function () {
            $("#msgchecked_one").hide();
            $("#msguncheck_one").hide();
            var cat_name = $(this).attr('data-val');
            var pid = $(this).attr("data-pid");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updateupbycid') }}", 
                type: 'POST', 
                data: {child_id: $(this).attr("data-id"), parrentid: pid},
                success: function (result) {

                    if (result.swstatus == 0) {
                        $("#pg_" + result.parrent_id).attr('checked', false);
                    } else {
                        $("#pg_" + result.parrent_id).attr('checked', true);
                    }

                    if (result.return == 0) {

                        //$(this).css("color", "black");
                        $("#pg_" + pid).prop('checked', false);
                        /*start*/
                        $("#pg_" + result.parrent_id).attr('checked', false);
                        /*end*/

                        
                        if (result.sub_return == 1) {
                            $("#msgchecked_one").fadeIn().delay(1000).fadeOut();
                            var x = document.getElementById("msgchecked_one");
                            $("#msgchecked_one").text(cat_name+" Sub Category Selected");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                        }else{
                            $("#msguncheck_one").fadeIn().delay(1000).fadeOut();
                            var x = document.getElementById("msguncheck_one");
                            $("#msguncheck_one").text(cat_name+" Sub Category Deselected");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                        }
                    } else {

                        $("#pg_" + pid).prop('checked', true);
                        //$(this).css("color", "#58bb47");
                        if (result.sub_return == 1) {
                            $("#msgchecked_one").fadeIn().delay(1000).fadeOut();
                            var x = document.getElementById("msgchecked_one");
                            $("#msgchecked_one").text(cat_name+" Sub Category Selected");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                        }else{
                            $("#msguncheck_one").fadeIn().delay(1000).fadeOut();
                            var x = document.getElementById("msguncheck_one");
                            $("#msguncheck_one").text(cat_name+" Sub Category Deselected");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                        }
                    }
                }
            });
            if ($(this).hasClass('unchecked-custom')) {
                $(this).removeClass('unchecked-custom');
                $(this).addClass('checked-custom');
            } else {
                $(this).addClass('unchecked-custom');
                $(this).removeClass('checked-custom');
            }
            });
        $('body').on('change','.chkunotification',function () {
            $("#msgchecked_two").hide();
            $("#msguncheck_two").hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updateunotification') }}", type: 'POST', data: {'notification_id': $(this).attr("data-id")},
                success: function (result) {
                    if (result == 0) {
                        $("#msguncheck_two").fadeIn().delay(1000).fadeOut();
                        var x = document.getElementById("msguncheck_two");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                    } else {
                        $("#msgchecked_two").fadeIn().delay(1000).fadeOut();
                        var x = document.getElementById("msgchecked_two");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                    }
                }
            });
        });
        $('#chkfbtwshow').change(function () {
            $("#msgchecked_three").hide();
            $("#msguncheck_three").hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updateSocialstatus') }}", type: 'POST', data: {'status': $("#chkfbtwshow").val()},
                success: function (result) {
                    if (result == 0) {
                        $("#chkfbtwshow").val('0');
                        $("#chkfbtwshow").attr('checked', false);
                        $("#msguncheck_three").fadeIn().delay(1000).fadeOut();
                        var x = document.getElementById("msguncheck_three");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                    } else {
                        $("#chkfbtwshow").val('1');
                        $("#chkfbtwshow").attr('checked', true);
                        $("#msgchecked_three").fadeIn().delay(1000).fadeOut();
                        var x = document.getElementById("msgchecked_three");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                    }
                }
            });
        });
        $("#errncpass").hide();
        var i = 0;var j = 0;var k = 0;var l = 0;var m = 0;
        
        $("#edit_username").click(function () {
            $("#frmUpdateName").toggle('fast');
            if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
                if($('.footer-height-custom').length > 0){
                    i++;
                    $("footer").removeClass('footer-height-custom');
                }else{
                    if(i > 0){
                        $("footer").addClass('footer-height-custom');
                    }
                }
            }else{
              if($('.footer-height-custom').length == 0){
                     if(i > 0){
                      $("footer").addClass('footer-height-custom');
                    }
                }
            }
        });
        $("#edit_fusername").click(function () {
            $("#frmUpdatefName").toggle('fast');
            if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
                if($('.footer-height-custom').length > 0){
                    j++;
                    $("footer").removeClass('footer-height-custom');
                }else{
                     if(j > 0){
                        $("footer").addClass('footer-height-custom');
                    }
                }
            }else{
               if($('.footer-height-custom').length == 0){
                     if(j > 0){
                      $("footer").addClass('footer-height-custom');
                    }
                }
            }
        });
        $("#edit_lusername").click(function () {
            $("#frmUpdatelName").toggle('fast');
            if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
                 if($('.footer-height-custom').length > 0){
                    k++;
                    $("footer").removeClass('footer-height-custom');
                }else{
                     if(k > 0){
                        $("footer").addClass('footer-height-custom');
                    }
                }
            }else{
               if($('.footer-height-custom').length == 0){
                     if(k > 0){
                      $("footer").addClass('footer-height-custom');
                    }
                }
            }
        });
        $("#edit_email").click(function () {
            $("#frmUpdateEmail").toggle('fast');
            $(".lblemail").toggle();
            if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
                if($('.footer-height-custom').length > 0){
                    $("footer").removeClass('footer-height-custom');
                    l++;
                }else{
                    if(l > 0){
                        $("footer").addClass('footer-height-custom');
                    }
                }
            }else{
                if($('.footer-height-custom').length == 0){
                     if(l > 0){
                      $("footer").addClass('footer-height-custom');
                    }
                }
            }
        });
        $("#edit_password").click(function () {
            $("#frmUpdateoPassword").toggle('fast');
            $("#frmUpdatePassword").toggle('fast');
            $("#frmUpdatecPassword").toggle('fast');
            
            if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
                if($('.footer-height-custom').length > 0){
                    m++;
                    $("footer").removeClass('footer-height-custom');
                }else{
                     if(m > 0){
                        $("footer").addClass('footer-height-custom');
                    }
                }
            }else{
               if($('.footer-height-custom').length == 0){
                 if(m > 0){
                      $("footer").addClass('footer-height-custom');
                  }
                }
            }
        });
        $("#txtoPassword").blur(function () {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('checkOldpassword') }}",
                type:"POST",
                data: {'oldpass': $('#txtoPassword').val()},
                success: function (result) {
                    if (result == 0) {
                        //$('#erroldpass').show();
                        //$('#succoldpass').hide();
                        //$('#erroldpass').fadeIn().delay(3000).fadeOut();
                        var x = document.getElementById("erroldpasss");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                        return false;
                    } else {
                        //$('#succoldpass').show();
                        //$('#erroldpass').hide();
                        //$('#succoldpass').fadeIn().delay(3000).fadeOut();
                        var x = document.getElementById("succoldpass");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                        return true;
                    } 
                }
            });
            
        });
        $(".plusclick").click(function () {
            if ($(this).html() == '-') {
                $(this).html('+');
            } else {
                $(this).html('-');
            }
        });
        <?php if ($tab == 'account-details') { ?>
            // Get the element with id="defaultOpen" and click on it
            var x=document.getElementById("defaultOpen_usermenu");
            if(x==null) {
            } else {
                openMenuTab('defaultOpen_usermenu', 'Account');
                //x.click();                         
            }
        <?php } elseif ($tab == 'preference-list') {?>
            // Get the element with id="defaultOpen" and click on it
            var x=document.getElementById("defaultOpen_preference");
            if(x==null) {
            } else { 
                openMenuTab('defaultOpen_preference', 'Preference');
                //x.click();                    
            }    
        <?php } elseif ($tab == 'connections') { ?>
            // Get the element with id="defaultOpen" and click on it
            var x=document.getElementById("defaultOpen_connection");
            if(x==null) {
            }else{
                openMenuTab('defaultOpen_connection', 'Connections');
                //x.click();
            }  
        <?php } elseif ($tab == 'bookmarks') { ?>
            // Get the element with id="defaultOpen" and click on it
            var x=document.getElementById("defaultOpen_bookmarks");
            if(x==null) {
            }else{
                openMenuTab('defaultOpen_bookmarks', 'Bookmarks');
                //x.click();
            }
        <?php }  elseif ($tab == 'notification-list') { ?>
            // Get the element with id="defaultOpen" and click on it
            var x=document.getElementById("defaultOpen_notificationlist");
            if(x==null) {
            }else{
                openMenuTab('defaultOpen_notificationlist', 'Notifications-list');
                //x.click();
            }
        <?php } elseif ($tab == 'followers') { ?>
                var x=document.getElementById("defaultOpen_followers");
                if(x==null) {
                }else{
                    openMenuTab('defaultOpen_followers', 'Followers');
                    //x.click();
                }
        <?php } elseif ($tab == 'social') { ?>
            // Get the element with id="defaultOpen" and click on it
            var x=document.getElementById("defaultOpen_social");
            if(x==null) {
            }else{
                openMenuTab('defaultOpen_social', 'Social');
                //x.click();
            }  
        <?php } elseif ($tab == 'following') { ?>
            // Get the element with id="defaultOpen" and click on it
            var x=document.getElementById("defaultOpen_following");
            if(x==null) {
            }else{
                openMenuTab('defaultOpen_following', 'Following');
                //x.click();
            }
        <?php }elseif ($tab == 'request') { ?>  
            // Get the element with id="defaultOpen" and click on it
            var x=document.getElementById("defaultOpen_request");
            if(x==null) {
            }else{
                openMenuTab('defaultOpen_request', 'Request');
                //x.click();
            }
        <?php } else { ?>
            // Get the element with id="defaultOpen" and click on it
            var x=document.getElementById("defaultOpen_usermenu");
            if(x==null) {
            } else {
                openMenuTab('defaultOpen_usermenu', 'Account');
                //x.click();                         
            }
        <?Php } ?>
        
        
        $('#txtUsername').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z0-9]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            } else {
                e.preventDefault();
                return false;
            }
        });
    });

    setTimeout(function () {
        $('#succ_msg').fadeOut('fast');
        $('#UserExist').hide();
        $("#email_changed").hide();
    }, 5000);
    /*Remove bookmark start*/
    function removeBookmark(blogid){
        swal({
            title: "Are you sure you want to remove bookmark ?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
                if (willDelete) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('removebookmark')}}",
                    type:"POST",
                    data: {'blog_id': blogid}, success: function (result) {
                        if(result==1) {
                            /*$("#bookmarkmsg").fadeIn().delay(5000).fadeOut();*/
                            $(".blockhide"+blogid).hide();
                            var x = document.getElementById("bookmark_remove");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", "");location.reload();  }, 2000);
                        }/*else{
                            $("#bookmarkmsg").fadeIn().delay(1000).fadeOut();
                            $(".blockhide"+blogid).hide();
                        }  */                    
                    }
                });
            }
        });
        /*window.location='bookmarks';*/
    }
    /*Remove bookmark end*/
    /*Remove connection start*/
    function removeConnection(uid){
        swal({
            title: "Are you sure you want to remove connection ?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('connection_remove')}}",
                    type:"POST",
                    data: {'uid': uid}, 
                    success: function (result) {
                        if(result==1) {
                            /*$("#bookmarkmsg").fadeIn().delay(5000).fadeOut();*/
                            $(".blockhide"+uid).hide();
                            var x = document.getElementById("connection_remove");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", "");location.reload();  }, 2000);
                        }
                    },
                    error: function (result) {
                    }
                });
            }
        });      
    }
    /*Remove connection end*/
    
    /*Remove Following Start*/
    function removefollowing(fid){
        var name = $('#name'+fid).attr('data-name');
        swal({
            title: "Are you sure you want to remove following ?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('following_remove')}}",
                    type:"POST",
                    data: {'fid': fid}, 
                    success: function (result) {
                        if(result==1) {
                            /*$("#bookmarkmsg").fadeIn().delay(5000).fadeOut();*/
                            $(".blockhide"+fid).hide();
                            $("#following_remove").html('You have unfollowed '+name);
                            var x = document.getElementById("following_remove");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", "");location.reload();  }, 2000);
                        }
                    },
                    error: function (result) {
                        alert(fid);
                    }
                });
            }
        });      
    }
    /*Remove Following end*/
    /*Remove follower start*/
    function removefollower(fid){
                    var name = $('#username'+fid).attr('data-name');
                    swal({
                        title: "Are you sure you want to remove follower ?",
                        text: "",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "{{route('follower_remove')}}",
                                type: "POST",
                                data: {'follower_id': fid}, 
                                success: function (result) {
                                    if(result==1) {
                                        /*$("#bookmarkmsg").fadeIn().delay(5000).fadeOut();*/
                                        $(".blockhide"+fid).hide();
                                        $("#follower_remove").html('You have unfollowed '+name);
                                        var x = document.getElementById("follower_remove");
                                        x.className = "show";
                                        setTimeout(function(){ x.className = x.className.replace("show", "");location.reload();  }, 2000);
                                    }
                                },
                                error: function (result) {
                                    alert(fid);
                                }
                            });
                        }
                    });      
                }
                /*Remove follower end*/

                /*start*/
    function button_accept(userid)
    {

    swal({
            title: "Are you sure accept this request ?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location.href = "<?php echo url('acceptrequest/"+userid+"'); ?>";
            }
            });
    }
     function button_reject(userid)
    {
    swal({
            title: "Are you sure reject this request ?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location.href = "<?php echo url('rejectrequest/"+userid+"'); ?>";
            }
            });
    }
    /*end*/
    function openMenuTab(evt, Tabname) {
        // tabcontent = document.getElementsByClassName("tabcontent");
        // for (i = 0; i < tabcontent.length; i++) {
        //     tabcontent[i].style.display = "none";
        // }
        //tablinks = document.getElementsByClassName("tablinks");
        $('.tabcontent').hide();
        $('.tablinks').removeClass("active");
        // for (i = 0; i < tablinks.length; i++) {
        //     tablinks[i].className = tablinks[i].className.replace(" active", "");
        // }
        //document.getElementById(Tabname).style.display = "block";
        $('#'+Tabname).show();
        $('#'+evt).addClass("active");
        //evt.currentTarget.className += " active";
    }

    $(document).ready(function () {
        var page = 1;
        $("#load_more").click(function(){
            page++;
            $.ajax({
                url: '?page=' + page,
                type: "get",
                beforeSend: function()
                {
                    $('#ajax-load-bookmark').show();
                }
            })
            .done(function(data)
            {
                if(data.html == ""){
                    $("#ajax-load-bookmark").hide();
                    $('#ajax-load-bookmark').html("No more bookmarks found");
                    return;
                }
                $('#ajax-load-bookmark').hide();
                $("#bookmarks_more").append(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('server not responding...');
            });
        });

    var orderBy = 'ASC';
    $("body").on('click','.load_more_connections',function(){
        var page = $(this).attr('data-page');
        var search_connection = $('#search_connection').val();
        $('#ajax-load-connections').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getConnDetails')}}",
            type: "POST",
            data: {'search_connection': search_connection,'page':page,'orderBy':orderBy}, 
            success: function (result) {
                if(result) {
                    $('#ajax-load-connections').hide();
                    $('.ajaxconnlistaz').hide();
                    $("#connections_more").append(result);
                }
                
            }
        });
    });

    $("body").on('blur','#search_connection',function(){
        var page = 0;
        var search_connection = $('#search_connection').val();
        $('#ajax-load-connections').show();
        $("#connections_more").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getConnDetails')}}",
            type: "POST",
            data: {'search_connection': search_connection,'page':page,'orderBy':orderBy}, 
            success: function (result) {
                if(result) {
                    $('.ajaxconnlistaz').hide();
                    $('#ajax-load-connections').hide();
                    $("#connections_more").append(result);
                }
                
            }
        });
    });

    $("body").on('click','#btnconnatoz',function () {
        var page = 0;
        orderBy = 'ASC';
        var search_connection = $('#search_connection').val();
        $('#ajax-load-connections').show();
        $("#connections_more").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getConnDetails')}}",
            type: "POST",
            data: {'search_connection': search_connection,'page':page,'orderBy':'ASC'}, 
            success: function (result) {
                if(result) {
                    $('.ajaxconnlistaz').hide();
                    $('#ajax-load-connections').hide();
                    $("#connections_more").append(result);
                }
                
            }
        });
    });

    $("body").on('click','#btnmaxblog',function () {
        var page = 0;
        orderBy = 'DESC';
        var search_connection = $('#search_connection').val();
        $('#ajax-load-connections').show();
        $("#connections_more").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getConnDetails')}}",
            type: "POST",
            data: {'search_connection': search_connection,'page':page,'orderBy':'DESC'}, 
            success: function (result) {
                if(result) {
                    $('.ajaxconnlistaz').hide();
                    $('#ajax-load-connections').hide();
                    $("#connections_more").append(result);
                }
                
            }
        });
    });


    var followers_orderBy = 'ASC';
    $("body").on('click','.load_more_followers',function(){
        var page = $(this).attr('data-page');
        var search_follower = $('#search_follower').val();
        $('#ajax-load-followers').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getFollowers')}}",
            type: "POST",
            data: {'search_follower': search_follower,'page':page,'orderBy':followers_orderBy}, 
            success: function (result) {
                if(result) {
                    $('#ajax-load-followers').hide();
                    $('.ajaxfollowerlistza').hide();
                    $("#followers_more").append(result);
                }
            }
        });
    });

    $("body").on('blur','#search_follower',function(){
        var page = 0;
        var search_follower = $('#search_follower').val();
        $('#ajax-load-followers').show();
        $("#followers_more").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getFollowers')}}",
            type: "POST",
            data: {'search_follower': search_follower,'page':page,'orderBy':followers_orderBy}, 
            success: function (result) {
                if(result) {
                    $('#ajax-load-followers').hide();
                    $('.ajaxfollowerlistza').hide();
                    $("#followers_more").append(result);
                }
            }
        });
    });


    $("body").on('click','#follower_ascending',function () {
        var page = 0;
        followers_orderBy = 'ASC';
        var search_follower = $('#search_follower').val();
        $('#ajax-load-followers').show();
        $("#followers_more").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getFollowers')}}",
            type: "POST",
            data: {'search_follower': search_follower,'page':page,'orderBy':followers_orderBy}, 
            success: function (result) {
                if(result) {
                    $('#ajax-load-followers').hide();
                    $('.ajaxfollowerlistza').hide();
                    $("#followers_more").append(result);
                }
            }
        });
    });

    $("body").on('click','#follower_descending',function () {
        var page = 0;
        followers_orderBy = 'DESC';
        var search_follower = $('#search_follower').val();
        $('#ajax-load-followers').show();
        $("#followers_more").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getFollowers')}}",
            type: "POST",
            data: {'search_follower': search_follower,'page':page,'orderBy':followers_orderBy}, 
            success: function (result) {
                if(result) {
                    $('#ajax-load-followers').hide();
                    $('.ajaxfollowerlistza').hide();
                    $("#followers_more").append(result);
                }
            }
        });
    });

    var followings_orderBy = 'ASC';
    $("body").on('click','.load_more_followings',function(){
        var page = $(this).attr('data-page');
        var search_following = $('#search_following').val();
        $('#ajax-load-followings').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getFollowings')}}",
            type: "POST",
            data: {'search_following': search_following,'page':page,'orderBy':followings_orderBy}, 
            success: function (result) {
                if(result) {
                    $('.ajaxfollowlistza').hide();
                    $('#ajax-load-followings').hide();
                    $("#following_more").append(result);
                }
            }
        });
    });

    $("body").on('blur','#search_following',function(){
        var page = 0;
        var search_following = $('#search_following').val();
        $("#following_more").html('');
        $('#ajax-load-followings').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getFollowings')}}",
            type: "POST",
            data: {'search_following': search_following,'page':page,'orderBy':followings_orderBy}, 
            success: function (result) {
                if(result) {
                    $('.ajaxfollowlistza').hide();
                    $('#ajax-load-followings').hide();
                    $("#following_more").append(result);
                }
            }
        });
    });


    $("body").on('click','#following_ascending',function () {
        var page = 0;
        followings_orderBy = 'ASC';
        var search_following = $('#search_following').val();
        $("#following_more").html('');
        $('#ajax-load-followings').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getFollowings')}}",
            type: "POST",
            data: {'search_following': search_following,'page':page,'orderBy':followings_orderBy}, 
            success: function (result) {
                if(result) {
                    $('.ajaxfollowlistza').hide();
                    $('#ajax-load-followings').hide();
                    $("#following_more").append(result);
                }
            }
        });
    });

    $("body").on('click','#following_descending',function () {
        var page = 0;
        followings_orderBy = 'DESC';
        var search_following = $('#search_following').val();
        $("#following_more").html('');
        $('#ajax-load-followings').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getFollowings')}}",
            type: "POST",
            data: {'search_following': search_following,'page':page,'orderBy':followings_orderBy}, 
            success: function (result) {
                if(result) {
                    $('.ajaxfollowlistza').hide();
                    $('#ajax-load-followings').hide();
                    $("#following_more").append(result);
                }
            }
        });
    });


    $("body").on('click','#load_more_notifications',function(){
        var page = $(this).attr('data-page');
        $('#ajax-load-notifications').show();
        $('#load_more_notifications').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getNotifications')}}",
            type: "POST",
            data: {'page':page}, 
            success: function (result) {
                if(result) {
                    $('.ajaxfollowlistza').hide();
                    $('#ajax-load-notifications').hide();
                    $("#notifications_more").append(result);
                }
            }
        });
    });

     $("body").on('click',"#load_more_requests",function(){
        var page = $(this).attr('data-page');
        $('#ajax-load-requests').show();
        $('#load_more_requests').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('getConnectionRequest')}}",
            type: "POST",
            data: {'page':page}, 
            success: function (result) {
                if(result) {
                    $('.requestAZ').hide();
                    $('#ajax-load-requests').hide();
                    $("#requests_more").append(result);
                }
            }
        });
    });

});
    
</script>
@endsection