<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Genre;
use App\ParentGenres;
use DB;

use URL;

class ParentGenreController extends Controller
{
    //

    public function index()

    {

        //$genres = ParentGenres::latest()->paginate(5);

        return view('admin.parent_genres.index');

    }

    public function show($id)
    {
    	$genre=ParentGenres::find($id);

		return view('admin.parent_genres.show',compact('genre'));
    }

    public function destroy($id)

    {

       	ParentGenres::where('id',$id)->update(['is_deleted'=>'1']);

        return redirect()->route('admin-parent-genre')

                        ->with('success','Parent Genre deleted successfully');

    }


    public function create()
    {
    	return view('admin.parent_genres.create');
    }


    public function store(Request $request)

    {

        request()->validate([

            'parent_name' => 'required|unique:parent_genres,parent_name',

            'parent_detail' => 'required',

        ]);

        $ParentGenre = new ParentGenres();

        $string = $request->get('parent_name');


        $ParentGenre->parent_name = $request->get('parent_name');

        $ParentGenre->parent_detail = $request->get('parent_detail');

     
        $ParentGenre->is_published = $request->get('selPublished');

        if($request->get('selPublished')=='1')

        {

            $ParentGenre->is_deleted ='0';

        }else{

            $ParentGenre->is_deleted ='1';

        }

        $ParentGenre->save();



        return redirect()->route('admin-parent-genre')

                        ->with('success','Genre created successfully.');

    }

     public function edit($id)
    {
    	$ParentGenre = ParentGenres::find($id);
        
        return view('admin.parent_genres.edit',compact('ParentGenre'));
    }

    public function update(Request $request,$id)
    {
    	 request()->validate([

            'parent_name' => 'required|unique:parent_genres,parent_name,'.$id,

            'parent_detail' => 'required',

        ]);

        $ParentGenre = ParentGenres::find($id);

        $ParentGenre->parent_name = $request->get('parent_name');

        $ParentGenre->parent_detail = $request->get('parent_detail');

        $ParentGenre->is_published = $request->get('selPublished');

        /*if($request->get('selPublished')=='1')

        {

            $ParentGenre->is_deleted ='0';

        }else{

            $ParentGenre->is_deleted ='1';

        }*/

        $ParentGenre->save();

        return redirect()->route('admin-parent-genre')

                        ->with('success','parent Genre updated successfully');

    }

   	 public function getAjaxData(Request $request){


		  $ParentGenres = ParentGenres::getParentGenres();
		  
		  $ParentGenres= collect($ParentGenres);

      	return \DataTables::of($ParentGenres)

         ->addColumn('action', function($ParentGenre) {

         	$show_btn = '<a class="btn btn-info" href="'.route('admin-parent-genre.show',$ParentGenre->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';

         	$edit_btn='';

         	//if($this->user->can('genre-edit')){

        		$edit_btn = '<a class="btn btn-primary" href="'.route('admin-parent-genre.edit',$ParentGenre->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

         	//}

         	$delete_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn-info" href="'.route('admin-parent-genre.destroy',$ParentGenre->id).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

         	return $show_btn.$edit_btn.$delete_btn;

       	 })


       	 ->addColumn('id', function($ParentGenre) { return $ParentGenre->id; })

       	 ->addColumn('parent_name', function($ParentGenre) { return $ParentGenre->parent_name; })

         
         ->addColumn('is_published', function($ParentGenre) {

     		$status = ($ParentGenre->is_published=="1")? "Yes" : "No";

            return $status;

       	 })         

         ->rawColumns(['action', 'img','is_published','is_deleted'])

         ->filter(function ($query) use ($request) {

            if ($request->has('name')) {

                $query->where('name', 'like', "%{$request->get('name')}%");

            }

        	})

         ->make(true);

    }


}
