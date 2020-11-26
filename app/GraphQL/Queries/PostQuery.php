<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use Illuminate\Support\Collection;

class PostQuery
{
    /**
     * @param null $root
     * @param array $request
     * @return Collection
     */
    public function all($root = null, array $request): Collection
    {
        return Post::all();
    }

    /**
     * @param null $root
     * @param array $request
     * @return Collection
     */
    public function find($root, array $request): Post
    {
        return Post::find($request['id']);
    }
}
