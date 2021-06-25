<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGallery;
use App\Http\Requests\UpdateGallery;


class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->query('name', '');
        $results = Gallery::search($name)->orderBy('id','DESC')->with('images')->with('user');
        $galleries = $results->get();

        return response()->json($galleries);
    }


    public function show($id){
        $gallery = Gallery::findOrFail($id);
        $images = $gallery->images;
        $user = $gallery->user;
        $results= [
            'id' => $gallery->id,
            'name'=>$gallery->name,
            'description'=>$gallery->description,
            'created_at'=>$gallery->created_at,
            'updated_at'=>$gallery->updated_at,
            'images'=>$images,
            'user'=>$user,
        ];

        return response()->json($results);
    }

        public function store(CreateGallery $request)
    {
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
