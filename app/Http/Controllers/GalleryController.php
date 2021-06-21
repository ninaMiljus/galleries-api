<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGallery;
use App\Http\Requests\UpdateGallery;

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

    public function store(CreateGallery $request){
        $data = $request->validated();
        $gallery = Gallery::create($data);

        return response()->json($gallery);
    }

    public function update(UpdateGallery $request, $id){
        $data = $request->validated();
        $gallery = Gallery::findOrFail($id);
        $gallery->update($data);

        return response()->json($gallery);
    }

    public function destroy($id){
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return response()->json($gallery);
    }
}
