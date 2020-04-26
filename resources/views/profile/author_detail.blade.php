@extends('layouts.app')
@section('title','Authors')
<?php
/* echo "<pre>";
dd($authorDetail); */
?>

<?php
	// Working with Author details JSON response
	$authorRow = [];
	$authorDetailsRow = json_decode($authorDetail, TRUE);
	if (!empty($authorDetailsRow)) {
    $author = $authorDetailsRow['authorDetail'][0];
    // Fetching author bloga array of objs
    $authorBlogs = $author['authorBlogs'];
  }
?>

@section('content')
<section id="author_details">
  <div class="profile_summary">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 offset-1">
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title">Summary</h2>
                  <p class="card-text">{{$author['authorSummary']}}</p>
                  <!-- <a href="#" class="btn btn-primary">Blogs</a>
                      <a href="#" class="btn btn-secondary">Followers</a>
                      <a href="#" class="btn btn-success">Connections</a> -->
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card hovercard">
                <div class="cardheader">
                  <img src="../public/assets/user-profile/header.jpg" alt="pic_bg" />
                </div>
                <div class="avatar">
                  <img src="{{$author['authorImage']}}" alt="" />
                </div>
                <div class="info">
                  <div class="title">{{$author['authorName']}}</div>
                </div>
                <div class="bottom">
                  <a href="#" class="btn btn-primary">Follow</a>
                  <a href="#" class="btn btn-secondary">Connect</a>
                  <a href="#" class="btn btn-success">Message</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="gener_articles">
  <div class="gener_articles">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2>Genres</h2>
          <a href="#" class="">Lifestyle</a>
          <a href="#" class="">Technology</a>
          <a href="#" class="">Finance</a>
          <a href="#" class="">Business</a>
          <h2>Blogs</h2>
          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="../public/assets/user-profile/nature.jpg" alt="Card image cap" />
            <div class="card-body">
              <div class="title_sub">
                <div class="row">
                  <div class="col">
                    <h6 class="card-title">Nature</h6>
                  </div>
                  <div class="col">
                    <span>Child Genre Title</span>
                  </div>
                </div>
              </div>
              <p class="card-text">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a
                laboriosam. Dicta expedita corporis animi vero voluptate
                voluptatibus possimus, veniam magni quis!
              </p>
              <a href="#" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              <div class="row">
                <div class="col-md-6">
                  Posted on April 18, 2020 by
                  <a href="#">Satya Prasad</a>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                  <ul class="social-network social-circle">
                    <li>
                      <a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                      <a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                    </li>
                    <li>
                      <a href="#" class="icoPinterest" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                    </li>
                    <li>
                      <a href="#" class="icoWhatsapp" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
                    </li>
                    <li>
                      <a href="#" class="icoGoogle" title="Google"><i class="fa fa-google"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

{{-- @foreach($authorBlogs as $blog)
<div>
  {{$blog['title']}}
</div>
@endforeach --}}