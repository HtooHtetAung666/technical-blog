<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BlogController::class,'index']);
Route::get('/blogs/{blog:slug}', [BlogController::class,'show']);

Route::get('/register',[AuthController::class,'create'])->middleware('guest');
Route::post('/register/store',[AuthController::class,'store'])->middleware('guest');

Route::get('/login',[AuthController::class,'login'])->middleware('guest');
Route::post('/login',[AuthController::class,'post_login'])->middleware('guest');
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth');

Route::post('/blogs/{blog:slug}/comments',[CommentController::class,'store']);
Route::post('/blogs/{blog:slug}/subscription',[BlogController::class,'subscriptionHandler']);

// Admin
Route::middleware('can:admin')->group(function () {
    Route::get('/bensai/blogs', [AdminBlogController::class,'index']);
    Route::get('/bensai/blogs/create', [AdminBlogController::class,'create']);
    Route::post('/bensai/blogs/store', [AdminBlogController::class,'store']);
    Route::delete('/bensai/blogs/{blog:slug}/delete', [AdminBlogController::class,'destroy']);
    Route::get('/bensai/blogs/{blog:slug}/edit', [AdminBlogController::class,'edit']);
    Route::patch('/bensai/blogs/{blog:slug}/update', [AdminBlogController::class,'update']);
});