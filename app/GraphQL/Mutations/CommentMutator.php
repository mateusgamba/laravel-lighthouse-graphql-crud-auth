<?php

namespace App\GraphQL\Mutations;

use App\Models\Comment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CommentMutator
{
    /**
     * @param null $root
     * @param array $request
     * @return Post
     */
    public function store($root = null, array $request): Comment
    {
        $request = Arr::except($request, 'directive');
        return Comment::create($request);
    }

    /**
     * @param null $root
     * @param array $request
     * @return array
     */
    public function delete($root = null, array $request): array
    {
        Comment::destroy($request['id']);
        return ['message' => __('messages.deleted')];
    }
}
