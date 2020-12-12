<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateUserValidationDirective extends ValidationDirective
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:App\Models\User,id'],
            'fields.name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],
            'fields.email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                "unique:users,email,{$this->args['id']}",
            ],
            'fields.password' => [
                'sometimes',
                'required',
                'string',
                'min:6',
                'max:255',
                'confirmed'
            ],
        ];
    }
}
