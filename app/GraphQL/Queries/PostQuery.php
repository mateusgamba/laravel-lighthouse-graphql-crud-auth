<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostQuery
{
    /**
     * @param null $root
     * @param array $request
     * @return Builder
     */
    public function all($root = null, array $request): Builder
    {
        return Post::query();
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
