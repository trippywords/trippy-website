<?php



/*

  |--------------------------------------------------------------------------

  | Web Routes

  |--------------------------------------------------------------------------

  |

  | Here is where you can register web routes for your application. These

  | routes are loaded by the RouteServiceProvider within a group which

  | contains the "web" middleware group. Now create something great!

  |

 */


//error_reporting(0);


Route::get('/clear', function() {        

    $exitCode6 = Artisan::call('cache:clear');
    $exitCode6 = Artisan::call('view:clear');
    $exitCode6 = Artisan::call('route:clear');
    $exitCode6 = Artisan::call('config:cache');
    echo "Configed Now";
    exit(); 
    return '<h1>Cache facade value cleared</h1>';

});

Auth::routes();

//Landing Page view
//Route::get('/','Front\FrontController@index');


//Home Controller view
//  Route::get('/index', 'HomeController@Home');

Route::get('/', 'HomeController@Home')->name('home');

//logout for user
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::any('signup', 'RegisterController@signup')->name('signup');
Route::post('demoemail','RegisterController@emailvalidate')->name('demoemail');

Route::get('email', 'RegisterController@email')->name('email');
Route::get('username', 'RegisterController@username')->name('username');

Route::post('forgetpass', '\App\Http\Controllers\Auth\LoginController@forgetPassword');

Route::get('resetpassword/{key}', '\App\Http\Controllers\Auth\LoginController@resetPassword');

Route::post('updatepass', '\App\Http\Controllers\Auth\LoginController@updatePassword');

Route::post('newsletter','NewsletterController@sendNewsletter')->name("newsletter");



Route::get('accountactivate/{user_id}/{key}', 'RegisterController@verifyUser')->name('verify_user');

Route::get('emailactivate/{user_id}/{key}', 'RegisterController@verifyProfile')->name('verify_Profile');

Route::get('successverify/{status}/{type}', 'RegisterController@successVerify')->name('success_verify');



Route::get('/login','HomeController@index')->name('login');

//Route::post('ajax-login','HomeController@ajaxLogin')->name('ajax-login');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/aboutus', 'HomeController@about')->name('home');

Route::get('/contactus', 'HomeController@contact')->name('contactus');

Route::get('/thankyou', 'HomeController@thankyou')->name('thankyou');



Route::post('/contactussend', 'HomeController@contactussend')->name('contactussend');

Route::get('/account-details', 'ProfileController@accountdetails')->name('account-details');

Route::post('updatedescription', 'ProfileController@update_description')->name('update_description');

Route::post('updateprofileimage', 'ProfileController@update_profile_image')->name('update_profile_image');

Route::post('updatename', 'ProfileController@update_name')->name('updatename');

Route::post('updatefname', 'ProfileController@update_fname')->name('update_fname');

Route::post('updatelname', 'ProfileController@update_lname')->name('update_lname');

Route::post('updateemail', 'ProfileController@update_email')->name('update_email');

Route::post('updatepassword', 'ProfileController@update_password')->name('update_password');

Route::post('checkOldpassword', 'ProfileController@checkOldpassword');

Route::post('/follower_remove', 'DashboardController@removeFollower')->name('follower_remove');
Route::get('followers', 'ProfileController@accountdetails')->name('Followers');
Route::get('/follower_ascending' , 'DashboardController@ascendingFollower')->name('follower_ascending');
Route::get('/follower_descending' , 'DashboardController@descendingFollower')->name('follower_descending');




Route::get('login/facebook','ProfileController@facebookLogin')->name('fblogin');

Route::get('/callback','ProfileController@callback')->name('callback');

Route::get('/twittercallback','ProfileController@twittercallback')->name('twittercallback');

Route::get('/following_ascending', 'DashboardController@ascendingfollowing')->name('following_ascending');

Route::get('/following_descending', 'DashboardController@descendingfollowing')->name('following_descending');

Route::get('oAuth/fbLogin','ProfileController@fbLogin')->name('fbLogin');

/*SOCIAL*/
Route::get('auth/{provider}', 'ProfileController@redirectToProvider')->name('connect_fb');
Route::get('auth/{provider}/callback', 'ProfileController@handleProviderCallback');
Route::get('connect/{provider}/callback', 'ProfileController@handleProviderCallbackconnect');

Route::post('disconnect-fb', 'ProfileController@disconnectFB')->name('disconnect_fb');
Route::post('disconnect-tw', 'ProfileController@disconnectTW')->name('disconnect_tw');
/*END SOCIAL*/


Route::get('login/twitter','ProfileController@twitterLogin')->name('twitterlogin');

Route::get('profile/{username}','ProfileController@userProfile')->name('userprofile');

