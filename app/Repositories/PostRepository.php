<?php

namespace App\Repositories;

use App\Models\Post;
use App\Traits\Filterable;

class PostRepository extends AbstractRepository
{
    use Filterable;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }
}
