<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
	public function __invoke(UpdateRequest $request, Post $post): RedirectResponse
	{
		$data = $request->validated();
		$tags = $data['tags'];
		unset($data['tags']);
		// Далее, обновляем данные этой записи:
		$post->update($data);
		// Нужно чтобы все старые Теги удалялись. И добавлялись Теги которые приходят:	attach здесь уже не подойдёт
		$post->tags()->sync($tags);	// sync() по сути дела, он все моменты что существовали до этого удаляет, и прибавляет только те что приходят
		return redirect()->route('post.show', $post->id);
	}

	public function __invoke1(Post $post): RedirectResponse
	{
		$data = request()->validate([
			'title' => 'required|string',
			'content' => 'string',
			'image' => 'string',
			'category_id' => '',
			'tags' => '',
		]);
		$tags = $data['tags'];
		unset($data['tags']);
		// Далее, обновляем данные этой записи:
		$post->update($data);

		// Нужно чтобы все старые Теги удалялись. И добавлялись Теги которые приходят:	attach здесь уже не подойдёт
		$post->tags()->sync($tags);	// sync() по сути дела, он все моменты что существовали до этого удаляет, и прибавляет только те что приходят

		return redirect()->route('post.show', $post->id);
    }
}