//Route::get('blog/{slug}', 'BlogController@blogDetailpage');

Route::get('blog/{slug}', 'BlogController@userBlogDetailpage')->name('userblog');
Route::get('blogs/{id}', 'BlogController@userBlogDetailById')->name('userblog');
Route::get('blogi', 'BlogController@index');

Route::get('/preference-list', 'ProfileController@accountdetails')->name('preference-list');

Route::get('/connections', 'ProfileController@accountdetails')->name('connections');

Route::post('/connection_remove', 'ProfileController@removeconnection')->name('connection_remove');

Route::get('/notification-list', 'ProfileController@accountdetails')->name('notification-list');

Route::get('/notifications', 'ProfileController@accountdetails')->name('notifications');

Route::get('/bookmarks', 'ProfileController@accountdetails')->name('bookmarks');

Route::get('/social', 'ProfileController@accountdetails')->name('social');

Route::get('/following', 'ProfileController@accountdetails')->name('following');

Route::post('/following_remove', 'ProfileController@removefollowing')->name('following_remove');

Route::post('/getConnDetails', 'ProfileController@getConnDetails')->name('getConnDetails');

Route::post('/blogbookmark', 'BlogController@blogBookmark')->name('blogbookmark');

Route::post('/removebookmark', 'BlogController@removeBookmark')->name('removebookmark');

Route::post('/uploadEditorImage', 'BlogController@uploadEditorImage')->name('uploadEditorImage');
Route::post('/uploadEditorVideo', 'BlogController@uploadEditorVideo')->name('uploadEditorVideo');

Route::resource('blog-category', 'BlogCategoryController',['names'=>'blog_category']);

Route::post('/getFollowings', 'ProfileController@getFollowings')->name('getFollowings');
Route::post('/getFollowers' , 'ProfileController@getFollowers')->name('getFollowers');
Route::post('/getNotifications' , 'ProfileController@getNotifications')->name('getNotifications');
Route::post('/getConnectionRequest' , 'ProfileController@getConnectionRequest')->name('getConnectionRequest');
Route::any('user_facebook_id','ProfileController@user_facebook_id')->name('user_facebook_id');

Route::get('/request', 'ProfileController@accountdetails')->name('request');

Route::get('/acceptrequest/{userid}', 'ProfileController@acceptRequest')->name('acceptrequest');

Route::get('/rejectrequest/{userid}', 'ProfileController@rejectRequest')->name('rejectrequest');




//Routes for admin login functionality 
Route::get('admin', 'Admin\AdminController@admin')->name('admin');

Route::post('admin', 'Admin\AdminController@checkLogin')->name('checkLogin');

