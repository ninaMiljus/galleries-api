<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Gallery;

class CommentController extends Controller
{
    public function index($id)
    {
        return Comment::with('user')->where('gallerie_id',$id)->get();
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return response()->json($comment);
    }

    public function store(CommentRequest $request, $id){
        $data = $request->validated();
        $user = auth('api')->user();
        $comment= Comment::create([
            "text"=>$data['text'],
            'gallery_id' =>$id,
            'user_id' => $user->id
        ]);

        return response()->json($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return $comment;
    }
}
