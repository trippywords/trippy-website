<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ParentGenres;
use App\ChildGenres;
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

       // $string = $request->get('child_genre_name');

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

        //$genre->genre_slug = $slug;

        $childgenre->parent_genre_id = $request->get('selParent');

        $childgenre->is_published = $request->get('selPublished');

        $childgenre->child_genre_image = $profile_img;

        $childgenre->save();

        return view('admin.child_genres.index');
    }


    public function index()
    {

       //$ChildGenres = ChildGenres::getChildGenres();
        
       //dd($ChildGenres);	

        return view('admin.child_genres.index');

    }

    public function getAjaxData(Request $request){

		  $ChildGenres = ChildGenres::getChildGenres();

		  $ChildGenres= collect($ChildGenres);

      	return \DataTables::of($ChildGenres)

         ->addColumn('action', function($ChildGenre) {

         	$show_btn = '<a class="btn btn-info" href="'.route('admin-child-genre.show',$ChildGenre->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';

         	//if($this->user->can('genre-edit')){

        		$edit_btn = '<a class="btn btn-primary" href="'.route('admin-child-genre.edit',$ChildGenre->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

         	//}

         	$delete_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn-info" href="'.route('admin-child-genre.destroy',$ChildGenre->id).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

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
          //dd($childgenre);
           
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

         request()->validate([

            'child_genre_name' => 'required|unique:child_genres,child_genre_name,'.$id,

            'child_genre_detail' => 'required',
            'selParent' => 'required',
            'selPublished'=>'required',

        ]);



        $childgenre = ChildGenres::find($id);

       // $string = $request->get('name');

        //$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);

        $profile_img = "";

        if ($request->hasFile('genImage')){

            $uploadFolder = public_path('genre_img/');

            $file = $request->file('genImage');

            $customimagename  = time().'.'.$file->getClientOriginalExtension();

            $destinationPath = $uploadFolder;

            $file->move($destinationPath, $customimagename);

            $profile_img = $customimagename;

            $childgenre->child_genre_image = $profile_img;

        }

        $childgenre->child_genre_name = $request->get('child_genre_name');

        $childgenre->child_genre_detail = $request->get('child_genre_detail');

        //$genre->genre_slug = $slug;

        $childgenre->parent_genre_id = $request->get('selParent');

        $childgenre->is_published = $request->get('selPublished');

        //$childgenre->child_genre_image = $profile_img;






        /*$genre->name = $request->get('name');

        $genre->genre_slug = $slug;

        $genre->detail = $request->get('detail');

        $genre->parent_genre_id = $request->get('selParent');

        $genre->is_published = $request->get('selPublished');
*/
       /* if($request->get('selPublished')=='Y')

        {

            $genre->is_deleted ='N';

        }else{

            $genre->is_deleted ='Y';

        }
*/
        $childgenre->save();



        return redirect()->route('admin-child-genre')

                        ->with('success','Child Genre updated successfully');

    }
}
