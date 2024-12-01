<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Exceptions;

class RateLimitException extends PaystackException
{
    /**
     * RateLimitException constructor.
     *
     * @param string $message
     * @param array $errorsBag
     */
    public function __construct(string $message = 'Too many requests', array $errorsBag = [])
    {
        parent::__construct($message, 429, $errorsBag);
    }
}
