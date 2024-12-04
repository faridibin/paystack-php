<?php

namespace Faridibin\Paystack\Services\Transfers;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Transfers\TransfersInterface;

class Transfers implements TransfersInterface
{
    /**
     * The Transfers service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        ?string $secretKey = null,
        private ?ClientInterface $client = null
    ) {
        $this->client = $client ?? new Client($secretKey);
    }
}
