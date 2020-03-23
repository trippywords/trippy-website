<?php

use App\Blog;

use App\UserGenrePreference;

use App\Userpreferance;

use App\Genre;

use App\Notifications;

use App\Usernotification;

use App\Comments;

use App\Connection;

use App\Followers;

use App\User;

use Carbon\Carbon;

use App\Settings;

use App\Smtp;

use App\ParentGenres;

use App\ChildGenres;

function pr($data){

    echo "<pre>";

    print_r($data);

    echo "</pre>";

}

function getBlogsCountByUser(){

    $count = Blog::get()->where('created_by',Auth::user()->id)->where('blog_status',1)->where('is_delete',0)/*->where('blog_status',1)*/->toArray();
    return count($count);
}

function getDraftsBlogsCountByUser(){
    $count = Blog::get()->where('created_by',Auth::user()->id)->where('blog_status',2)->where('is_delete',0)->toArray();
    return count($count);
}

function getUsersRecentBlogs(){
    $latest_blogs = DB::table('blogs')->where('created_by',Auth::user()->id)->where('blog_status',1)->where('is_delete',0)->orderBy('id', 'DESC')->limit(4)->get();
    return $latest_blogs;
}
function getFollowerscount($userid){
    $count = Followers::join('users','user_following.user_id' , '=' ,'users.id')->where("user_following.follower_id","=",$userid)->where('user_following.is_delete','=',0)->count();
    return $count;
 }
function getUsergenres(){
    
    $selectedgenre= UserGenrePreference::select('child_genres.id','child_genres.child_genre_name as name')
                    ->join('child_genres','child_genres.id','=','user_genre_preferences.child_preference_id')
                    ->where('user_id','=',Auth::user()->id)
                    ->where('child_genres.is_deleted','=',0)
                    ->where('is_published','=',1)
                    ->where('user_genre_preferences.is_deleted','=','0')
                    
                    ->get();        

    $string='';

    $i=1;

    $first='<div><span>';

    $plus_icon=' <a href="javascript:;" class="plus_minus_icon" id="plus_icon"><div class="col-sm-9 col-md-8 col-lg-6" id="plus_icon_div">

               <i class="fa fa-plus"></i>  

            </div></a>';

    $minus_icon=' <a href="javascript:;" class="plus_minus_icon" id="minus_icon"><div class="col-sm-6 col-md-4 col-lg-3" id="minus_icon_div">

            <i class="fa fa-minus"></i> 

        </div></a>';

    $last = '<div id="last_nodes" style="display:none;"><span>';

    foreach ($selectedgenre as $s)

    {

        if ($i<=3){

            $first.=$s->name.",<br>";

        }   

        elseif ($i>3)

        {

            $last.=$s->name.",<br>";

        }

        $i++;

    }

    if(count($selectedgenre)>3){

        $string .= rtrim($first,',<br>').'</span>'.$plus_icon.'</div>'.rtrim($last,',<br>').'<span>'.$minus_icon.'</div>';

    }else{

        $string .= rtrim($first,',<br>').'</div>';

    }
    if (count($selectedgenre) <= 0) {
        $string = '<div class="stars">No Genres Selected</div>';
    }
    echo $string;  

}

function getParrentgenres(){

   $parrentgenres=ParentGenres::getComposeGenre();
    return $parrentgenres;

}


function getChildgenres($pgenid){

    $childgenres= ChildGenres::select('id','child_genre_name')->where('is_deleted','=',0)->where('is_published','=',1)->where('parent_genre_id','=',$pgenid)->get();

    return $childgenres;

}

function isSelectedPgenres($selgenid)

{
    $selectedpgen_count= UserGenrePreference::where('user_id','=',Auth::user()->id)->where('parent_preference_id','=',$selgenid)->where('is_deleted','=',0)->count();
    
    return $selectedpgen_count;    
}

function isSelectedCgenres($selgenid)

{
    $selectedcgen_count= UserGenrePreference::where('user_id','=',Auth::user()->id)->where('child_preference_id','=',$selgenid)->where('is_deleted','=',0)->count();
    
    return $selectedcgen_count;    

}

