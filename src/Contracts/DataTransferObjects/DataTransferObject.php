<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\DataTransferObjects;

interface DataTransferObject
{
    /**
     * Convert the DTO to an array
     *
     * @return array
     */
    public function toArray(): array;
}
