<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use Illuminate\Support\Arr;

class PostMutator
{
    /**
     * @param null $root
     * @param array $request
     * @return Post
     */
    public function store($root = null, array $request): Post
    {
        $request = Arr::except($request, 'directive');

        return Post::create($request);
    }

    /**
     * @return array
     */
    public function update($root = null, array $request): array
    {
        $post = Post::find($request['id']);
        return $post->fill($request['post'])->save();
    }

    public function delete($root = null, array $request): array
    {
        Post::destroy($request['id']);

        return ['message' => __('messages.deleted')];
    }
}
