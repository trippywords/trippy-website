<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\User;
use Spatie\Permission\Models\Role;
use App\ParentGenres;

use DB;
use Hash;
use Illuminate\Support\Facades\Auth;
use URL;

class RecommendedBlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {        
        //$data = Blog::orderBy('id','DESC')->paginate(5);
        return view('admin.recommended_blog.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
         //$data['genres']=DB::table('parent_genres')->select('id','parent_name')->where('is_deleted','=',0)->orderBy('parent_name')->get()->toArray();

        $data['genres']=ParentGenres::getComposeGenre();
        return view('admin.recommended_blog.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {        
        $this->validate($request, 
             ['blog_title'=> 'required',
            //'blog_heading'=> 'required',                 
            'blog_description'=> 'required',
            'blog_meta_description'=> 'required',
            'blog_keywords'=> 'required'           
        ]);


        $input = $request->all();  
         /*Upload,rename image*/
            if ($file = $request->hasFile('blog_image')) {
                $file            = $request->file('blog_image');
                $customimagename  = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('blog_img/');
                $file->move($destinationPath, $customimagename);
                $input['blog_image'] = $customimagename;                
            }
        $input['created_by']=Auth::user()->id;   
        $blog_slug= str_slug($request->blog_title, '-');
        /*$check_duplicate = Blog::where("blog_slug",$blog_slug)->first();
        if($check_duplicate){
            $blog_slug = $blog_slug."1";
        } */
        $input['blog_genre']=$request->get('blog_genre');
        $input['parent_genre_id']=$request->get('parent_genre_id');
        
        $input['blog_slug'] = $blog_slug;
        $input['blog_heading'] = $request->blog_title;
        $input['is_featured'] = (isset($request->is_featured) && $request->is_featured==1)?1:0;
        $input['is_trending'] = (isset($request->is_trending) && $request->is_trending==1)?TRUE:FALSE;
        $input['is_recommended'] =1;
        $user = Blog::create($input);
        //$user->assignRole($request->input('roles'));
        return redirect()->route('admin.recommended-blog')->with('success','Blog created successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $blogs=Blog::showBlogDetail($id);
        /*$blog = Blog::where("id","=",$id)->first();  
        if($blog->created_by!=0)
        {
            $b_c_name = User::select('name')->where('id', '=',$blog->created_by)->first();   
            $creator_name=$b_c_name->name;
        }else{
            $creator_name='';
        }*/
        return view('admin.recommended_blog.show',compact('blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data['genres']=DB::table('parent_genres')->select('id','parent_name')->where('is_deleted','=',0)->orderBy('parent_name')->get()->toArray();
        $data['blog'] = Blog::where("id","=",$id)->first(); 
        $data['childgenres']=DB::table('child_genres')->select('id','child_genre_name')->where('is_deleted','=',0)->get()->toArray();
        /*echo "<pre>";
         var_dump($data['blog']->toArray());
         exit;*/
        //$roles = Role::pluck('name','name')->all();
        //$userRole = $user->roles->pluck('name','name')->all();
        return view('admin.recommended_blog.edit',$data);//'roles','userRole'
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, 
                 ['blog_title'=> 'required',
                //'blog_heading'=> 'required',                 
                'blog_description'=> 'required',
                'blog_meta_description'=> 'required',
                'blog_keywords'=> 'required'           
        ]);

        $input = $request->all();    
        if ($file = $request->hasFile('blog_image')) {
            $file            = $request->file('blog_image');
            $customimagename  = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('blog_img/');
            $file->move($destinationPath, $customimagename);   
            $input['blog_image'] = $customimagename;
        }else{
            $input = array_except($input,array('blog_image'));
        }

        $input['created_by']=Auth::user()->id;    
        $input['blog_heading'] = $request->blog_title;
        $input['parent_genre_id']=$request->parent_genre_id;
        $input['blog_genre']=$request->blog_genre;
        $input['blog_slug']= str_slug($request->blog_title, '-');    
        $input['is_featured'] = (isset($request->is_featured) && $request->is_featured==1)?1:0;
        $input['is_trending'] = (isset($request->is_trending) && $request->is_trending==1)?TRUE:FALSE;
        $input['is_recommended'] =1;
        $blog = Blog::where("id","=",$id)->first();
        $blog->update($input);
        return redirect()->route('admin.recommended-blog')->with('success','Blog updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Blog::where('id',$id)->update(['is_deleted'=>'1']);
        return redirect()->route('admin.recommended-blog')->with('success','Blog deleted successfully');
    }

    public function getAjaxData(Request $request){
		/*DB::enableQueryLog();
		$blogs = DB::table('blogs')->join('users','created_by','=','users.id')->where('blogs.is_delete',"=","0")->where('blogs.is_recommended',"=",1)
		      ->select('blogs.id','blog_title','blog_genre','blog_image', 'blogs.created_at','created_by','blog_slug','blog_status','is_tranding','is_featured')                      
                      ->orderBy('blogs.created_at', 'desc')    
		      ->get();
              
		$laQuery = DB::getQueryLog();
        foreach($blogs as $blog) {
            DB::table('blogs')->where('id','=',$blog->id)->update(['blog_slug'=>str_slug($blog->blog_title)]);
        }                  
		$blogs= collect($blogs);                           
        return \DataTables::of($blogs)
         ->addColumn('action', function($blog) {                  
         	$show_btn = '<a class="btn btn-info" href="'.route('admin.recommended-blog.show',$blog->blog_slug).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';
        	$edit_btn = '<a class="btn btn-primary" href="'.route('admin.recommended-blog.edit',$blog->blog_slug).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
         	$del_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn btn-danger" href="'.route('admin.recommended-blog.destroy',$blog->blog_slug).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
         	return $show_btn.$edit_btn.$del_btn;
       	})
        ->addColumn('id', function($blog) { return $blog->id; })
        ->addColumn('blog_image', function($blog) { 
            if(isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image))
            {
                return "<img src='".asset("public/blog_img/".$blog->blog_image)."' height='100' width='100'>";
            }else{
                return "<img src='".asset('/')."public/blog_img/no_img.jpg' height='100' width='100'>";
            }
        })
         ->addColumn('blog_title', function($blog) {                  
            return '<a href="'.url('blog/'.$blog->blog_slug.'').'" target="_blank">'.$blog->blog_title.'</a>';

         })
         ->addColumn('blog_genre', function($blog) { return getParentGenreInfo($blog->blog_genre); })
        ->addColumn('created_at', function($blog) { return date('d-m-Y',strtotime($blog->created_at)); })
        ->addColumn('created_by', function($blog) { return User::find($blog->created_by)->name; })
        ->addColumn('blog_status', function($blog) { return getBlogstatus($blog->blog_status); })
        ->addColumn('is_featured', function($blog) { return (isset($blog->is_featured) && ($blog->is_featured))?'Yes':'No'; })
        ->addColumn('is_tranding', function($blog) { return (isset($blog->is_tranding) && ($blog->is_tranding))?'Yes':'No'; })
        
*/
         $blogs=Blog::getDataTableBlogs();            

          $blogs= collect($blogs);                           

      return \DataTables::of($blogs)

         ->addColumn('action', function($blog) {                  

            $show_btn = '<a class="btn btn-info" href="'.route('admin.recommended-blog.show',$blog->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';

            $edit_btn = '<a class="btn btn-primary" href="'.route('admin.recommended-blog.edit',$blog->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

            $del_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn btn-danger" href="'.route('admin.recommended-blog.destroy',$blog->id).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

            return $show_btn.$edit_btn.$del_btn;

         })

         ->addColumn('id', function($blog) { return $blog->id; })

         ->addColumn('blog_image', function($blog) { 

             if(isset($blog->blog_image) && $blog->blog_image != null && file_exists(public_path() . '/blog_img/' . $blog->blog_image))

             {

                return "<img src='".asset("public/blog_img/".$blog->blog_image)."' height='100' width='100'>";

             }else{

                 return "<img src='".asset('/')."public/blog_img/no_img.jpg' height='100' width='100'>";

             }

         })

         ->addColumn('blog_title', function($blog) {                  
            return '<a href="'.url('blog/'.$blog->id.'').'" target="_blank">'.$blog->blog_title.'</a>';

         })
         //->addColumn('blog_heading', function($blog) { return $blog->blog_heading; })

         ->addColumn('blog_genre', function($blog) { return $blog->child;})//getParentGenreInfo($blog->blog_genre); })

         ->addColumn('created_at', function($blog) { return date('d-m-Y',strtotime($blog->created_at)); })

         ->addColumn('created_by', function($blog) { 
            return $blog->first_name.' '.$blog->last_name;  })

         ->addColumn('blog_status', function($blog) 
         { 
            if($blog->blog_status==1)
            {
                return "Publish";
            } else{
                return "Draft";
            }
        })
         
         ->addColumn('is_featured', function($blog) { return (isset($blog->is_featured) && ($blog->is_featured))?'Yes':'No'; })
         
         ->addColumn('is_trending', function($blog) { return (isset($blog->is_trending) && ($blog->is_trending))?'Yes':'No'; })

        ->addColumn('is_recommended', function($blog) { 
            return ' <input type="checkbox" data-id="'.$blog->id.'" id="is_recommended" name="is_recommended" value="1" checked="checked" > ';
            
        })
        ->rawColumns(['action','id','blog_image','blog_title','blog_genre','created_by','is_trending','is_featured','is_recommended'])
        ->filter(function ($query) use ($request) {
            if ($request->has('blog_title')) {
                $query->where('blog_title', 'like', "%{$request->get('blog_title')}%");
            }
        })

        ->make(true);
    }
}