Route::get('admindashboard', 'Admin\AdminController@Dashboard')->name("admin_dashboard");
//logout for admin
Route::get('adminlogout', 'Admin\AdminController@Logout')->name("admin_logout");



Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::group(['middleware' => ['auth', 'super-admin']], function () {

        // All routes you put here can only be accessible to users with super-admin role

        Route::get('/adminpanel', 'Admin\DashboardController@index')->name('admin-panel');
        Route::get('/adminpanel/comments', 'Admin\DashboardController@comments')->name('admin.comments');


        // Get Data for genre and routes for admin genre management
        //Admin genre management
        Route::get('/adminpanel/genre/getdata', 'Admin\GenreController@getAjaxData')->name('admin-genre.getdata');

        Route::resource('/adminpanel/genre', 'Admin\GenreController', [

            'names' => [

                'index' => 'admin-genre.index',

                'store' => 'admin-genre.store',

                'create' => 'admin-genre.create',

                'show' => 'admin-genre.show',

                'edit' => 'admin-genre.edit',

                'update' => 'admin-genre.update',

                'destroy' => 'admin-genre.destroy'
            ]
        ]);
        Route::get('/adminpanel/genre/{id}/destroy', 'Admin\GenreController@destroy')->name('admin-genre.destroy');



        //Admin parent genre management
        Route::get('/adminpanel/parent-genre/getdata', 'Admin\ParentGenreController@getAjaxData')->name('admin-parent-genre.getdata');

        route::get('/adminpanel/parent-genre','Admin\ParentGenreController@index')->name('admin-parent-genre');

        Route::get('/adminpanel/parent-genre/{id}/show', 'Admin\ParentGenreController@show')->name('admin-parent-genre.show');

         Route::get('/adminpanel/parent-genre/{id}/destroy', 'Admin\ParentGenreController@destroy')->name('admin-parent-genre.destroy');

          Route::get('/adminpanel/parent-genre/create', 'Admin\ParentGenreController@create')->name('admin-parent-genre.create');

          Route::post('/adminpanel/parent-genre', 'Admin\ParentGenreController@store')->name('admin-parent-genre.store');

           Route::get('/adminpanel/parent-genre/edit', 'Admin\ParentGenreController@edit')->name('admin-parent-genre.edit');

           Route::get('/adminpanel/parent-genre/{id}/edit', 'Admin\ParentGenreController@edit')->name('admin-parent-genre.edit');

           Route::post('/adminpanel/parent-genre/{id}/update', 'Admin\ParentGenreController@update')->name('admin-parent-genre.update');


           //Route::get('/adminpanel/parent-genre/getdata', 'Admin\ParentGenreController@getAjaxData')->name('admin-child-genre.getdata');

           //route::get('/adminpanel/parent-genre','Admin\ParentGenreController@index')->name('admin-child-genre');





        //Admin User Management
        Route::get('/adminpanel/users', 'Admin\UserController@index')->name('admin.users');

        Route::get('/adminpanel/users/create', 'Admin\UserController@create')->name('admin.users.create');

        Route::post('/adminpanel/users', 'Admin\UserController@store')->name('admin.users.store'); // for post user data

        Route::get('/adminpanel/users/{id}/edit', 'Admin\UserController@edit')->name('admin.users.edit');

        Route::post('/adminpanel/users/{id}/update', 'Admin\UserController@update')->name('admin.users.update');

        Route::get('/adminpanel/users/{id}/show', 'Admin\UserController@show')->name('admin.users.show');

        Route::get('/adminpanel/users/{id}/destroy', 'Admin\UserController@destroy')->name('admin.users.destroy');

         Route::get('/adminpanel/users/getdata', 'Admin\UserController@getAjaxData')->name('admin.users.getdata');


         //Admin Blog Management
        Route::get('/adminpanel/blog', 'Admin\BlogController@index')->name('admin.blog');

        Route::get('/adminpanel/blog/create', 'Admin\BlogController@create')->name('admin.blog.create');

        Route::post('/adminpanel/blog', 'Admin\BlogController@store')->name('admin.blog.store'); // for post user data

        Route::get('/adminpanel/blog/{slug}/edit', 'Admin\BlogController@edit')->name('admin.blog.edit');

        Route::post('/adminpanel/blog/{slug}/update', 'Admin\BlogController@update')->name('admin.blog.update');

        Route::get('/adminpanel/blog/{slug}/destroy', 'Admin\BlogController@destroy')->name('admin.blog.destroy');

        Route::get('/adminpanel/blog/{slug}/show', 'Admin\BlogController@show')->name('admin.blog.show');

        Route::get('/adminpanel/blog/getdata', 'Admin\BlogController@getAjaxData')->name('admin.blog.getdata');

        Route::post('/adminpanel/blog/update_recommended', 'Admin\BlogController@update_recommended')->name('admin.blog.update_recommended');



        //Admin RecommendedBlog Management
        Route::get('/adminpanel/recommended-blog', 'Admin\RecommendedBlogController@index')->name('admin.recommended-blog');
        
        Route::get('/adminpanel/recommended-blog/create', 'Admin\RecommendedBlogController@create')->name('admin.recommended-blog.create');
        
        Route::post('/adminpanel/recommended-blog', 'Admin\RecommendedBlogController@store')->name('admin.recommended-blog.store'); // for post user data
        
        Route::get('/adminpanel/recommended-blog/{slug}/edit', 'Admin\RecommendedBlogController@edit')->name('admin.recommended-blog.edit');
        
        Route::post('/adminpanel/recommended-blog/{slug}/update', 'Admin\RecommendedBlogController@update')->name('admin.recommended-blog.update');
        
        Route::get('/adminpanel/recommended-blog/{slug}/destroy', 'Admin\RecommendedBlogController@destroy')->name('admin.recommended-blog.destroy');
        
        Route::get('/adminpanel/recommended-blog/{slug}/show', 'Admin\RecommendedBlogController@show')->name('admin.recommended-blog.show');
        
        Route::get('/adminpanel/recommended-blog/getdata', 'Admin\RecommendedBlogController@getAjaxData')->name('admin.recommended-blog.getdata');

        //Admin Contactus Management 
        Route::get('/adminpanel/contactus/getdata', 'ContactusController@getAjaxData')->name('admin.contactus.getdata');

        Route::get('/adminpanel/contactus', 'ContactusController@index')->name('admin.contactus');

        Route::get('/adminpanel/contactus/{id}/destroy', 'ContactusController@destroy')->name('admin.contactus.destroy');


        //Admin Newsletter Management
        Route::get('/adminpanel/newsletter/getdata', 'NewsletterController@getAjaxData')->name('admin.users.getdata');

        Route::get('/adminpanel/newsletter', 'NewsletterController@index')->name('admin.newsletter');

        Route::get('/adminpanel/newsletter/{id}/destroy', 'NewsletterController@destroy')->name('admin.newsletter.destroy');


        //Admin general setting management

        Route::get('/adminpanel/settings', 'Admin\SettingsController@index')->name('admin.settings');

        Route::post('/adminpanel/settings/{id}/update', 'Admin\SettingsController@update')->name('admin.settings.update');


        //Admin SMTP Configuration
        Route::get('/adminpanel/smtp', 'Admin\SmtpController@index')->name('admin.smtp');

        Route::post('/adminpanel/smtp/{id}/update', 'Admin\SmtpController@update')->name('admin.smtp.update');

    });



    Route::group(['middleware' => 'auth'], function () {

        // All routes you put here can be accessible to all authenticated users

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::post('profile/delete_image','DashboardController@delete_image');

        Route::get('/preference', 'DashboardController@preference')->name('preference');        

        Route::post('/saveuserpreference', 'DashboardController@savePreferance')->name('saveuserpreference');

        //parent

        Route::post('/updateupbyid', 'ProfileController@updateUPbyid')->name('updateupbyid');        

        //child

        Route::post('/updateupbycid', 'ProfileController@updateUPbycid')->name('updateupbycid');

        

        Route::get('/profile', 'ProfileController@edit')->name('profile');
        
        Route::post('/getBlogs', 'ProfileController@getBlogs')->name('getBlogs');

        Route::post('/updateunotification', 'ProfileController@updateuNotification')->name('updateunotification');

        Route::post('/updateSocialstatus', 'ProfileController@updateSocialstatus')->name('updateSocialstatus');

        Route::get('people', 'ProfileController@getPeople')->name('people');

        Route::get('connect/{id}', 'ProfileController@connect')->name('connect');

        Route::get('follow/{id}', 'ProfileController@follow')->name('follow');

        Route::post('blockuser','ProfileController@blockUser')->name('blockuser');
        Route::get('blockuserlist','DashboardController@viewBlockUser')->name('blockuserlist');
        Route::post('getBlockUsers','DashboardController@getBlockUsers')->name('getBlockUsers');
        Route::post('unblockuser', 'DashboardController@unblockUser')->name('unblockuser');
    	Route::post('reportuser', 'ProfileController@reportUser')->name('reportuser');

        //Messages

         //Messages
        Route::get('messages', 'MessageController@userMessages')->name('messages');
        Route::get('getmessages', 'MessageController@getMessages')->name('getmessages');
        Route::get('storemessage', 'MessageController@storeMessage')->name('storemessage');
        Route::post('sendMessage', 'MessageController@sendMessage')->name('sendMessage');
    });

});

