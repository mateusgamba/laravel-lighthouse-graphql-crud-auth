<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService extends AbstractService
{
     /**
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }
}
