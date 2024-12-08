<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Generic;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class StateDTO implements DataTransferObject
{
    /**
     * The State DTO constructor.
     *
     * @param string $name
     * @param string $slug
     * @param string $abbreviation
     */
    public function __construct(
        public readonly string $name,
        public readonly string $slug,
        public readonly string $abbreviation,
    ) {
        //
    }

    /**
     * Convert the state to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'abbreviation' => $this->abbreviation,
        ];
    }
}
