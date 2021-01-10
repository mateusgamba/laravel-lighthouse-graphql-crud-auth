<?php

namespace App\Services;

abstract class AbstractService
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @param string $method
     * @param array $arguments
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->repository, $method], $arguments);
    }
}
