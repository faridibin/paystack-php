<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Exceptions;

class ValidationException extends PaystackException
{
    /**
     * ValidationException constructor.
     *
     * @param string $message
     * @param array $errors
     */
    public function __construct(string $message, private array $errors = [])
    {
        parent::__construct($message, 422);
    }

    /**
     * Get the errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
