<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PostMutator
{
    /**
     * @var PostService
     */
    protected $service;

    /**
     * @param PostService $service
     */
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $request
     * @return Post
     */
    public function store($root = null, array $request): Post
    {
        $request = Arr::except($request, 'directive');
        $request['user_id'] = Auth::user()->id;
        return $this->service->create($request);
    }

    /**
     * @param null $root
     * @param array $request
     * @return Post
     */
    public function update($root = null, array $request): Post
    {
        $request['post']['user_id'] = Auth::user()->id;
        return $this->service->update($request['post'], $request['id']);
    }

    /**
     * @param null $root
     * @param array $request
     * @return array
     */
    public function delete($root = null, array $request): array
    {
        $this->service->destroy($request['id']);
        return ['message' => __('messages.deleted')];
    }
}
