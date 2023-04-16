<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	//	http://first-project.loc/posts
	public function index() {
		$posts = Post::all();
		return view('post.index', compact('posts'));
	}
	public function index2()
	{
		// $post = \App\Models\Post::find(1);
		$post = \App\Models\Post::where('likes', 10)->first();
		dump($post);
		//$posts = \App\Models\Post::all();
		$posts = \App\Models\Post::where('is_published', 1)->get();
		foreach ($posts as $post)
			dump($post->title);
		//dd($posts);
    }

	//	http://first-project.loc/posts/create
	public function create()
	{
		$postsArr = [
			[
				'title' => 'Title of post from Phpstorm',
				'content' => 'Some interesting content',
				'image' => 'image.jpg',
				'likes' => '40',
				'is_published' => '1',
			],
			[
				'title' => 'another Title of post from Phpstorm',
				'content' => 'another content',
				'image' => 'another image.jpg',
				'likes' => '50',
				'is_published' => '1',
			],
		];
//		Post::create([
//			'title' => '1 of post from Phpstorm',
//			'content' => '1 interesting content',
//			'image' => '1.jpg',
//			'likes' => '1',
//			'is_published' => '0',
//		]);
		// Или можно вставлять по массиву:
//		foreach($postsArr as $item)
//			Post::create($item);
	}

	//	http://first-project.loc/posts/update
	public function update()
	{
		// Сначала нужно вытащить запись из таблицы, например по id = 4
		$post = Post::find(4);	// Чтобы взять объект из базы
		//dd($post->title);
		// Далее, обновляем данные этой записи:
		$post->update([
			'title' => 'updated Title of post from Phpstorm',
			'content' => 'updated content',
			'image' => 'updated image.jpg',
			'likes' => '60',
			'is_published' => '0',
		]);
	}

	//	http://first-project.loc/posts/delete
	public function delete2()
	{
		// Сначала нужно вытащить запись из таблицы, например по id = 4
		$post = Post::find(4);	// Чтобы взять объект из базы
		$post->delete();	// Простое и жёсткое удаление
		// Но тут хорошо бы сделать проверку данных, перед удалением. Если запустить этот код ещё раз - выйдет ошибка, что такой записи не существует
		dd('deleted 4');
	}
	public function delete()
	{
		$post = Post::withTrashed()->find(4);	// Сначала нужно вытащить запись из таблицы, например по id = 4
		$post->restore();	// Восстановление записи
		dd('restored');
	}

	//	http://first-project.loc/posts/first_or_create
	public function firstOrCreate()
	{
		$post = Post::firstOrCreate(
			[
				// Если Ларавел в базе найдёт запись с таким значением: то он нам просто вернёт эту запись из базы, в переменную $post
				'title' => 'another Title',
			],
			[
				// Если не находит, то выполнит действие "Create", создаёт новую запись, и сохраняет туда все эти атрибуты:
				'title' => 'another Title',
				'content' => 'another content',
				'image' => 'another image.jpg',
				'likes' => '111',
				'is_published' => '1',
			]
		);
		dump($post->content);
		dd('Finished');
	}

	//	http://first-project.loc/posts/update_or_create
	// Эта функция немного сложнее, может запутать. А так, в ней ничего сложного - понимание приходит с практикой
	public function updateOrCreate()
	{
		$anotherPost = [
			'title' => 'updateOrCreate Title from Phpstorm',
			'content' => 'updateOrCreate content',
			'image' => 'updateOrCreate image.jpg',
			'likes' => '200',
			'is_published' => '1',
		];
		$post = Post::updateOrCreate(
			[
				// Если Ларавел в базе найдёт запись с таким значением: то он ОБНОВИТ эту запись (update) атрибутами из массива $anotherPost:
				'title' => 'updateOrCreate Title 2 from Phpstorm',
				// Кажется, тут надо быть осторожным, атрибут 'title' тоже может обновиться, если здесь отличается от той что в массиве $anotherPost
				// И тогда 2-й раз запуск этой функция updateOrCreate() уже сработает на добавление новой записи, даже если такая в таблице уже есть
			],
			// Если не находит, то выполнит действие "Create", создаёт новую запись, и сохраняет туда все эти атрибуты:
			$anotherPost
		);
		dump($post->title);
		dd('Updated');
	}
}
