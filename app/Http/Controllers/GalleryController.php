<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGallery;
use App\Http\Requests\UpdateGallery;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->query('name', '');
        $results = Gallery::search($name)->orderBy('id','DESC')->with('images')->with('user')->with('comments');
        $galleries = $results->get();

        return $galleries;
    }

    public function show($id){
        $gallery = Gallery::findOrFail($id);
        $images = $gallery->images;
        $user = $gallery->user;
        $comments = $gallery->comments;
        $results= [
            'id' => $gallery->id,
            'name'=>$gallery->name,
            'description'=>$gallery->description,
            'created_at'=>$gallery->created_at,
            'updated_at'=>$gallery->updated_at,
            'images'=>$images,
            'user'=>$user,
            'comments'=>$comments
        ];

        return response()->json($results);
    }

        public function store(CreateGallery $request)
    {
        $data = $request->validated();
        $user = User::findOrFail($request['id']);
        $user_id = $user->id;
        $gallery= Gallery::create([
            "name"=>$data['name'],
            "description"=>$data['description'],
            'user_id' => $user_id
        ]);
        foreach($data['source'] as $source) {
            $gallery->addImages($source, $gallery['id']);
        }

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
