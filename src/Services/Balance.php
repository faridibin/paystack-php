<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\BalanceInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Service for managing integration balance operations on Paystack.
 */
class Balance implements BalanceInterface
{
    /**
     * The Balance service constructor.
     *
     * @param string|null $secretKey The Paystack secret key (used if no client is injected)
     * @param \Faridibin\Paystack\Contracts\ClientInterface|null $client The HTTP client instance
     * @throws \Faridibin\Paystack\Exceptions\PaystackException
     */
    public function __construct(
        ?string $secretKey = null,
        private ?ClientInterface $client = null
    ) {
        $this->client = $client ?? new Client($secretKey);
    }

    /**
     * Fetch Balance
     * Fetch the balance of your integration
     *
     * @return Response
     */
    public function fetch(): Response
    {
        $response = $this->client->send('GET', '/balance');

        return new Response($response);
    }
}
