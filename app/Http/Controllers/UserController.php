<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with('galleries', 'galleries.images')->findOrFail($id);
        return response()->json($user);
    }
}
