<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class Relationship implements DataTransferObject
{
    public function __construct(...$args)
    {
        // TODO: Implement constructor
        // dd($args);
    }

    public function toArray(): array
    {
        // TODO: Implement toArray() method.
        return [];
    }
}
