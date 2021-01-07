<?php

namespace App\Repositories;

use App\Models\Post;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PostRepository
{
    use Filterable;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post
    {
        return $this->model->find($id);
    }

    /**
     * @param array|null $filter
     * @return Builder
     */
    public function all(?array $filter): Builder
    {
        return $this->scopeQuery($filter);
    }

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Post
     */
    public function update(array $data, int $id): Post
    {
        $post = $this->model->find($id);
        $post->update($data);
        return $post;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $this->model->destroy($id);
        return true;
    }
}
