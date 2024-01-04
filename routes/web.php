<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Frontend Routes

Route::get('/', [App\Http\Controllers\PagesController::class, 'HomePage']);
Route::get('blogs',[App\Http\Controllers\PagesController::class,'BlogsPage']);
Route::get('blog-detail/{id}',[App\Http\Controllers\PagesController::class,'BlogDetailPage'])->name('blog-detail');

Route::get('/posts/{post}', [ReactionController::class, 'show'])->name('posts.show');
Route::post('/posts/{post}/react', [ReactionController::class, 'react'])->name('posts.react');


Route::get('/post/{post}', [PagesController::class, 'show'])->name('post.show');
Route::post('/react/{reactableType}/{reactableId}', [ReactionController::class, 'react'])
    ->middleware('auth')
    ->name('react');


// Comment Routes
Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');

// Reply Routes
Route::post('/reply/store', [ReplyController::class, 'store'])->name('reply.store');

//Admin Routes

Auth::routes();

Route::group(['as'=>'admin.','prefix' => 'admin','middleware'=>['auth','admin']], function () {
    Route::get('dashboard', [HomeController::class, 'adminHome'])->name('dashboard');
    Route::resource('blogs','App\Http\Controllers\BlogsController');
    Route::get('blogs-retrive',[App\Http\Controllers\BlogsController::class,'blogsList'])->name('blogs-list');

    Route::get('restore/{id}', [App\Http\Controllers\BlogsController::class,'blogRetrive'])->name('blogs.restore');
});
Route::group(['as'=>'user.','prefix' => 'user','middleware'=>['auth','user']], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
});