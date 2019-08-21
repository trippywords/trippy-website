@extends('layouts.app')
@section('title','Blog Category')
@section('content')
<style>
  .sub_cat.active:before {
    content: '';
    border-top: 3px solid #58ba47;
    width: 35px;
    top: 35px;
    position: absolute;
  }
  .owl-carousel.active {
    display: block !important;
  }
</style>
<section>
   <div class="blog-main-banner">
      <div class="container">
         <div class="row custom-row">
            <div class="col-lg-5 col-sm-6 custom-col">
               <div class="">
                  <h1 class="banner-title">TAKE A GOOD LOOK AROUND
                  </h1>
               </div>
            </div>
            <div class="col-lg-7 col-sm-6 custom-col-image">
               <div class="img-right">
                  <img src="{{ asset('/public/assets/image/blogmain-banner.png') }}" alt="blog-main-banner">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="blog-main top-gap-half-padding">
      <div class="container">
         <div class="row">
          <?php $i = 1; ?>
            @foreach($genArray as $val)
            <?php
              if ($i > 3) {
                break;
              }
               $blogArray = getblogGenre($val->id);
                if (!empty($blogArray)) {
                  $created_by = $blogArray->created_by;
                  if(!empty($created_by)) {
                    $userArray = getUserById($created_by);
                  }
               }
               $name = "";
               if (!empty($userArray->name)) {
                   $name =(isset($userArray->first_name)?$userArray->first_name:'').' '.(isset($userArray->last_name)?$userArray->last_name:'');
                 }
               ?>
            <div class="col-lg-4 col-md-4 col-sm-6">
               <div class="blog-section">
                  <h4 class="blog-main-title">{{$val->name}}
                  </h4>
                  <?php
                     if (isset($blogArray->blog_image) && $blogArray->blog_image!='' && file_exists(asset('/').'public/blog_img/'.$blogArray->blog_image)) {
                       $blog_image = $blogArray->blog_image;
                     }else{
                       $blog_image = 'no_img.jpg';
                     }
                     ?>
                  <div class="blog-img">
                     <a href="{{url('blog/'.$blogArray->blog_slug)}}"><img src="{{ asset('/')}}public/blog_img/{{$blog_image}}" alt="blog-1" style="height:240px;"></a>
                  </div>
                  <div class="blog-author media">
                     <div class="media-left">
                        <?php
                           if (isset($userArray->profile_image) && $userArray->profile_image!='' && file_exists(asset('/public/user_img/'. $userArray->profile_image))) {
                            $imagePath = asset('/public/user_img/' . $userArray->profile_image);
                           } else {
                            $imagePath = asset('/public/assets/image/profile.png');
                           }
                           ?>
                        <img src="{{$imagePath}}" class="media-object" style="width: 45px;height: 45px;border-radius: 50%;">
                     </div>
                     <div class="media-body">
                        <span class="author-title author-span">Posted by {{$name}}
                        </span>
                        <?php
                           $blogDate = "";
                               if(!empty($blogArray->created_at)){
                                 $blogDate = date("F d,Y",strtotime($blogArray->created_at));
                               }
                           ?>
                        <span class="author-span">{{$blogDate}}
                        </span>           
                     </div>
                  </div>
                  <div class="blog-section-title">
                     <?php
                        $blogTitle = "";
                          if(!empty($blogArray->blog_title)){
                           $blogTitle = $blogArray->blog_title;
                          }
                          if (!empty($val->detail)) {
                             $val->detail = substr($val->detail, 0, 230) . "...";
                          } else {
                             $val->detail = "No Blog Detail";
                          }
                        ?>
                     <a href="{{url('blog/'.$blogArray->blog_slug)}}" class="blog-title" title="">{{$blogTitle}}
                     </a>
                  </div>
                  <div class="blog-contant">
                     <p>{{$val->detail}}
                     </p>
                  </div>
               </div>
            </div>
            <?php $i++; ?>
            @endforeach
         </div>
      </div>
   </div>
