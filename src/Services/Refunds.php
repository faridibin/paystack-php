<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\RefundsInterface;
use Faridibin\Paystack\DTOs\Response;

class Refunds implements RefundsInterface
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
    /**
     * @inheritDoc
     */
    public function createRefund(array $data): Response
    {
        // 
    }

    /**
     * @inheritDoc
     */
    public function fetchRefund(string $id): Response
    {
        // 
    }

    /**
     * @inheritDoc
     */
    public function listRefunds(string $currency, array $options = []): Response
    {
        // 
    }
}
