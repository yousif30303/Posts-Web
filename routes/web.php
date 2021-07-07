<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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
Route::view('/', 'dashboard')->name('dashboard');
Route::get('/register',[UserController::class,'ShowReg'])->name('register');
Route::post('/register',[UserController::class,'register']);
Route::get('/logout',[UserController::class,'Logout'])->name('logout');
Route::get('/login',[UserController::class,'ShowLog'])->name('login');
Route::post('/login',[UserController::class,'Login']);

Route::get('/posts',[PostController::class,'ShowPosts'])->name('posts');
Route::post('/posts',[PostController::class,'Create']);

Route::post('/destroy/{post:id}',[PostController::class,'destroy'])->name('destroy');

Route::post('/store/{post:id}',[LikeController::class,'store'])->name('store');

Route::delete('/destroyLike/{post:id}',[LikeController::class,'destroyLike'])->name('destroyLike');

Route::get('/ShowProfile/{post:id}',[PostController::class,'ShowProfile'])->name('ShowProfile');
