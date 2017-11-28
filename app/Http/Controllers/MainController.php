<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\wisata;

class MainController extends Controller
{
    //
    public function index()
    {
        $wisatas = wisata::all();
        return view('index',['wisatas' => $wisatas]);
 
    }
}