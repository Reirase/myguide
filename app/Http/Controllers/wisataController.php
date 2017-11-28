<?php

namespace App\Http\Controllers;


use App\wisata;
use App\Review;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class wisataController extends Controller
{
    //
    public function index(){
        $wisatas = wisata::all();
        return view('home',['wisatas' => $wisatas]);
    }
 
    public function destroy($id){
        wisata::destroy($id);
        return redirect('/home');
    }
    public function show($id){
        $wisata = wisata::find($id);
        // Get all reviews that are not spam for the product and paginate them
        $reviews = $wisata->reviews()->with('user')->approved()->notSpam()->orderBy('created_at','desc')->paginate(100);
        return View::make('wisatas.single', array('wisata'=>$wisata,'reviews'=>$reviews));
    }
 
    public function newProduct(){
        return view('add');
    }
 
    public function add() {
 
        $file = Request::input('file');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));

        $wisata  = new wisata();
        $wisata->published = '1';
        $wisata->rating_cache = '3.0';
        $wisata->rating_count = '0';
        $wisata->name =Request::input('name');
        $wisata->lokasi =Request::input('lokasi');
        $wisata->description =Request::input('description');
        $wisata->file_name =$file->getFilename().'.'.$extension;
        $file->move('uploads', $file->getClientOriginalName());
        $wisata->save();
 
        return redirect('/home');
 
    }
    
    public function recalculateRating($rating)
    {
    	$reviews = $this->reviews()->notSpam()->approved();
	    $avgRating = $reviews->avg('rating');
		$this->rating_cache = round($avgRating,1);
		$this->rating_count = $reviews->count();
    	$this->save();
    }
}
