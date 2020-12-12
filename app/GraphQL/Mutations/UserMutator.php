<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Arr;

class UserMutator
{
    /**
     * @param null $root
     * @param array $request
     * @return array
     */
    public function store($root = null, array $request): array
    {
        $request = Arr::except($request, 'directive', 'password_confirmation');
        User::create($request);
        return ['message' => __('messages.registered')];
    }
}
