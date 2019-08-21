@foreach($blogdetails as $blogdata)



                            <div class="col-lg-6 col-md-12">



                                <div class="block_author_section">



                                    <div class="block_profile_main">



                                        <div class="block_profile_section media" >



                                            <div class="media-left">



                                                <div class="profile_pic">

                                                    <?php if (isset($userdetails->profile_image) && $userdetails->profile_image != null && file_exists(public_path() . '/user_img/' . $userdetails->profile_image)) { ?>

                                                        <img src="{{ asset("/public/user_img/".$userdetails->profile_image) }}" alt="">

                                                    <?php } else { ?>

                                                        <img src="{{ asset('/') }}public/assets/image/profile.png" alt="Profile">

                                                    <?php } ?>

                                                </div>



                                            </div>



                                            <div class="media-body">



                                                <?php



                                                if ($userdetails != null) {



                                                    ?>



                                                    <a href="{{ url('profile/'.$userdetails->name)}}" title="{{ ucfirst($userdetails->first_name) }} {{ ucfirst($userdetails->last_name) }}" class="user_name">{{ ucfirst($userdetails->first_name) }} {{ ucfirst($userdetails->last_name) }}</a>



                                                    <?php



                                                }



                                                ?>



                                                <div class="time"><?php echo date("F j, Y", strtotime($blogdata->created_at)); ?></div>



                                            </div>



                                        </div>



                                        <div class="block_profile_icon_section">



                                            <a href="javascript:;" title="Save" class="icon">



                                                <i class="icon-save-bookmark"></i>



                                            </a>



                                            <a href="javascript:;" title="Save" class="icon">



                                                <i class="icon-arrow-down"></i>



                                            </a>



                                        </div>



                                    </div>



                                    <div class="block_author_img">

                                        <?php if (isset($blogdata->blog_image) && $blogdata->blog_image != null && file_exists(public_path() . '/blog_img/' . $blogdata->blog_image)) { ?>

                                            <img src="{{ asset("/public/blog_img/".$blogdata->blog_image) }}" alt="Blog">

                                        <?php } else { ?>

                                            <img src="{{ asset('/') }}public/blog_img/no_img.jpg" alt="Blog">

                                        <?php } ?>

                                    </div>



                                    <div class="block_author_heading">



                                        <a href="{{ url('blog/'.$blogdata->blog_slug) }}" title="{{ $blogdata->blog_title }}" class="title" target="_blank">{{ $blogdata->blog_title }}</a>



                                    </div>



                                    <p class="block_author_content">



                                        @php echo html_entity_decode(str_limit($blogdata->blog_description, 200)) @endphp



                                    </p>



                                    <div class="read_more_section">



                                        <a href="{{ url('blog/'.$blogdata->blog_slug) }}" title="Read More" >Read More...</a>



                                        <span class="follow pull-right">1.5 K</span>



                                    </div>



                                </div>



                            </div>



                            @endforeach	