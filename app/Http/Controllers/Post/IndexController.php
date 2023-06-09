<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class IndexController extends BaseController
{
	public function __invoke(FilterRequest $request)	//: \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	{
		// Здесь проверял на админа работу Policy, который был создан с привязкой к модели User:
		// $this->authorize('view', auth()->user());

		// $data = $request->validated();
		//dd($data);
		// $posts = Post::all();
		// $posts = Post::paginate(10);
		// 21.04.2023 перенёс работу в сервисы:
		$posts = $this->service->posts_list($request);
		//$posts = Post::all();
		//$posts = Post::allPaginate(10);		//	dd($posts);		// relations
		// $posts = Post::paginate(10);
		//$posts = Post::with('tags', 'category')->paginate(10);

		// для Rest API:
		// return PostResource::collection($posts);

		return view('post.index', compact('posts'));
    }
}