function autoSelectparrent($selectedsubid){

        $parrent_id= Genre::select('parent_genre_id')->where('id','=',$selectedsubid)->first();

        if($parrent_id->parent_genre_id!='0')

        {

            $getallchild=Genre::select('id','parent_genre_id')->where('is_deleted','=','N')->where('is_published','=','Y')->where('parent_genre_id','=',$parrent_id->parent_genre_id)->where('parent_genre_id','!=',0)->get();

            foreach($getallchild as $all){

                $checkSelected[$all->id]=isSelectedgenres($all->id);

            }

            if(array_sum($checkSelected)==0)

            {

                Userpreferance::where('user_id','=',Auth::user()->id)->where('preference_id','=',$parrent_id->parent_genre_id)->update(['is_delete'=>1]);

                //off

                $data['swstatus']=0;

                $data['parrent_id']=$parrent_id->parent_genre_id;

                return $data;

            }else{

                Userpreferance::where('user_id','=',Auth::user()->id)->where('preference_id','=',$parrent_id->parent_genre_id)->update(['is_delete'=>0]);

                //on

                $data['swstatus']=1;

                $data['parrent_id']=$parrent_id->parent_genre_id;

                return $data;

            }

        }       

        

}

function getNotification_status($notificationid){

    $user_notifications= Usernotification::select('notification_status')->where('user_id','=',Auth::guard('web')->user()->id)->where('notification_id','=',$notificationid)->first();

    if($user_notifications!=null && $user_notifications->notification_status!=0){    

        return $user_notifications->notification_status;    

    }else{

        return 0;

    }

}

function getCommentscount($blog_id){    

    $count= Comments::where('blog_id','=',$blog_id)->where('is_delete','=','0')->count();    

    return $count;

}

function getRecentToppost()

{

    $recent_blogs= Blog::join('users','blogs.created_by','=','users.id')->where('blogs.blog_status',1)->where('blogs.is_delete','=','0')->where('users.is_verified','=',1)->where('users.is_delete','=','0')->orderBy('blogs.id', 'DESC')->limit(4)->get();

    return $recent_blogs;

}

function checkConnectionReqStatus($user_id,$connection_id){

    $return=Connection::join('users','user_connection.user_id','=','users.id')->where("connect_user_id",'=',$user_id)->where("user_id","=",$connection_id)->where('users.is_verified','=',1)->where('users.is_delete','=','0')->where('user_connection.is_delete',"=",0)->first();

        if( $return!=null) {

            return (isset($return->is_request) && intval($return->is_request) ==1)?1:0;         

        } else {
            // $return1=Connection::select('is_block')->where("user_id",'=',$user_id)->where("connect_user_id","=",$connection_id)->first();
  
            // if ($return1!=null && $return1->is_block==0) {
            //     return 2;
            // }
            return 2;        

        }

    }

function checkConnectionStatus($user_id,$connection_id){

    $return=Connection::join('users','user_connection.connect_user_id','=','users.id')->where("user_id",'=',$user_id)->where("connect_user_id","=",$connection_id)->where('users.is_verified','=',1)->where('users.is_delete','=','0')->where('user_connection.is_delete',"=",0)->first();
        if($return!=null)
        {
            return (isset($return->is_request) && intval($return->is_request) ==1)?1:0;        
        }else{
            return 2;
        } 
    }

function checkFollowerStatus($user_id,$follower_id){
    $return= Followers::join('users','user_following.follower_id','=','users.id')->where("user_id",'=',$user_id)->where("follower_id","=",$follower_id)->where('users.is_verified','=',1)->where('user_following.is_delete',0)->where('users.is_delete','=','0')->first();
    if($return!=null)
    {
        return (isset($return->is_delete) && intval($return->is_delete) ==0)?0:1;        
    }else{
        return 1;
    }        
}

function getUserdetailbyid($user_id){

    $userdata=User::select('*')->where("id","=",$user_id)->first();

    return $userdata;

}

function gethumandate($datetime, $full = false){
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : ' just now';

}
function getFollowercount($userid){

    $count=Followers::join('users','user_following.follower_id','=','users.id')->where("user_following.follower_id","=",$userid)->where('user_following.is_delete','=',0)->count();

    return  $count;    

}

function getConnection($user_id,$connection_id){
    if (isset($user_id) && intval($user_id) > 0 && isset($connection_id) && intval($connection_id) > 0) {
       $return=Connection::join('users','user_connection.connect_user_id','=','users.id')->where("user_id",'=',$user_id)->where("connect_user_id","=",$connection_id)->where('users.is_verified','=',1)->where('users.is_delete','=','0')->where('user_connection.is_delete',"=",0)->first();
        return  $return;    
    }else{
        return array();
    }    
}

function getConnectioncount($userid){

    $count= DB::select("SELECT uc.* FROM `user_connection` as uc WHERE uc.`connect_user_id`=$userid and uc.is_request=0 and uc.`is_delete`=0 and (SELECT `id` FROM `user_connection` where user_id=$userid and uc.`user_id`=user_connection.`connect_user_id` and is_request=0 and `is_delete`=0 GROUP BY `user_id` ) is not null");

    return  count($count);    

}

