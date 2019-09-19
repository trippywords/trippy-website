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

        $genres = Genre::latest()->paginate(5);


        return view('admin.parent_genres.index',compact('genres'));

            

    }

   public function getAjaxData(Request $request){



    	$this->user = Auth()->user();

    	$userid = Auth()->user()->id;



		  $ParentGenres = DB::table('parent_genres')->where('is_deleted','=','N')

		      ->select('id', 'parent_name', 'is_published', 'created_at')

                     ->orderBy('id', 'desc')         

		      ->get();

		  $ParentGenres= collect($ParentGenres);



      return \DataTables::of($ParentGenres)

         ->addColumn('action', function($ParentGenre) {

         	$show_btn = '<a class="btn btn-info" href="'.route('admin-genre.show',$ParentGenre->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';

         	$edit_btn='';

         	//if($this->user->can('genre-edit')){

        		$edit_btn = '<a class="btn btn-primary" href="'.route('admin-genre.edit',$ParentGenre->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

         	//}

         	$delete_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn-info" href="'.route('admin-genre.destroy',$ParentGenre->id).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

         	return $show_btn.$edit_btn.$delete_btn;

       	 })


       	 ->addColumn('id', function($ParentGenre) { return $ParentGenre->id; })

       	 ->addColumn('parent_name', function($ParentGenre) { return $ParentGenre->parent_name; })

         /*->addColumn('parent_genre_id',function($ParentGenre){

            if($genre->parent_genre_id != ""){

                return getParentGenreInfo($genre->parent_genre_id);

            }else{

                return "NA";

            }

         })         
*/
         /*->addColumn('img',function($genre){

            if($genre->genre_image != ""){

                return "<img src='".URL::to('/')."/public/genre_img/".$genre->genre_image."' height='100' width='100'>";

            }else{

                return "<img src='http://via.placeholder.com/100x100'>";

            }

         })
*/
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
