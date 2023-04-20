<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $table = 'posts';
	protected $guarded = [];

	public $somePropert = 'Dima';

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function category_1()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}

	public function tags_1()
	{
		return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
	}
}
