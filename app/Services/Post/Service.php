<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
	// Теперь вся реализация с Базой данных у меня прописана в этих методах:

	public function store($data): void
	{
		$tags = $data['tags'] ?? [];
		unset($data['tags']);
		$post = Post::create($data);
		// Должен быть создан нами метод отношений tags() в модели Post.php
		// Но это не вставит данные во временные поля: время создания, изменения. Да и эти поля обычно не нужны, их удаляют
		// Этот метод может выполнять две задачи: 1) Если обращаться $post->tags - вернёт массив полученных значений. 2) Если обращаться $post->tags() - сохраняем запрос в базу и можем продолжить этот запрос
		$post->tags()->attach($tags);
	}

	public function update($post, $data): void
	{
		$tags = $data['tags'] ?? [];
		unset($data['tags']);
		// Далее, обновляем данные этой записи:
		$post->update($data);
		// Нужно чтобы все старые Теги удалялись. И добавлялись Теги которые приходят:	attach здесь уже не подойдёт
		$post->tags()->sync($tags);	// sync() по сути дела, он все моменты что существовали до этого удаляет, и прибавляет только те что приходят
	}

	public function posts_list()
	{
		$posts = Post::paginate(10);
		return $posts;
	}
}