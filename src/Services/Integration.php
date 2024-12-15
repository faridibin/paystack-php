<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\IntegrationInterface;
use Faridibin\Paystack\DataTransferObjects\Integration\TimeoutDTO;
use Faridibin\Paystack\DataTransferObjects\Response;

class Integration implements IntegrationInterface
{
    /**
     * The Verification service constructor.
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
     * Fetch Timeout
     * Fetch the payment session timeout on your integration
     *
     * @return Response
     */
    public function fetchTimeout(): Response
    {
        $response = $this->client->send('GET', '/integration/payment_session_timeout');

        return new Response($response, TimeoutDTO::class);
    }

    /**
     * Update Timeout
     * Update the payment session timeout on your integration
     *
     * @param int $timeout
     * @return Response
     */
    public function updateTimeout(int $timeout): Response
    {
        $response = $this->client->send('PUT', '/integration/payment_session_timeout', [
            'json' => [
                'timeout' => $timeout
            ]
        ]);

        return new Response($response, TimeoutDTO::class);
    }
}
