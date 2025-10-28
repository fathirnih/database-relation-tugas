<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         $this->call(AdminSeeder::class);

         // Buat 5 user, 5 kategori, dan 50 post
        $users = User::factory(5)->create();
        $categories = Category::factory(5)->create();
        $tags = Tag::factory(10)->create();

        Post::factory(50)->make()->each(function ($post) use ($users, $categories, $tags) {
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->save();

            // Tambahkan tag acak (1-3 per post)
            $post->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
        });
    }
}
