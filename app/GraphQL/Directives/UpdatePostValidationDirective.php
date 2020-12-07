<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdatePostValidationDirective extends ValidationDirective
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:App\Models\Post,id'],
            'post.title' => ['sometimes', 'required', 'string', 'max:255'],
            'post.content' => ['sometimes', 'required', 'string'],
        ];
    }
}
