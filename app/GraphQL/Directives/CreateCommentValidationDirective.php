<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class CreateCommentValidationDirective extends ValidationDirective
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'content' => ['required', 'string'],
            'post_id' => ['required', 'integer', 'exists:App\Models\Post,id'],
        ];
    }
}
