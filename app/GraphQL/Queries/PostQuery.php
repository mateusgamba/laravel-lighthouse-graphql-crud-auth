<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Builder;

class PostQuery
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
     * @return Builder
     */
    public function all($root = null, array $request): Builder
    {
        return $this->service->all($request['filter'] ?? null);
    }

    /**
     * @param null $root
     * @param array $request
     * @return Post
     */
    public function find($root, array $request): Post
    {
        return $this->service->find((int)$request['id']);
    }
}
