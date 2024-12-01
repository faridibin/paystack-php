<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\PaymentsInterface;
use Faridibin\Paystack\DTOs\Response;

class Payments implements PaymentsInterface
{
    /**
     * The Payments service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
    }

    /**
     * Initialize a payment transaction.
     *
     * @param array $data
     * @return Response
     */
    public function initializeTransaction(array $data = []): Response
    {
        $response = $this->client->send('POST', '/transaction/initialize', [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Verify a payment transaction.
     *
     * @param string $reference
     * @return Response
     */
    public function verifyTransaction(string $reference): Response
    {
        $response = $this->client->send('GET', "/transaction/verify/{$reference}");

        return new Response($response);
    }

    /**
     * Create a charge.
     *
     * @param array $data
     * @return Response
     */
    public function createCharge(array $data = []): Response
    {
        $response = $this->client->send('POST', '/charge', [
            'json' => $data
        ]);

        return new Response($response);
    }
}