function getParentGenreInfo($id){
   
    $data = ParentGenres::find($id);

    if($data){

        return $data->parent_name;

    }else{

        return "";

    }

}

function getParentGenreSlug($id){
    $data = ParentGenres::find($id);
    if($data){
        return $data->id;
    }else{
        return "";
    }
}


function getBlogstatus($id){

    if($id != 1){

        return "Draft";

    } else {

        return "Publish";

    }

}

function getLimitofsummery(){

  $length= Settings::select('summerylength')->first();  

  return $length->summerylength;

}

function getTags($blogid)

{

    $blogdata= Blog::select('*')->where('id','=',$blogid)->where('is_delete','=','0')->first();

    return $user_tags=explode(',', $blogdata->tags);

}

function getBlogDetails($blogid)

{

    $blogdata=Blog::where('id','=',$blogid)->first();

    if($blogdata==null)

    {

        $blogdata=array();

    }

    return $blogdata;

}

function getblogGenre($id){
    $blogArray = DB::table('blogs')->join('users','blogs.created_by','=','users.id')->where('blogs.blog_status','=','1')->where('blogs.is_deleted','=','0')->where("blogs.blog_genre", "=", $id)->where('users.is_verified','=',1)->where('users.is_delete','=','0')->orderBy('blogs.id','desc')->first();
    if(empty($blogArray))
    {
        $blogArray=array();
    }
    return $blogArray;
}

function getUserById($id){
    $userData= User::where('id','=',$id)->first();
    if($userData==null)
    {
        $userData=array();
    }
    return $userData;
}

function getSubcategoryByParent($id){
        $sub_cat = DB::table('genres')
                ->select('*')
                ->where('genres.parent_genre_id', '=', $id)
                ->where('genres.is_deleted', '=', 'N')
                ->where('genres.is_published', '=', 'Y')
                ->orderByRaw('created_at DESC')
                ->get()->toArray();
        return $sub_cat;       
}

