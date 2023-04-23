<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Post\BaseController;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Post;

class IndexController extends BaseController
{
	public function __invoke(FilterRequest $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	{
		// 21.04.2023 перенёс работу в сервисы:
		$posts = $this->service->posts_list($request);
		return view('admin.post.index', compact('posts'));		// Возвращаем шаблон "resources/views/admin/post/index.blade.php"
    }
}
