<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Exceptions;

class ApiException extends PaystackException
{
    /**
     * ApiException constructor.
     *
     * @param string $message
     * @param int $code
     * @param array $errorsBag
     */
    public function __construct(string $message, int $code = 400, array $errorsBag = [])
    {
        parent::__construct($message, $code, $errorsBag);
    }
}
