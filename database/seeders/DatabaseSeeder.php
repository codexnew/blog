<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $users = User::factory(4)->create();

        $categoryNames = ['Technology', 'Travel', 'Lifestyle', 'Business'];
        $categories = collect($categoryNames)->map(fn ($name) => Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]));

        $tagNames = ['Laravel', 'PHP', 'Design', 'Startup', 'Tips', 'Coding'];
        $tags = collect($tagNames)->map(fn ($name) => Tag::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]));

        $allUsers = $users->prepend($admin);

        for ($i = 1; $i <= 18; $i++) {
            $title = "Sample Blog Post {$i}";
            $post = Post::create([
                'user_id' => $allUsers->random()->id,
                'category_id' => $categories->random()->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => "This is sample content for {$title}. It demonstrates seeded blog data.",
                'featured_image' => 'https://picsum.photos/seed/post' . $i . '/1200/600',
                'status' => $i % 3 === 0 ? 'draft' : 'published',
                'created_at' => now()->subMonths(rand(0, 8))->subDays(rand(0, 25)),
            ]);

            $post->tags()->sync($tags->random(rand(2, 4))->pluck('id')->toArray());

            for ($j = 1; $j <= rand(1, 4); $j++) {
                Comment::create([
                    'user_id' => $allUsers->random()->id,
                    'post_id' => $post->id,
                    'content' => "Sample comment {$j} on {$title}.",
                ]);
            }
        }
    }
}
