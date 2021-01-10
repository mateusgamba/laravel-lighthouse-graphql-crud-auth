<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model
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
    public function create(array $data): Modal
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Modal
     */
    public function update(array $data, int $id): Modal
    {
        $modal = $this->model->find($id);
        $modal->update($data);
        return $modal;
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
