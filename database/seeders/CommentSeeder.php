<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $post = Post::first();

        Comment::create([
            'post_id' => $post->id,
            'name' => 'John Doe',
            'email' => 'johndoe@testcomment.com',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ]);
    }
}
