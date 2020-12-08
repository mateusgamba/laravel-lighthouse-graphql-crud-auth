<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class FindCommentIdValidationDirective extends ValidationDirective
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:App\Models\Comment,id'],
        ];
    }
}



