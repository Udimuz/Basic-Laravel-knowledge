<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
		//return parent::toArray($request);
		return [ // Здесь в параметрах $this можем давать только те атрибуты, что приходят из базы, у нас таблица "posts"
			'id' => $this->id,	// Укажем id чтобы посты лучше отличать
			'title' => $this->title,
			'content' => $this->content,
			'image' => $this->image,
			'likes' => $this->likes,
			'category_id' => $this->category_id,
			'tags' => $this->tags,
		];
    }
}
