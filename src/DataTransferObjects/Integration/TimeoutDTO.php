<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Integration;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class TimeoutDTO implements DataTransferObject
{
    /**
     * The Timeout DTO constructor.
     *
     * @param int $payment_session_timeout
     */
    public function __construct(
        public readonly int $payment_session_timeout,
    ) {
        //
    }

    /**
     * Convert the DTO to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'payment_session_timeout' => $this->payment_session_timeout,
        ];
    }
}
