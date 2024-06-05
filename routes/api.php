<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\AttachmentController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->middleware('api')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('registration', 'registration');
});

Route::prefix('tags')->middleware('api')->controller(TagController::class)->group(function(){
    Route::post('', 'store');
    Route::put('{tag}', 'update');
    Route::delete('{tag}', 'destroy');
    Route::post('updatebyid/{id}', 'updateById');
    Route::post('moveBucket/{id}', 'moveBucket');
});
Route::prefix('tags')->controller(TagController::class)->group(function(){
    Route::get('', 'index');
    Route::get('{id}', 'show');
});

Route::prefix('categories')->middleware('api')->controller(CategoryController::class)->group(function(){
    Route::post('', 'store');
    Route::put('{category}', 'update');
    Route::delete('{category}', 'destroy');
    Route::post('updatebyid/{id}', 'updateById');
    Route::post('moveBucket/{id}', 'moveBucket');
});
Route::prefix('categories')->controller(CategoryController::class)->group(function(){
    Route::get('', 'index');
    Route::get('{id}', 'show');
});

Route::prefix('posts')->middleware('api')->controller(PostController::class)->group(function(){
    Route::post('', 'store');
    Route::put('{post}', 'update');
    Route::delete('{post}', 'destroy');
    Route::post('updatebyid/{id}', 'updateById');
    Route::post('moveBucket/{id}', 'moveBucket');
});
Route::prefix('posts')->controller(PostController::class)->group(function(){
    Route::get('', 'index');
    Route::get('{id}', 'show');
});

Route::prefix('comments')->middleware('api')->controller(CommentController::class)->group(function(){
    Route::post('', 'store');
    Route::put('{comment}', 'update');
    Route::delete('{comment}', 'destroy');
});
Route::prefix('comments')->controller(CommentController::class)->group(function(){
    Route::get('', 'index');
    Route::get('{id}', 'show');
});

Route::prefix('attachments')->middleware('api')->controller(AttachmentController::class)->group(function(){
    Route::post('', 'store');
    Route::delete('{attachment}', 'destroy');
    Route::post('updatebyid/{id}', 'updateById');
});
Route::prefix('attachments')->controller(AttachmentController::class)->group(function(){
    Route::get('', 'index');
    Route::get('{id}', 'show');
    Route::get('getbypostid/{postid}', 'getbypostid');
});

//Route::resource('tags', TagController::class);
//Route::resource('categories', CategoryController::class);
//Route::resource('posts', PostController::class);
//Route::resource('comments', CommentController::class);
//Route::resource('attachments', AttachmentController::class);
