<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;

class StoreController extends Controller
{
	public function __invoke(StoreRequest $request) {
		$data = $request->validated();
		$tags = $data['tags'];
		unset($data['tags']);
		$post = Post::create($data);
		// Должен быть создан нами метод отношений tags() в модели Post.php
		// Но это не вставит данные во временные поля: время создания, изменения. Да и эти поля обычно не нужны, их удаляют
		// Этот метод может выполнять две задачи: 1) Если обращаться $post->tags - вернёт массив полученных значений. 2) Если обращаться $post->tags() - сохраняем запрос в базу и можем продолжить этот запрос
		$post->tags()->attach($tags);
		return redirect()->route('post.index');
	}

	public function __invoke1() {
		$data = request()->validate([
			'title' => 'required|string',
			'content' => 'string',
			'image' => 'string',
			'category_id' => '',
			'tags' => '',
		]);
		//dd($data);
		$tags = $data['tags'];
		unset($data['tags']);

		$post = Post::create($data);

//		foreach($tags as $tag)
//			PostTag::firstOrCreate([
//				'tag_id' => $tag->id,
//				'post_id' => $post->id,
//			]);
		// Способ более профессиональный:	И для него должен быть создан нами метод отношений tags() в модели Post.php
		// Но это не вставит данные во временные поля: время создания, изменения. Да и эти поля обычно не нужны, их удаляют
		// Этот метод может выполнять две задачи: 1) Если обращаться $post->tags - вернёт массив полученных значений. 2) Если обращаться $post->tags() - сохраняем запрос в базу и можем продолжить этот запрос
		$post->tags()->attach($tags);
		return redirect()->route('post.index');
    }
}
