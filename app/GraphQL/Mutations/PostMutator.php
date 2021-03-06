<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Support\Arr;

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
    public function store(?string $root, array $request): Post
    {
        $request = Arr::except($request, 'directive');
        return $this->service->create($request);
    }

    /**
     * @param null $root
     * @param array $request
     * @return Post
     */
    public function update(?string $root, array $request): Post
    {
        return $this->service->update($request['post'], $request['id']);
    }

    /**
     * @param null $root
     * @param array $request
     * @return array
     */
    public function delete(?string $root, array $request): array
    {
        $this->service->destroy($request['id']);
        return ['message' => __('messages.deleted')];
    }
}