</section>
<section>
   <div class="discussed-main section-gap-half-padding">
   <div class="container">
      <?php
         $odd = 1;
         $even = 2;
         ?>
      @if(!empty($genArray))
      @foreach($genArray as $subVal)
      
      <?php
         $sub_id = $subVal->id;
         $sub_cat = getSubcategoryByParent($subVal->id);
         $subBlogArray = getblogGenre($subVal->id);
         if (!empty($subBlogArray->created_by)) {
           $userSubArray = getUserById($subBlogArray->created_by);
         }
         $uname = "";
         if (!empty($userSubArray->name)) {
             $uname = (isset($userSubArray->first_name)?$userSubArray->first_name:'').' '.(isset($userSubArray->last_name)?$userSubArray->last_name:'');
         }
         ?>
      <div class="row">
         <div class="col-lg-8 col-sm-12">
            <a href="blog_category.blade2.php">
            </a>
            <div class="blog-main-slider-main">
               <div class="blog-main-slider-title">
                  <h2 class="title">{{$subVal->name}}
                  </h2>
                  <div id="sync{{$even}}" class="blog-dots-text owl-carousel owl-theme">
                     <?php $j=1; ?>
                     @foreach($sub_cat as $sub)
                     <div class="item">
                        <a href="javascript:;" data-id="{{$sub->id}}" title="{{$sub->name}}" class="dots-text sub_cat old_sub_cat{{ $subVal->id }} subCatDiv{{$sub->id}} <?php echo (isset($j) && $j==1)?"active":''; ?>" onclick="openCat('{{ $subVal->id }}','subCatDiv{{$sub->id}}')">{{$sub->name}}
                        </a>
                     </div>
                     <?php $j++; ?>
                     @endforeach
                  </div>
               </div>
              <?php $i=1; ?>
              <div class="blog-main-slider-section">
                @foreach($sub_cat as $sub)
                  <?php $blogs = DB::table('blogs')->select('*')->where("blogs.blog_genre", "=", $sub->id)->orderBy("blogs.id","desc")->limit(6)->get()->toArray(); ?>
                  @if(!empty($blogs))
                  <div id="subCatDiv{{$sub->id}}" class="owl-carousel owl-theme subcat_blog{{ $subVal->id }} <?php echo (isset($i) && $i==1)?"active":''; ?>">
                     <div class="item">
                        <div class="blog-main-slider">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="blog-main">
                                    <div class="blog-image">
                                       <?php
                                          if (isset($blogs[0]->blog_image) && $blogs[0]->blog_image!='' && file_exists(asset('/').'public/blog_img/'.$blogs[0]->blog_image)) {
                                              $latest_blog_image = $blogs[0]->blog_image;
                                          }else{
                                              $latest_blog_image = 'no-blog.png';
                                          }
                                          $latest_title = isset($blogs[0]->blog_title)?$blogs[0]->blog_title:'';
                                          $blog_slug = isset($blogs[0]->blog_slug)?$blogs[0]->blog_slug:'';
                                          ?>
                                       <a href="{{url('blog/'.$blog_slug)}}"><img src="{{ asset('/')}}public/blog_img/{{$latest_blog_image}}" alt="Blog-Image"></a>
                                    </div>
                                    <div class="blog-section">
                                       <div class="blog-title">
                                          <h5 class="title">{{$latest_title}}
                                          </h5>
                                       </div>
                                       <?php 
                                          $lat_user = DB::table('users')->select('*')->where("users.id", "=", isset($blogs[0]->created_by)?$blogs[0]->created_by:0)->first();
                                          $lat_name = (isset($lat_user->first_name)?$lat_user->first_name:'').' '.(isset($lat_user->last_name)?$lat_user->last_name:'');
                                          $lat_date ="";
                                          if (isset($latest_blog->created_at) && $latest_blog->created_at!='') {
                                            $lat_date = date("F d,Y", strtotime($latest_blog->created_at));
                                          } 
                                           
                                          if (isset($lat_user->profile_image) && $lat_user->profile_image!='' && file_exists(public_path() . '/user_img/' . $lat_user->profile_image)) {
                                            $lat_user_Path = asset('/public/user_img/' . $lat_user->profile_image);
                                          } else {
                                            $lat_user_Path = asset('/public/assets/image/profile.png');
                                          }
                                           /*END SELCT SINGLE LATEST CATEGORY*/
                                         ?>
                                       <div class="blog-author media">
                                          <div class="media-left author-image">
                                             <img src="{{$lat_user_Path}}" style="width: 50px;height: 50px;border-radius:50px; " class="media-object" alt="author">
                                          </div>
                                          <div class="media-body">
                                             <span class="author-title author-span">Posted by {{$lat_name}}
                                             </span>
                                             <span class="author-span">{{$lat_date}}
                                             </span>           
                                          </div>
                                       </div>
                                       <div class="blog-content">
                                          <?php
                                             if(isset($blogs[0]->blog_heading) && $blogs[0]->blog_heading==''){
                                                $blog_heading = "No Blog Detail";
                                                $blog_heading1 = "No Blog Detail";
                                             }else{
                                                 $blog_heading1 = isset($blogs[0]->blog_description)?$blogs[0]->blog_description:'';
                                                 $blog_heading='';
                                                 if (isset($blogs[0]->blog_heading) && $blogs[0]->blog_heading!='') {
                                                   $blog_heading = substr($blogs[0]->blog_heading, 0, 80) . "...";
                                                 }
                                             }

                                             ?>
                                          <div style="display:none;" class="hide_{{ isset($blogs[0]->id)?$blogs[0]->id:0 }}">{{$blog_heading1}}</div>

                                          <p class="content more_content div_{{isset($blogs[0]->id)?$blogs[0]->id:0}}" id="div_{{isset($blogs[0]->id)?$blogs[0]->id:0}}"> {{$blog_heading}}
                                          </p>
                                       </div>
                                       <div class="blog-button">
                                          <a href="{{url('blog/'.$blog_slug)}}" id="more_{{isset($blogs[0]->id)?$blogs[0]->id:0}}" title="Read More" class="btn btn-primary read_more">Read more
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 sidebar-tab">
                              @foreach($blogs as $blog)
                                <?php if(isset($blogs[0]->id) && $blogs[0]->id==$blog->id){ continue; } ?> 
                                <div class = "side-blog-list">
                                  <?php $userVal = DB::table('users')->select('*')->where("users.id", "=", $blog->created_by)->first();
                                    $user_name = (isset($userVal->first_name)?$userVal->first_name:'').' '.(isset($userVal->last_name)?$userVal->last_name:'');
                                    if (isset($userVal->profile_image)  && $userVal->profile_image!='' && file_exists(asset('/public/user_img/' . $userVal->profile_image))) {
                                      $userImagePath = asset('/public/user_img/' . $userVal->profile_image);
                                    } else {
                                      $userImagePath = asset('/public/assets/image/profile.png');
                                    }
                                   
                                    if(empty($blog->created_at)){
                                      $bDate = "";
                                    }else{
                                      $bdate = date("F d,Y",strtotime($blog->created_at));
                                    }?>

                                    <?php if (isset($blog->blog_image) && $blog->blog_image!='' && file_exists(public_path() . '/blog_img/' . $blog->blog_image)) {
                                      $blog_img_path = asset('public/blog_img/' . $blog->blog_image);
                                    } else {
                                      $blog_img_path = asset('/public/blog_img/no_img.jpg');
                                    } ?>
                                    <div class ="row">
                                       <div class = "col-lg-5 col-sm-5 col-xs-6">
                                          <div class = "sidebar-img">
                                             <a href="{{url('blog/'.$blog->blog_slug)}}"><img src = "{{$blog_img_path}}" style="width: 100px; height: 100px;" alt = "{{$blog->blog_image}}"></a>
                                             <input type="hidden" value="{{$sub->id}}">
                                          </div>
                                       </div>
                                       <div class = "col-lg-7 col-sm-7col-xs-6">
                                          <div class = "blog-author media">
                                             <div class ="media-left">
                                                <img src = "{{$userImagePath}}" style="height: 50px;width: 50px; border-radius: 50px;" class = "media-object">
                                             </div>
                                             <div class = "media-body">
                                                <span class = "author-title">Posted by {{$user_name}}
                                                </span>
                                             </div>
                                          </div>
                                          <div class = "icon-date">
                                             <i class = "icon icon-clock">
                                             </i>
                                             <span>{{$bdate}}
                                             </span>
                                          </div>
                                          <div class = "sidebar-section-title">
                                             <?php
                                                if (!empty($blog->blog_heading)) {
                                                   $blogsHeading = substr($blog->blog_heading, 0, 80) . "...";
                                                } else {
                                                   $blogsHeading = "No Blog Detail";
                                                }
                                                ?>
                                             <a href = "{{url('blog/'.$blog->blog_slug)}}" class = "sidebar-blog-title"title = "">{{$blogsHeading}}
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 @endforeach
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                @endif
                <?php $i++; ?>
                @endforeach
              </div>  
            </div>
         </div>
         @if($odd == 1)
         <div class = "col-lg-4 col-sm-12">
            <div class = "sidebar-tab">
               <div class = "tab">
                  <div class = "tablinks" onclick = "openCity(event, 'latest')" id = "defaultOpen">Latest
                  </div>
                  <div class = "tablinks" onclick = "openCity(event, 'popular')">Popular
                  </div>
                  <div class = "tablinks" onclick = "openCity(event, 'featured')">Featured
                  </div>
                  <div class = "tablinks" onclick = "openCity(event, 'tranding')">Tranding
                  </div>
               </div>
               <div id = "latest" class = "tabcontent">
                  <div class = "side-blog-list">
                     <div class = "row">
                        <div class = "col-lg-5 col-sm-5 col-xs-6">
                           <div class = "sidebar-img">
                              <img src = "{{ asset('/public/assets/image/sidebarimg1.jpg') }}" alt = "blog-1">
                           </div>
                        </div>
                        <div class = "col-lg-7 col-sm-7 col-xs-6">
                           <div class = "blog-author media">
                              <div class = "media-left">
                                 <img src = "{{ asset('/public/assets/image/author-1.png') }}" class = "media-object">
                              </div>
                              <div class = "media-body">
                                 <span class = "author-title">Posted by Delowar Hossain
                                 </span>
                              </div>
                           </div>
                           <div class = "icon-date">
                              <i class = "icon icon-clock">
                              </i>
                              <span>25April 2017, 1:21 PM
                              </span>
                           </div>
                           <div class = "sidebar-section-title">
                              <a href = "javascript:;" class = "sidebar-blog-title" title = "">10 Famous Guys Who Are Reality Life Superheroes
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class = "side-blog-list">
                     <div class = "row">
                        <div class = "col-lg-5 col-sm-5">
                           <div class = "sidebar-img">
                              <img src = "{{ asset('/public/assets/image/sidebarimg2.jpg') }}" alt = "blog-1">
                           </div>
                        </div>
                        <div class = "col-lg-7 col-sm-7">
                           <div class = "blog-author media">
                              <div class = "media-left">
                                 <img src = "{{ asset('/public/assets/image/author-1.png') }}" class = "media-object">
                              </div>
                              <div class = "media-body">
                                 <span class = "author-title">Posted by Delowar Hossain
                                 </span>
                              </div>
                           </div>
                           <div class = "icon-date">
                              <i class = "icon icon-clock">
                              </i>
                              <span>25 April 2017, 1:21 PM
                              </span>
                           </div>
                           <div class = "sidebar-section-title">
                              <a href = "javascript:;" class = "sidebar-blog-title" title = "">10 Famous Guys Who Are Reality Life Superheroes
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class = "side-blog-list">
                     <div class = "row">
                        <div class = "col-lg-5 col-sm-5">
                           <div class = "sidebar-img">
                              <img src = "{{ asset('/public/assets/image/sidebarimg3.jpg') }}" alt = "blog-1">
                           </div>
                        </div>
                        <div class = "col-lg-7 col-sm-7">
                           <div class = "blog-author media">
                              <div class = "media-left">
                                 <img src = "{{ asset('/public/assets/image/author-1.png') }}" class = "media-object">
                              </div>
                              <div class = "media-body">
                                 <span class = "author-title">Posted by Delowar Hossain
                                 </span>
                              </div>
                           </div>
                           <div class = "icon-date">
                              <i class = "icon icon-clock">
                              </i>
                              <span>25 April 2017, 1:21 PM
                              </span>
                           </div>
                           <div class = "sidebar-section-title">
                              <a href = "javascript:;" class = "sidebar-blog-title" title = "">10 Famous Guys Who Are Reality Life Superheroes
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class = "side-blog-list">
                     <div class = "row">
                        <div class = "col-lg-5 col-sm-5">
                           <div class = "sidebar-img">
                              <img src = "{{ asset('/public/assets/image/sidebarimg4.jpg') }}" alt = "blog-1">
                           </div>
                        </div>
                        <div class = "col-lg-7 col-sm-7">
                           <div class = "blog-author media">
                              <div class = "media-left">
                                 <img src = "{{ asset('/public/assets/image/author-1.png') }}" class = "media-object">
                              </div>
                              <div class = "media-body">
                                 <span class = "author-title">Posted by Delowar Hossain
                                 </span>
                              </div>
                           </div>
                           <div class = "icon-date">
                              <i class = "icon icon-clock">
                              </i>
                              <span>25 April 2017, 1:21 PM
                              </span>
                           </div>
                           <div class = "sidebar-section-title">
                              <a href = "javascript:;" class = "sidebar-blog-title" title = "">10 Famous Guys Who Are Reality Life Superheroes
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id = "popular" class = "tabcontent">
               </div>
               <div id = "featured" class = "tabcontent">
               </div>
               <div id = "tranding" class = "tabcontent">
               </div>
            </div>
         </div>
         @endif
      </div>
      <?php
         $even = $even + 2;
         $odd = $odd + 2;
         ?>
      
      @endforeach
      @endif
   </div>
</section>
<input type="hidden" id="even" value="{{$even-2}}">
<input type="hidden" id="odd" value="{{$odd-2}}">


<script type="text/javascript">
  /*-----------------------------------START READ MORE SCRIPT---------------------*/
  /*$(document).on("click",".read_more",function(){
      $(this).hide();
      var id = $(this).attr("id");
      var split_array = id.split("_");
      var blog_id = split_array[1];
      var hide_div = $(".hide_"+blog_id).text();
      var div_id = ".div_"+ blog_id;
      $(div_id).html(hide_div);
  });*/
/*-----------------------------------END READ MORE SCRIPT---------------------*/

/*-----------------------------------START SUB CAT SCRIPT---------------------*/
$(document).on("click",".sub_cat",function(){
      var id = $(this).attr("data-id");
      // Get the element with id="defaultOpen" and click on it
  });

function openCat(id,catName) {
    $(".old_sub_cat"+id).removeClass('active');
    $(".subcat_blog"+id).removeClass('active');
    $("."+catName).addClass('active');
    $("#"+catName).addClass('active');
    $("#"+catName).style.display = "block";
}
/*-----------------------------------END SUB CAT SCRIPT---------------------*/
</script>
@endsection