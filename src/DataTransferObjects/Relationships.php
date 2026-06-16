<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

/**
 * Represents relational data in a Paystack API response.
 *
 * @todo Implementation is pending.
 */
class Relationships implements DataTransferObject
{
    /**
     * The raw relationships data.
     */
    private readonly array $relationships;

    /**
     * The Relationship DTO constructor.
     *
     * @param array $relationships
     */
    public function __construct(array $relationships = [])
    {
        $this->relationships = $relationships;
    }

    /**
     * Convert the relationship to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->relationships;
    }
}
