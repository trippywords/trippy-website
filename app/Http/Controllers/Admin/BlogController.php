<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Blog;

use App\Bookmarks;

use App\ChildGenres;

use App\ParentGenres;

use App\User;

use Spatie\Permission\Models\Role;

use DB;

use Hash;

use Illuminate\Support\Facades\Auth;

use URL;

use Illuminate\Support\Str;



class BlogController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {        

        //$data = Blog::orderBy('id','DESC')->paginate(5);

        return view('admin.blog.index');

    }





    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {
        $data['genres']=ParentGenres::getComposeGenre();
        //$data['genres']=DB::table('parent_genres')->select('id','parent_name')->where('is_deleted','=',0)->orderBy('parent_name')->get()->toArray();
        
        return view('admin.blog.create',$data);

    }

    public function ajaxChild(Request $request)
    {
        $child=ChildGenres::where('parent_genre_id',$request->id)->pluck('child_genre_name','id');

        return json_encode($child);

    }





    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {   
    //dd($request->all()) ;    

        $this->validate($request, 

                 ['blog_title'=> 'required',

                //'blog_heading'=> 'required', 
                'blog_image'=> 'required',                

                'blog_description'=> 'required',

                'blog_meta_description'=> 'required',

                'blog_keywords'=> 'required',

                'blog_image'=> 'required|image|mimes:jpeg,png,jpg,gif',


        ]);

        $blog = new Blog();
        
        $blog_image="";

        if ($file = $request->hasFile('blog_image')) {

                $file            = $request->file('blog_image');

                $customimagename  = time() . '.' . $file->getClientOriginalExtension();

                $destinationPath = public_path('blog_img/');

                $file->move($destinationPath, $customimagename);

                $blog_image = $customimagename;                

            }
            $blog->created_by=Auth::user()->id;

            $blog->blog_title=$request->get('blog_title');

            $blog->parent_genre_id=$request->get('parent_genre_id');

            $blog->blog_genre=$request->get('blog_genre');

            $blog->blog_image=$blog_image;

            $blog->blog_description=$request->get('blog_description');

            $blog->blog_meta_description=$request->get('blog_meta_description');

            $blog->blog_keywords=$request->get('blog_keywords');

            $blog->blog_status=$request->get('blog_status');

            $blog->is_trending=(isset($request->is_trending) && $request->is_trending==1)?TRUE:FALSE;

            $blog->is_featured=(isset($request->is_featured) && $request->is_featured==1)?1:0;

            $blog->is_recommended=FALSE;

             $blog->save();

        //$user->assignRole($request->input('roles'));

        return redirect()->route('admin.blog')->with('success','Blog created successfully');

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

        return view('admin.blog.show',compact('blogs'));//->with('blog');
    }





    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $data['genres']=ParentGenres::getComposeGenre();
        
        $data['blog'] = Blog::where("id","=",$id)->first(); 

        $data['childgenres']=DB::table('child_genres')->select('id','child_genre_name')->where('is_deleted','=',0)->where('is_published','=',1)->get()->toArray();

        return view('admin.blog.edit',$data);//'roles','userRole'

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

                 [
                    'blog_title'=> 'required',                

                'blog_description'=> 'required',

                'parent_genre_id'=>'required',

                'blog_genre'=>'required',

                'blog_meta_description'=> 'required',

                'blog_keywords'=> 'required' ,

                'blog_image'=> 'required|image|mimes:jpeg,png,jpg,gif',          

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
        $input['blog_slug']= str_slug($request->blog_title, '-');    
        $input['is_featured'] = (isset($request->is_featured) && $request->is_featured==1)?1:0;
        $input['is_trending'] = (isset($request->is_trending) && $request->is_trending==1)?TRUE:FALSE;
        $input['parent_genre_id']=$request->parent_genre_id;
        $input['blog_genre']=$request->blog_genre;
        
        $input['is_recommended'] =FALSE;

        //dd($input);
        $blog = Blog::where("id","=",$id)->first();

        $blog->update($input);

        //$user->assignRole($request->input('roles'));

        return redirect()->route('admin.blog')

                        ->with('success','Blog updated successfully');

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

        Bookmarks::where('blog_id',$id)->update(['is_delete'=>'1']);

        return redirect()->route('admin.blog')

                        ->with('success','Blog deleted successfully');

    }

    

    public function getAjaxData(Request $request){

            
        $blogs=Blog::getDataTableBlogs();

		 
		  $blogs= collect($blogs);                           

      return \DataTables::of($blogs)

         ->addColumn('action', function($blog) {                  

         	$show_btn = '<a class="btn btn-info" href="'.route('admin.blog.show',$blog->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';

        	$edit_btn = '<a class="btn btn-primary" href="'.route('admin.blog.edit',$blog->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

         	$del_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn btn-danger" href="'.route('admin.blog.destroy',$blog->id).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

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
            $value=$blog->blog_title;
            $blog_title=Str::limit($value, $limit = 50, $end = '...');                 
            return '<a href="'.route('admin.blog.show',$blog->id).'" >'.$blog_title.'</a>';

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
            } 
            elseif($blog->blog_status==0)
            {
                return "Un-Published";
            }
            else{
                return "Draft";
            }
        })
         
         ->addColumn('is_featured', function($blog) { return (isset($blog->is_featured) && ($blog->is_featured))?'Yes':'No'; })
         
         ->addColumn('is_trending', function($blog) { return (isset($blog->is_trending) && ($blog->is_trending))?'Yes':'No'; })

         ->addColumn('is_recommended', function($blog) { 
            return ' <input type="checkbox" data-id="'.$blog->id.'" id="is_recommended" name="is_recommended"  value="1" > ';
            })

         ->rawColumns(['action','id','blog_image','blog_title','blog_genre','created_at','created_by','is_trending','is_featured','is_recommended'])

         ->filter(function ($query) use ($request) {

            if ($request->has('blog_title')) {

                $query->where('blog_title', 'like', "%{$request->get('blog_title')}%");

            }

        	})

         ->make(true);

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update_recommended(Request $request)
    {   
        $is_recommended = (isset($request->is_recommended) && $request->is_recommended==1)?1:0;
        $blog_id = isset($request->blog_id)?$request->blog_id:0;
        if (isset($blog_id) && intval($blog_id) > 0) {
            Blog::where('id',$blog_id)->update(['is_recommended'=>$is_recommended ]);
            session()->flash('success', 'Record Updated Successfully.'); 
        }else{
            session()->flash('error', 'Blog Not Found.'); 
        }
        echo true;
    }

}