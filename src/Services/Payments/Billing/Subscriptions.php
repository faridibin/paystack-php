<?php

namespace Faridibin\Paystack\Services\Payments\Billing;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Billing\SubscriptionsInterface;

class Subscriptions implements SubscriptionsInterface
{
    /**
     * The Subscriptions service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
    }
}
