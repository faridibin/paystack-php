<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Recurring;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Status;

class SubscriberDTO implements DataTransferObject
{
    /**
     * The customer of the subscription
     *
     * @var Currency $currency
     */
    public readonly Currency $currency;

    /**
     * The status of the subscription
     *
     * @var Status $status
     */
    public readonly Status $status;

    /**
     * The Subscription DTO constructor.
     *
     * @param string $customer_code
     * @param string $customer_first_name
     * @param string $customer_last_name
     * @param string $customer_email
     * @param int|null $customer_total_amount_paid
     * @param Currency|string $currency
     * @param Status|string $subscription_status
     */
    public function __construct(
        public readonly ?string $customer_code,
        public readonly ?string $customer_first_name,
        public readonly ?string $customer_last_name,
        public readonly ?string $customer_email,
        public readonly ?int $customer_total_amount_paid,
        Currency|string|null $currency,
        Status|string|null $subscription_status
    ) {


        if (!($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        if (!($subscription_status instanceof Status)) {
            $this->status = Status::from($subscription_status);
        }
    }

    /**
     * Convert the subscription to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'customer_code' => $this->customer_code,
            'customer_first_name' => $this->customer_first_name,
            'customer_last_name' => $this->customer_last_name,
            'customer_email' => $this->customer_email,
            'customer_total_amount_paid' => $this->customer_total_amount_paid,
            'currency' => $this->currency,
            'status' => $this->status
        ];
    }
}
