<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\DirectDebitInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Service for managing Direct Debit mandates and authorizations.
 */
class DirectDebit implements DirectDebitInterface
{
    /**
     * The DirectDebit service constructor.
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
     * Trigger Activation Charge
     * Trigger an activation charge for Direct Debit customers
     *
     * @param array $data
     * @return Response
     */
    public function triggerActivationCharge(array $data): Response
    {
        $response = $this->client->send('PUT', '/directdebit/activation-charge', [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * List Mandate Authorizations
     * List all Direct Debit mandate authorizations on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function listMandateAuthorizations(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/directdebit/mandate-authorizations', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }
}
