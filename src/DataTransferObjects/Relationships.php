<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class Relationships implements DataTransferObject
{
    /**
     * The Relationship DTO constructor.
     *
     * @param array $relationships
     */
    public function __construct(array $relationships = [])
    {
        // TODO: Implement constructor

        foreach ($relationships as $key => $relationship) {
            dump($key, $relationship);

            // $this->items[$key] = $this->resolveRelationship(
            //     $key,
            //     $relationship['type'],
            //     $relationship['data'],
            //     $relationship['supported_currencies'] ?? null
            // );
        }

        // dd(
        //     $this,
        //     $relationships
        // );
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
