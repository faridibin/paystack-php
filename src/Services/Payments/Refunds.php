<?php

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\RefundsInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;

class Refunds implements RefundsInterface
{
    /**
     * The Refunds service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        ?string $secretKey = null,
        private ?ClientInterface $client = null
    ) {
        $this->client = $client ?? new Client($secretKey);
    }

    /**
     * Create a refund.
     * Initiate a refund on your integration
     *
     * @param string $identifier
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listRefunds(string $transactionId, Currency|string $currency, array $optional = []): Response
    {
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
