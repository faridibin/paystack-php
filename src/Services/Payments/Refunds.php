<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\RefundsInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;

/**
 * Service for initiating and managing transaction refunds.
 */
class Refunds implements RefundsInterface
{
    /**
     * The Refunds service constructor.
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
     * Create a refund.
     * Initiate a refund on your integration
     *
     * @param string $identifier
     * @param array $optional
     * @return Response
     */
    public function createRefund(string $identifier, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/refund', [
            'json' => [
                'transaction' => $identifier,
                ...$optional
            ]
        ]);

       return new Response($response);
    }

    /**
     * Retry a refund.
     * Retry a failed refund on your integration
     *
     * @param string $identifier
     * @param Currency|string $currency
     * @param string $bankId
     * @param string $accountNumber
     * @return Response
     */
    public function retryRefund(string $identifier, Currency|string $currency, string $bankId, string $accountNumber): Response
    {
        $response = $this->client->send('POST', "/retry_with_customer_details/{$identifier}", [
            'json' => [
                'refund_account_details' => [
                    'currency' => $currency,
                    'bank_id' => $bankId,
                    'account_number' => $accountNumber
                ],
            ]
        ]);

       return new Response($response);
    }

    /**
     * List refunds.
     * List refunds available on your integration
     *
     * @param string $transactionId
     * @param Currency|string $currency
     * @param array $optional
     * @return Response
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

       return new Response($response);
    }

    /**
     * Fetch a refund.
     * Get details of a refund on your integration
     *
     * @param string $id
     * @return Response
     */
    public function fetchRefund(string $id): Response
    {
        $response = $this->client->send('GET', "/refund/{$id}");

       return new Response($response);
    }
}