function getSettings()
{
    $links = Settings::first();
    return $links;
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
function getData(){
    $user_followers = Followers::join('users','user_following.user_id' , '=' ,'users.id')->where("user_following.follower_id","=",Auth::guard('web')->user()->id)->where('user_following.is_delete','=',0)->get();
    return $user_followers->toArray();
}

function getGenres($user_id=null){
    if (isset($user_id) && intval($user_id) > 0) {
        $selectedgenre= Genre::select('user_preferences.preference_id','genres.*')->leftjoin('user_preferences','user_preferences.preference_id','=','genres.id')->where('user_preferences.user_id','=',$user_id)->where('genres.is_deleted','=','N')->where('genres.is_published','=','Y')->where('parent_genre_id','=',0)->where('user_preferences.is_delete','=',0)->distinct('preference_id')->get();
    }else{
        $selectedgenre= Genre::select('user_preferences.preference_id','genres.*')->leftjoin('user_preferences','user_preferences.preference_id','=','genres.id')->where('genres.is_deleted','=','N')->where('genres.is_published','=','Y')->where('parent_genre_id','=',0)->distinct('user_preferences.preference_id')->get();
    }
    return $selectedgenre;
}

  
    function getChildPreferencesByparent($user_id,$parent_genre_id){
        $count = UserGenrePreference::join('child_genres','child_genres.id','=','user_genre_preferences.child_preference_id')
        ->where('user_genre_preferences.user_id','=',$user_id)
        ->where('child_genres.is_deleted','=',0)
        ->where('child_genres.is_published','=',1)
        ->where('child_genres.parent_genre_id','=',$parent_genre_id)
        ->where('user_genre_preferences.is_deleted',0)->count();
        return $count;
    }


    function getDays($date=null){
        if (isset($date) && $date!='') {
            $date_two = date('Y-m-d H:i:s');
            $date1 = new DateTime($date_two);
            $d_two = new DateTime($date);
            $date2 = $date1->diff($d_two);
            $years = $date2->y;
            $months = $date2->m;
            $days = $date2->d;
            $hours = $date2->h;
            $minutes = $date2->i;
            $seconds = $date2->s;
            if (isset($years) && intval($years) > 0) {
                return (isset($years) && intval($years) > 1)?$years.' years ago':$years.' year ago';
            }elseif (isset($months) && intval($months) > 0) {
                return (isset($months) && intval($months) > 1)?$months.' months ago':$months.' month ago';
            }elseif (isset($days) && intval($days) > 0) {
                return (isset($days) && intval($days) > 1)?$days.' days ago':$days.' day ago';
            }elseif (isset($hours) && intval($hours) > 0) {
                return (isset($hours) && intval($hours) > 1)?$hours.' hours ago':$hours.' hour ago';
            }elseif (isset($minutes) && intval($minutes) > 0) {
                return (isset($minutes) && intval($minutes) > 1)?$minutes.' minutes ago':$minutes.' minute ago';
            }elseif (isset($seconds) && intval($seconds) > 0) {
                return (isset($seconds) && intval($seconds) > 1)?$seconds.' seconds ago':$seconds.' second ago';
            }else{
                return 'Just Now';
            }
        }else{
            return 'Just Now';
        }
        
    }

    function getUsers(){
        $userdata = [];
        if (Auth::user()) {
            $users=User::select('*')->where(['is_delete'=>'0','is_verified'=>1])->where('id','!=',Auth::user()->id)->get();
        }else{
            $users=User::select('*')->where(['is_delete'=>'0','is_verified'=>1])->get();
        }
        
        if (!empty($users)) {
            foreach ($users as $user) {
                $userdata[] =  array('id'=>$user->id,'name'=>$user->name,'email'=>$user->email);
            }
        }
        return json_encode($userdata);

    }

    function formatedComment($content=null,$blogData=[]){
        if (isset($content) && $content!=null) {
            preg_match_all ("/@(.*) /U", $content, $pat_array);
            $users = $userIds = $userNames = [];
            if (!empty($pat_array[1])) {
                $implodeArr = "'" . implode ( "', '", $pat_array[1] ) . "'";
                $users = User::select('id','email',DB::raw("CONCAT(`first_name`,' ',`last_name`) AS user_name"),'name')->distinct()->whereIn('name', $pat_array[1])->orderByRaw('FIELD(name, '.$implodeArr.')')->get();
                if (!empty($users)) {
                    foreach ($users as $user) {
                        $userIds[] = '@'.$user->id.' ';
                        $userNames[] = '@'.$user->name;
                        if ($blogData!=null) {
                            if (isset($blogData->created_by) && intval($blogData->created_by) > 0 && $blogData->created_by!=Auth::user()->id) {
                                $usernotification = Usernotification::where(['user_id'=>$blogData->created_by,'notification_id'=>3,'notification_status'=>'1'])->first();
                                if($usernotification!=null) {
                                    $sender_name = (isset(Auth::user()->first_name)?Auth::user()->first_name:'').' '.(isset(Auth::user()->last_name)?Auth::user()->last_name:'');
                                    $to_u = $user->name . "<" .$user->email. ">";
                                    $subject_u = 'TrippyWords - Comment Mention Notification';
                                    $message_u = view('emails.mention_notifications',['reciever_name'=>$user->user_name,'sender_name'=>$sender_name,'comments'=>$content,'blog_name'=>isset($blogData->blog_title)?$blogData->blog_title:'','blog_slug'=>isset($blogData->blog_slug)?$blogData->blog_slug:'']);
                                    $headers_u = "MIME-Version: 1.0\r\n";
                                    $headers_u .= "Content-type: text/html; charset: utf8\r\n";
                                    $headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";
                                    //end of user email code
                                    if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
                                    }
                                } 
                            }
                        }        
                    }
                }
                $content = getRegExInContent($content,$userIds);
                return $content;
            }else{
                return $content;
            }
        }
        return $content;
    }

    // return the comment with replacing regular expression of tagged user from thier data

    function getRegExInContent($content=NULL,$replacements=[]){

        return  preg_replace_callback('/@(.*) /U', function($matches) use (&$replacements) {
            return array_shift($replacements);
        }, $content);
        
    }

    // return the comment with regular expression of tagged user 

    function setRegExInContent($content=NULL){
        $regex = '/@(0|[1-9][0-9]*) /U';
        $replacements=[];
        preg_match_all ($regex, $content, $pat_array);
        if (!empty($pat_array[1])) {
            foreach ($pat_array[1] as $key => $patArr) {
                //$replacements[] = "<a href='".get_user_profile_url($patArr)."' target='_blank'>".get_user_profile_name($patArr)."</a> ";
                $replacements[] = '';
            }
            return  preg_replace_callback($regex, function($matches) use (&$replacements) {
                return array_shift($replacements);
            }, $content);
        }else{
            return $content;
        }
        
    }

    function get_user_profile_url($user_id=NULL){
        if (isset($user_id) && intval($user_id) > 0) {
            $user = User::where('id',$user_id)->first();
            return $url = url('profile/'.$user->name);
        }
        return "javascript:void(0);";
    }
    function get_user_profile_name($user_id=NULL){
        if (isset($user_id) && intval($user_id) > 0) {
            $user = User::where('id',$user_id)->first();
            return '@'.$user->name;
        }
        return '';
    }
?>