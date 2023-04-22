<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		return [
			'title' => fake()->sentence(5),	// fake()->name
			'content' => fake()->text(255),
			'image' => fake()->imageUrl,
			'likes' => random_int(1,1000),	// Создадим случайную цифру
			'is_published' => random_int(0,1),
			'category_id' => \App\Models\Category::get()->random()->id,	// Тоже выведет случайное значение из существующих Категорий
		];
    }
}
