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

Route::prefix('auth')->middleware('api')->controller(AuthController::class)->qroup(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('registration', 'registration');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('tags', TagController::class);

Route::resource('categories', CategoryController::class);

Route::resource('posts', PostController::class);

Route::resource('comments', CommentController::class);

Route::resource('attachments', AttachmentController::class);
Route::get('/attachments/getbypostid/{postid}', [AttachmentController::class, 'getByPostId']);
Route::post('/attachments/updatebyid/{id}', [AttachmentController::class, 'updateById']);
