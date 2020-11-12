<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Post::factory(3)->create();
    }
}
