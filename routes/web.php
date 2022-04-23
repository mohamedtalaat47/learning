<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\postsController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\postTagsController;
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


Route::get('/', function(){
    return view('welcome');
})->name('home.welcome');

//Route::get('/',[homeController::class,'home'])->name('home.index');

Route::get('/about', [AboutController::class,'index']);


Route::resource('posts', postsController::class);

Route::get('/posts/tag/{tag}',[postTagsController::class,'index'])->name('posts.tags.index');
















// Route::get('/post/{id}', function($id){

//     $posts = [
//         1 => [
            
//             'title' => 'Intro to Laravel',
//             'content' => 'This is a short intro to Laravel'
//         ],
//         2 => [
//             'title' => 'Intro to PHP',
//             'content' => 'This is a short intro to PHP'
//         ]
//     ];

//     abort_if(!isset($posts[$id]),'404');

//     return view('posts.show', ['post' => $posts[$id]]);
// })->name('post.id');

// Route::get('/post/', function(){

//     $posts = [
//         1 => [
            
//             'title' => 'Intro to Laravel',
//             'content' => 'This is a short intro to Laravel'
//         ],
//         2 => [
//             'title' => 'Intro to PHP',
//             'content' => 'This is a short intro to PHP'
//         ]
//     ];


//     return view('posts.show', ['posts' => $posts]);
// })->name('post.id');
