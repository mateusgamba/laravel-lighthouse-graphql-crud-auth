<?php

namespace App\GraphQL\Exceptions;

use Exception;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class CustomException extends Exception implements RendersErrorsExtensions
{

    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    /**
     * @return bool
     */
    public function isClientSafe(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return 'custom';
    }

    /**
     * @return array
     */
    public function extensionsContent(): array
    {
        return [];
    }
}
