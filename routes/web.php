<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\postsController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\postTagsController;
use App\Http\Controllers\commentsController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [App\Http\Controllers\postsController::class, 'index'])->name('welcome');

//Route::get('/',[homeController::class,'home'])->name('home.index');

Route::get('/about', [AboutController::class,'index']);

Route::resource('posts', postsController::class);

Route::get('/posts/tag/{tag}',[postTagsController::class,'index'])->name('posts.tags.index');

Route::resource('posts.comments', commentsController::class)->only(['store','index']);

Route::resource('user', userController::class)->only(['show','edit','update']);