Route::get('keywords/{keyword}','BlogController@getBlogByKeywords')->name('keywords');  

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', 'RoleController');

    Route::resource('users', 'UserController');

    Route::resource('products', 'ProductController');

    Route::resource('blog', 'BlogController',['names'=>['store'=>'blog.store']]);

   

    Route::get('compose', 'BlogController@create')->name('compose');

    Route::get('blog-edit/{slug}', 'BlogController@edit')->name('editblog');    

    Route::get('draft-edit/{slug}', 'BlogController@edit')->name('editdraft');

    Route::post('updateblog', 'BlogController@update')->name('updateblog');

    Route::any('draft', 'BlogController@viewDraftBlogs')->name('draft');

    Route::get('draft/delete/{id}', 'BlogController@destroy'); 

    Route::get('blog/delete/{id}', 'BlogController@destroy');        

    Route::post('saveblogcomment', 'BlogController@saveBlogcomment')->name('saveblogcomment');

    Route::post('sendMessage', 'MessageController@sendMessage')->name('sendMessage');

     Route::post('draft/delete_multiple/', 'BlogController@delete_multiple_draft')->name('delete_multiple_draft');
    

});
/*Search Blog*/
    //Route::post('blog/search','BlogController@searchBlog');
    /*Search Blog*/
    Route::post('search/people','ProfileController@searchPeople')->name('search/people');
Route::any('genre/blog/{slug}','BlogController@getBlogBygenre')->name('genre.blog');
Route::post('blog/search','BlogController@searchBlog');
Route::get('/clear', function() {        

    $exitCode6 = Artisan::call('cache:clear');

    return redirect('/');

});
Route::get('refreshmessage','MessageController@autoRefresh')->name('refreshmessage');


Route::get('/cache', function() {        

    $exitCode6 = Artisan::call('config:cache');

    return redirect('/');

});

