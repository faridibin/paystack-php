<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class CustomerDTO implements DataTransferObject
{
    /**
     * The Customer DTO constructor.
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $customer_code
     */
    public function __construct(
        public readonly ?string $first_name,
        public readonly ?string $last_name,
        public readonly ?string $email,
        public readonly ?string $customer_code,
    ) {
        //

    }

    /**
     * Convert the customer to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'customer_code' => $this->customer_code,
        ];
    }
}
