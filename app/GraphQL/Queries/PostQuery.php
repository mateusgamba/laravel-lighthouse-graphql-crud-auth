<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use Illuminate\Support\Collection;

class PostQuery
{
    public function all($root, array $request): Collection
    {
        return Post::all();
    }
}
