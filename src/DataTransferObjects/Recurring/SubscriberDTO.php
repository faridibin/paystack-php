<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Recurring;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Status;
use Faridibin\Paystack\Traits\MapToArray;

class SubscriberDTO implements DataTransferObject
{
    use MapToArray;

    /**
     * The currency of the subscription
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
     * The subscriber DTO constructor.
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
        public readonly ?string $customer_code = null,
        public readonly ?string $customer_first_name = null,
        public readonly ?string $customer_last_name = null,
        public readonly ?string $customer_email = null,
        public readonly ?int $customer_total_amount_paid = null,
        Currency|string|null $currency = null,
        Status|string|null $subscription_status = null,

        ...$args // TODO: Remove this line
    ) {
        if (!($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        if (!($subscription_status instanceof Status)) {
            $this->status = Status::from($subscription_status);
        }

        if (!empty($args)) {
            dump([
                'subscriber_args' => $args, // TODO: Remove this line
            ]);
        }
    }
}
