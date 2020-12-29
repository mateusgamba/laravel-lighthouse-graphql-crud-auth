<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Builder;

class PostService
{
    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post
    {
        return $this->repository->find($id);
    }

    /**
     * @param array|null $filter
     * @return Builder
     */
    public function all(?array $filter): Builder
    {
        return $this->repository->all($filter);
    }

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        return $this->repository->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Post
     */
    public function update(array $data, int $id): Post
    {
        return $this->repository->update($data, $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return $this->repository->destroy($id);
    }
}
