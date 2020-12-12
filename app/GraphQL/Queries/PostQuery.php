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
        $query = Post::query();

        if ($filter = $request['filter']) {
            foreach (array_keys(array_filter($filter)) as $field) {
                $value = $filter[$field];
                if (is_string($value)) {
                    $query = $query->where($field, 'like', $value);
                }
                if (is_array($value)) {
                    $query = $query->whereIn($field, $value);
                }
            }
        }
        return $query;
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
