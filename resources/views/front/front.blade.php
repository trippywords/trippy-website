<?php 
//print_r($publish_blogs);
//echo "dafsfdsfd";
//print_r($data);

?>
 @include('partials.header')
  @yield('content')  
<html>
    <body>

   <div class="row">
  <div class="leftcolumn">
    <div class="card">
    <?php //print_r($userExist);?>
     @foreach($publish_blogs as $blog)
      <h2>{{ $blog['blog_title']}}</h2>
      <h5>Title description, Dec 7, 2017</h5>
      <div class="fakeimg" style="height:200px;">{{ $blog['blog_image']}}</div>
      <p>{{ $blog['blog_heading']}}</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    @endforeach
    </div>
    </div>
    </div>
    <table>
       
        <tr>
        <td>
        </td>
        <td>
        </td>
        </tr>
        
        </table>
    </body>
</html>
 @include('partials.footer')


         @yield('js')