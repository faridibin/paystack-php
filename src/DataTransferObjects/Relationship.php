<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class Relationship implements DataTransferObject
{
    /**
     * The Relationship DTO constructor.
     *
     * @param mixed ...$args
     */
    public function __construct(...$args)
    {
        // TODO: Implement constructor
        dd($args);
    }

    /**
     * Convert the relationship to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        // TODO: Implement toArray() method.
        return [];
    }
}
