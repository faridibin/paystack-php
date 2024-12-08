<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Exceptions;

class AuthenticationException extends PaystackException
{
    /**
     * Create a new AuthenticationException instance
     *
     * @param string $message The exception message
     */
    public function __construct(string $message = 'Invalid API key provided')
    {
        parent::__construct($message, 401);
    }
}
