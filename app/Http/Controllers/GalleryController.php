<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(){
        $galleries = Gallery::all();

        return response()->json($galleries);
    }

    public function show($id){
        $gallery = Gallery::findOrFail($id);

        return response()->json($gallery);
    }
}
