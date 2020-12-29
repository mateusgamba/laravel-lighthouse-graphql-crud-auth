<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostRepository
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post
    {
        return $this->post->find($id);
    }

    /**
     * @param array|null $filter
     * @return Builder
     */
    public function all(?array $filter): Builder
    {
        $query = $this->post->query();

        if (!empty($filter)) {
            foreach (array_keys(array_filter($filter)) as $field) {
                $value = $filter[$field];
                if (is_string($value)) {
                    $query = $query->where($field, 'like', $value);
                }
                if (is_array($value)) {
                    $query = $query->whereIn($field, $value);
                }
            }
        }
        return $query;
    }

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        return $this->post->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Post
     */
    public function update(array $data, int $id): Post
    {
        $post = $this->post->find($id);
        $post->fill($data)->save();
        return $post;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $this->post->destroy($id);
        return true;
    }
}
