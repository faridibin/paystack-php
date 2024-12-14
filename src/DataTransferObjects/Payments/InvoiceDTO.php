<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class InvoiceDTO implements DataTransferObject
{
    /**
     * The Authorization DTO constructor.
     *
     */
    public function __construct(
        ...$args
    ) {
        // TODO: Implement constructor logic
        dump($args);
    }

    /**
     * Convert the authorization to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            //
        ];
    }
}
