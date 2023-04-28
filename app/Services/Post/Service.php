<?php

namespace App\Services\Post;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Post;

class Service
{
	// Теперь вся реализация с Базой данных у меня прописана в этих методах:

	public function store($data)
	{
		$tags = $data['tags'] ?? [];
		unset($data['tags']);
		$post = Post::create($data);
		// Должен быть создан нами метод отношений tags() в модели Post.php
		// Но это не вставит данные во временные поля: время создания, изменения. Да и эти поля обычно не нужны, их удаляют
		// Этот метод может выполнять две задачи: 1) Если обращаться $post->tags - вернёт массив полученных значений. 2) Если обращаться $post->tags() - сохраняем запрос в базу и можем продолжить этот запрос
		$post->tags()->attach($tags);

		return $post;
	}

	public function update(Post $post, $data): Post
	{
		$tags = $data['tags'] ?? [];
		unset($data['tags']);
		// Далее, обновляем данные этой записи:
		$post->update($data);
		// Нужно чтобы все старые Теги удалялись. И добавлялись Теги которые приходят:	attach здесь уже не подойдёт
		$post->tags()->sync($tags);	// sync() по сути дела, он все моменты что существовали до этого удаляет, и прибавляет только те что приходят

		return $post->fresh();	// После обновления, советуют возвращать данные используя fresh(), но у меня и $post возвращало новые данные
	}

	public function posts_list(FilterRequest $request) {
		// Фильтрация - делаем отсеивание данных:
		$data = $request->validated();

		$page = $data['page'] ?? 1;		// Так отлавливается, какая страница на данный момент открыта
		$perPage = $data['per_page'] ?? 10;
		// Не забыть эти параметры 'page', 'per_page' добавить в фильтр FilterRequest

		$filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
		return Post::filterPaginate($filter, $perPage, $page);
	}

	public function posts_list3(FilterRequest $request) {
		// Фильтрация - делаем отсеивание данных:
		$data = $request->validated();

		$filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
		// Этот filter() появился у модели Post потому что мы ему передали Trait по имени use "Filterable", а у него есть метод filter()
		// Здесь можно было и на скоуп отправить, но из-за одной небольшой строки, я не стал:	Post::filterPaginate($filter, $perPage, $page);
		return Post::filter($filter)->with('tags', 'category')->paginate(10);
	}

	public function posts_list2(FilterRequest $request) {
		// Фильтрация - делаем отсеивание данных:
		$data = $request->validated();

		$filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
		// Этот filter() появился у модели Post потому что мы ему передали Trait по имени use "Filterable", а у него есть метод filter()
		// $posts = Post::filter($filter)->get()
		// dd($posts);
		return Post::filter($filter)->paginate(10);
	}

	public function posts_list1(FilterRequest $request)
	{
		// Фильтрация - делаем отсеивание данных:
		$data = $request->validated();

		$page = $data['page'] ?? 1;		// Так отлавливается, какая страница на данный момент открыта
		$perPage = $data['per_page'] ?? 10;
		// Не забыть эти параметры 'page', 'per_page' добавить в фильтр FilterRequest

		//$posts = Post::paginate(10);
//		$posts = Post::where('is_published', 1)
//			->paginate(10);
		$query = Post::query();

		//	http://first-project.loc/posts?category_id=2
		if (isset($data['category_id']))
			$query->where('category_id', $data['category_id']);

		// http://first-project.loc/posts?category_id=19&title=um	http://first-project.loc/posts?title=um
		if (isset($data['title']))
			$query->where('title', 'like', "%{$data['title']}%");

		//$posts = $query->get();	dd($posts);
		$posts = $query->paginate(3);
		return $posts;
	}
}