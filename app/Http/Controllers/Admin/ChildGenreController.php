<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ParentGenres;
use App\ChildGenres;
use App\Blog;
use DB;

use URL;



class ChildGenreController extends Controller
{
    public function create()
    {
    	$ParentGenres = ParentGenres::where('is_deleted','=','0')->where('is_published','=','1')->pluck('parent_name','id')->toArray();
    	return view('admin.child_genres.create',compact('ParentGenres'));
    }

    public function store(Request $request)
    {
    	 request()->validate([

            'child_genre_name' => 'required|unique:child_genres,child_genre_name',

            'child_genre_detail' => 'required',

            'selParent'=>'required'

        ]);

        $childgenre = new ChildGenres();

        $profile_img = "";

        if ($request->hasFile('genImage')){

            $uploadFolder = public_path('genre_img/');

            $file = $request->file('genImage');

            $customimagename  = time().'.'.$file->getClientOriginalExtension();

            $destinationPath = $uploadFolder;

            $file->move($destinationPath, $customimagename);

            $profile_img = $customimagename;

        }

        $childgenre->child_genre_name = $request->get('child_genre_name');

        $childgenre->child_genre_detail = $request->get('child_genre_detail');

        $childgenre->parent_genre_id = $request->get('selParent');

        $childgenre->is_published = $request->get('selPublished');

        $childgenre->child_genre_image = $profile_img;

        $childgenre->save();

        return redirect()->route('admin-child-genre')

                        ->with('success','Child Genre created successfully.');
    }


    public function index()
    {
        return view('admin.child_genres.index');
    }

    public function getAjaxData(Request $request)
    {

		  $ChildGenres = ChildGenres::getChildGenres();

		  $ChildGenres= collect($ChildGenres);

      	return \DataTables::of($ChildGenres)

         ->addColumn('action', function($ChildGenre) {

         	$show_btn = '<a class="btn btn-info" href="'.route('admin-child-genre.show',$ChildGenre->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';

        		$edit_btn = '<a class="btn btn-primary" href="'.route('admin-child-genre.edit',$ChildGenre->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

         	$delete_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn btn-danger" href="'.route('admin-child-genre.destroy',$ChildGenre->id).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

         	return $show_btn.$edit_btn.$delete_btn;

       	 })


       	 ->addColumn('id', function($ChildGenre) { return $ChildGenre->id; })

       	 ->addColumn('img',function($ChildGenre){

       	 	
            if($ChildGenre->child_genre_image != ""){

                return "<img src='".URL::to('/')."/public/genre_img/".$ChildGenre->child_genre_image."' height='100' width='100'>";

            }else{

                return "<img src='".URL::to('/')."/public/genre_img/no_img.jpg' height='100' width='100'>";

            }

         })


       	 ->addColumn('child_genre_name', function($ChildGenre) { return $ChildGenre->child_genre_name; })

          ->addColumn('parent_genre_id', function($ChildGenre) { return $ChildGenre->parent_name; })

        ->addColumn('is_published', function($ChildGenre) {

     		$status = ($ChildGenre->is_published=="1")? "Yes" : "No";

            return $status;

       	 })        

         ->rawColumns(['action', 'img','is_published','is_deleted'])

         ->filter(function ($query) use ($request) {

            if ($request->has('child_genre_name')) {

                $query->where('child_genre_name', 'like', "%{$request->get('child_genre_name')}%");

            }

        	})

         ->make(true);

    }

    public function show($id)

    {  
        $childgenre=ChildGenres::find($id); 
          
        return view('admin.child_genres.show',compact('childgenre'));
    }

    public function destroy($id)
    {
    	ChildGenres::where('id',$id)->update(['is_deleted'=>'1']);

        return redirect()->route('admin-child-genre')

                        ->with('success','Child Genre deleted successfully');
    }

     public function edit($id)
    {
    	$ParentGenres=ParentGenres::getParentGenres();
    	
    	$ChildGenre = childGenres::find($id);
    	
        return view('admin.child_genres.edit',compact('ParentGenres','ChildGenre'));
    }

    public function update(Request $request,$id)

    {

       $image_name = $request->hidden_image;

        $image = $request->file('genImage');
        if($image != '')
        {
             $request->validate([

            'child_genre_name' => 'required|unique:child_genres,child_genre_name,'.$id,

            'child_genre_detail' => 'required',
            'parent_genre_id' => 'required',
            'selPublished'=>'required',
            'genImage'=> 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

         $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('genre_img/'), $image_name);

      }
      else{
         $request->validate([

            'child_genre_name' => 'required|unique:child_genres,child_genre_name,'.$id,

            'child_genre_detail' => 'required',
            'parent_genre_id' => 'required',
            'selPublished'=>'required',
          ]);

      }
        //$childgenre = ChildGenres::find($id);

       /* $profile_img = "";

        if ($request->hasFile('genImage')){

            $uploadFolder = public_path('genre_img/');

            $file = $request->file('genImage');

            $customimagename  = time().'.'.$file->getClientOriginalExtension();

            $destinationPath = $uploadFolder;

            $file->move($destinationPath, $customimagename);

            $profile_img = $customimagename;

            $childgenre->child_genre_image = $profile_img;

        }*/

        $childgenre = ChildGenres::find($id);
        $childgenre->child_genre_name = $request->get('child_genre_name');

        $childgenre->child_genre_detail = $request->get('child_genre_detail');

        $childgenre->parent_genre_id = $request->get('parent_genre_id');

        $childgenre->is_published = $request->get('selPublished');

        $childgenre->child_genre_image = $image_name;

        //$childgenre->update($input);

        //$childgenre->child_genre_image = $profile_img;

        $childgenre->save();
        
        if($request->get('selPublished')==0)
        {
          $countblogs=DB::select("select count(id) as count from blogs where blog_genre=$childgenre->id and is_deleted='0'");

          foreach($countblogs as $count)
          { 
            $result=Blog::where('blog_status','=',1)
                        ->where('blog_genre','=',$childgenre->id)
                        ->update(['blog_status'=>'0']);
          }
         
        }

        if($request->get('selPublished')==1)
        {
          $countblogs=DB::select("select count(id) as count from blogs where blog_genre=$childgenre->id and is_deleted='0'");

          foreach($countblogs as $count)
          { 
            
            $result=Blog::where('blog_status','=',0)
                        ->where('blog_genre','=',$childgenre->id)
                        ->update(['blog_status'=>'1']);
          }
         
        }
        return redirect()->route('admin-child-genre')

                        ->with('success','Child Genre updated successfully');

    }
}
