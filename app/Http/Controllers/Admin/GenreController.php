<?php

namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Genre;

use Illuminate\Support\Facades\Input;

use Redirect;

use DataTables;

use DB;

use URL;



class GenreController extends Controller

{ 



		protected $user;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()

    {

         // $this->middleware('permission:genre-list');

         // $this->middleware('permission:genre-create', ['only' => ['create','store']]);

         // $this->middleware('permission:genre-edit', ['only' => ['edit','update']]);

         // $this->middleware('permission:genre-delete', ['only' => ['destroy']]);



         // $this->middleware('permission:genre-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()

    {

        $genres = Genre::latest()->paginate(5);

        return view('admin.genres.index',compact('genres'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()

    {

       // $genres = Genre::all();

        $genres=DB::table('genres')->select('id','name')->where('is_deleted','=','0')->where('parent_genre_id','=','0')->orderBy('name')->get()->toArray();

        return view('admin.genres.create',array('genres' => $genres));

    }

 public function store(Request $request)

    {

        request()->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);

        $genre = new Genre();

        $string = $request->get('name');

        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);

        $check_genre = Genre::where("genre_slug",$slug)->get()->first();

        if(!empty($check_genre)){
            $slug = $slug."1";             
        }

        $profile_img = "";

        if ($request->hasFile('genImage')){

            $uploadFolder = public_path('genre_img/');

            $file = $request->file('genImage');

            $customimagename  = time().'.'.$file->getClientOriginalExtension();

            $destinationPath = $uploadFolder;

            $file->move($destinationPath, $customimagename);

            $profile_img = $customimagename;

        }

        $genre->name = $request->get('name');

        $genre->detail = $request->get('detail');

        $genre->genre_slug = $slug;

        $genre->parent_genre_id = $request->get('selParent');

        $genre->is_published = $request->get('selPublished');

        if($request->get('selPublished')=='Y')

        {

            $genre->is_deleted ='N';

        }else{

            $genre->is_deleted ='Y';

        }

        $genre->genre_image = $profile_img;

        $genre->save();



        return redirect()->route('admin-genre.index')

                        ->with('success','Genre created successfully.');

    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function show($id)

    {   

        

         //$genre = array();

          $genre=Genre::find($id);  

         return view('admin.genres.show',compact('genre'));

    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function edit(Genre $genre)

    {

        $genres = Genre::all();

        return view('admin.genres.edit',array('genre' => $genre,'genres' => $genres));

    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id)

    {

         request()->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);



        $genre = Genre::find($id);

        $string = $request->get('name');

        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);

        $profile_img = "";

        if ($request->hasFile('genImage')){

            $uploadFolder = public_path('genre_img/');

            $file = $request->file('genImage');

            $customimagename  = time().'.'.$file->getClientOriginalExtension();

            $destinationPath = $uploadFolder;

            $file->move($destinationPath, $customimagename);

            $profile_img = $customimagename;

            $genre->genre_image = $profile_img;

        }

        $genre->name = $request->get('name');

        $genre->genre_slug = $slug;

        $genre->detail = $request->get('detail');

        $genre->parent_genre_id = $request->get('selParent');

        $genre->is_published = $request->get('selPublished');

        if($request->get('selPublished')=='Y')

        {

            $genre->is_deleted ='N';

        }else{

            $genre->is_deleted ='Y';

        }

        $genre->save();



        return redirect()->route('admin-genre.index')

                        ->with('success','Genre updated successfully');

    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)

    {

       	genre::where('id',$id)->update(['is_deleted'=>'1']);

        return redirect()->route('admin-genre.index')

                        ->with('success','Genre deleted successfully');

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   



    public function getAjaxData(Request $request){



    	$this->user = Auth()->user();

    	$userid = Auth()->user()->id;



		  $genres = DB::table('genres')->where('is_deleted','=','0')

		      ->select('id', 'name', 'parent_genre_id', 'genre_image','is_deleted', 'is_published', 'created_at','updated_at')

                     ->orderBy('id', 'desc')         

		      ->get();

		  $genres= collect($genres);



      return \DataTables::of($genres)

         ->addColumn('action', function($genre) {

         	$show_btn = '<a class="btn btn-info" href="'.route('admin-genre.show',$genre->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';

         	$edit_btn='';

         	//if($this->user->can('genre-edit')){

        		$edit_btn = '<a class="btn btn-primary" href="'.route('admin-genre.edit',$genre->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

         	//}

         	$delete_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn-info" href="'.route('admin-genre.destroy',$genre->id).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

         	return $show_btn.$edit_btn.$delete_btn;

       	 })

         ->addColumn('parent_genre_id',function($genre){

            if($genre->parent_genre_id != ""){

                return getParentGenreInfo($genre->parent_genre_id);

            }else{

                return "NA";

            }

         })         

         ->addColumn('img',function($genre){

            if($genre->genre_image != ""){

                return "<img src='".URL::to('/')."/public/genre_img/".$genre->genre_image."' height='100' width='100'>";

            }else{

                return "<img src='http://via.placeholder.com/100x100'>";

            }

         })

         ->addColumn('is_published', function($genre) {

     		$status = ($genre->is_published=="Y")? "Yes" : "No";

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







            