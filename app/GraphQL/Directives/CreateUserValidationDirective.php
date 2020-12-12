<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class CreateUserValidationDirective extends ValidationDirective
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:App\Models\User,email',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:255',
                'confirmed'
            ],
        ];
    }
}
