<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param array $filter
     * @return Builder
     */
    public function scopeQuery(array $filter = []): Builder
    {
        $query = $this->model->query();
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
}
