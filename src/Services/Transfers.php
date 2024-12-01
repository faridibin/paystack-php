<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\TransfersInterface;

class Transfers implements TransfersInterface
{
    /**
     * The Transfers service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
    }
}
