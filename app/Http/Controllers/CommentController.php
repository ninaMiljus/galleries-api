<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
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

    public function store(CommentRequest $request){
        $user = Auth('api')->user();

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->gallerie_id = $request->input('gallerie_id');
        $comment->text = $request->input('text');
        $comment->save();

        return $comment;
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return $comment;
    }
}
