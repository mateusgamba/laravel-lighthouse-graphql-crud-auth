<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        $request['user_id'] = Auth::user()->id;
        return Post::create($request);
    }

    /**
     * @param null $root
     * @param array $request
     * @return Post
     */
    public function update($root = null, array $request): Post
    {
        $post = Post::find($request['id']);
        $request['user_id'] = Auth::user()->id;
        $post->fill($request['post'])->save();
        return $post;
    }

    /**
     * @param null $root
     * @param array $request
     * @return array
     */
    public function delete($root = null, array $request): array
    {
        Post::destroy($request['id']);
        return ['message' => __('messages.deleted')];
    }
}
