<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
		//echo 'Yes';
		//$posts = Post::factory(10)->make();
		//dd($posts);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

		// Выполняем именно в такой последовательности. Сначала создаём категории:
		\App\Models\Category::factory(10)->create();	// Создаст 10 категорий
		$tags = \App\Models\Tag::factory(20)->create();	// 20 тегов
		$posts = \App\Models\Post::factory(30)->create();	// 30 постов-сообщений

		// Теперь нужно Теги привязать к Постам:	заполнит связующую теги и посты таблицу "post_tags"
		foreach ($posts as $post) {
			//$tagsIds = $tags->random(5)->pluck('id');		// Здесь обучали поставить просто цифру 5: но я выше попробовал сделать лучше
			//Вставит по 1-5 тегов к каждому посту: по несколько записей в таблицу тегов. Т.е. у каждого сообщения теперь будет по несколько случайных тегов
			$tagsIds = $tags->random(random_int(1,5))->pluck('id');
			$post->tags()->attach($tagsIds);
		}
    }
}
