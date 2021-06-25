<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/galleries', [GalleryController::class, 'index']);
Route::middleware('api')->get('/galleries/{id}', [GalleryController::class, 'show']);
Route::middleware('api')->post('/galleries', [GalleryController::class, 'store']);
Route::middleware('api')->put('/galleries/{id}', [GalleryController::class, 'update']);
Route::middleware('api')->delete('/galleries/{id}', [GalleryController::class, 'destroy']);

// Route::resource('galleries', GalleryController::class);

Route::middleware('api')->get('/user/{id}',[UserController::class,'show']);

Route::get('/galleries/{id}/comments', [CommentController::class, 'index']);
Route::middleware('api')->get('/comments/{id}', [CommentController::class, 'show']);
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth:api');
Route::middleware('api')->delete('/comments/{id}', [CommentController::class, 'destroy']);


Route::post('register', [ AuthController::class, 'register' ])->middleware('guest:api');
Route::post('login', [ AuthController::class, 'login' ])->middleware('guest:api');
Route::post('logout', [ AuthController::class, 'logout' ])->middleware('auth:api');
Route::get('me', [ AuthController::class, 'me' ])->middleware('auth:api');


