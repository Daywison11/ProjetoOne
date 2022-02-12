<?php

use App\Http\Controllers\PostController;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;


Route::put('/posts/edit/{id}', [PostController::class,'update'])->name('posts.update');

Route::get('/posts/edit/{id}', [PostController::class,'edit'])->name('posts.edit');

Route::any('/posts/search', [PostController::class, 'search'])->name('posts.search');

Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/posts/creat', [PostController::class, 'create'])->name('create.posts');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts', [PostController::class, 'index'])->name('post.index') ;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
