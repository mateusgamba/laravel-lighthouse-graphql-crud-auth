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
    public function store(?string $root, array $request): array
    {
        $request = Arr::except($request, 'directive', 'password_confirmation');
        User::create($request);
        return ['message' => __('messages.registered')];
    }

    /**
     * @param null $root
     * @param array $request
     * @return User
     */
    public function update(?string $root, array $request): User
    {
        $user = User::find($request['id']);
        $user->fill($request['fields'])->save();
        return $user;
    }
}
