<?php

namespace App\Exceptions;

class UserNotFoundException extends ApiException
{
    protected int $statusCode = 404;

    public function __construct(string $message = 'User not found')
    {
        parent::__construct($message, $this->statusCode);
    }
}
