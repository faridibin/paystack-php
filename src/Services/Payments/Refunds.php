<?php

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\RefundsInterface;
use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\Currency;

class Refunds implements RefundsInterface
{
    /**
     * The Refunds service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
    }

    /**
     * Create a refund.
     * Initiate a refund on your integration
     *
     * @param string $identifier
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createRefund(string $identifier, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/refund', [
            'json' => [
                'transaction' => $identifier,
                ...$optional
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * List refunds.
     * List refunds available on your integration
     *
     * @param string $transactionId
     * @param Currency|string $currency
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listRefunds(string $transactionId, Currency|string $currency, array $optional = []): Response
    {
        $currency instanceof Currency ? $currency->value : $currency;

        $response = $this->client->send('GET', '/refund', [
            'query' => [
                'transaction' => $transactionId,
                'currency' => $currency,
                ...$optional
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Fetch a refund.
     * Get details of a refund on your integration
     *
     * @param string $id
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchRefund(string $id): Response
    {
        $response = $this->client->send('GET', "/refund/{$id}");

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }
}