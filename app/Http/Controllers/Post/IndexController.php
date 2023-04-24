<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Post;

class IndexController extends BaseController
{
	public function __invoke(FilterRequest $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	{
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
		return view('post.index', compact('posts'));
    }
}
