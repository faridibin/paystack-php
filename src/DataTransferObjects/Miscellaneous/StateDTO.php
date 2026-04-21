<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Miscellaneous;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Traits\MapToArray;

/**
 * Data Transfer Object representing a state or region supported by Paystack.
 *
 * Used for address verification (AVS) within a given country.
 */
class StateDTO implements DataTransferObject
{
    use MapToArray;

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
}
