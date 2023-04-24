<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


//Route::get('/', function () { return view('welcome'); });
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

//Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
//Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');

//Route::post('/posts', [PostController::class, 'store'])->name('post.store');
//Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
//Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
//Route::patch('/posts/{post}', [PostController::class, 'update'])->name('post.update');
//Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.delete');

Route::group(['prefix'=>'posts', 'namespace'=>'App\Http\Controllers\Post'], function(){
	// Для запуска страницы по адресу "/posts/":
	Route::get('/', 'IndexController')->name('post.index');
	// Запустит страницу по адресу "/posts/create":
	Route::get('/create', 'CreateController')->name('post.create');
	Route::post('/', 'StoreController')->name('post.store');
	Route::get('/{post}', 'ShowController')->name('post.show');
	Route::get('/{post}/edit', 'EditController')->name('post.edit');
	Route::patch('/{post}', 'UpdateController')->name('post.update');
	Route::delete('/{post}', 'DestroyController')->name('post.delete');
});

// Раздел Админки:	prefix - добавит везде к ссылке впереди адрес "/admin/". Это чтобы не создавать такие роуты '/admin/post', '/admin/add', а сократить
Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix'=>'admin'], function() {	// , 'middleware'=>'admin'
	//Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('main.index');
	//Route::get('/admin', 'IndexController')->name('main.index');
	Route::group(['namespace'=>'Post'], function(){
		// Чтобы страница запускалась по адресу "/admin/post"
		Route::get('/post', 'IndexController')->name('admin.post.index');
	});
});

Route::get('/posts/update', [PostController::class, 'update']);
Route::get('/posts/delete', [PostController::class, 'delete']);
Route::get('/posts/first_or_create', [PostController::class, 'firstOrCreate']);
Route::get('/posts/update_or_create', [PostController::class, 'updateOrCreate']);

// Здесь разместим начальную страницу AdminLTE:
Route::get('/main', [\App\Http\Controllers\MainController::class, 'index'])->name('main.index');

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about.index');

Auth::routes();	// Похоже, эта вещь и включает маршруты с авторизацией. И там есть ->name('login')

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
