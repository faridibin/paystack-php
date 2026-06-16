<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\DataTransferObjects;

/**
 * Base contract for all Paystack Data Transfer Objects.
 *
 * All DTOs must implement this interface to be serializable as arrays.
 */
interface DataTransferObject
{
    /**
     * Convert the DTO to an array
     *
     * @return array
     */
    public function toArray(): array;
}
