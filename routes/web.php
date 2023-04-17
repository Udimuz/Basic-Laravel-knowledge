<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::get('/posts/update', [PostController::class, 'update']);
Route::get('/posts/delete', [PostController::class, 'delete']);
Route::get('/posts/first_or_create', [PostController::class, 'firstOrCreate']);
Route::get('/posts/update_or_create', [PostController::class, 'updateOrCreate']);

Route::post('/posts', [PostController::class, 'store'])->name('post.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.delete');

Route::get('/main', [\App\Http\Controllers\MainController::class, 'index'])->name('main.index');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about.index');
