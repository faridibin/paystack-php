<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Exceptions;

class PaystackException extends \Exception
{
    /**
     * The errors bag
     *
     * @var array
     */
    private array $errorsBag = [];

    /**
     * PaystackException constructor.
     *
     * @param string $message
     * @param int $code
     * @param array $errors
     */
    public function __construct(string $message, int $code = 0, array $errorsBag = [])
    {
        parent::__construct($message, $code);

        $this->errorsBag = $errorsBag;
    }

    /**
     * Get the errors bag
     *
     * @return array
     */
    public function getErrorsBag(): array
    {
        return $this->errorsBag;
    }
}
