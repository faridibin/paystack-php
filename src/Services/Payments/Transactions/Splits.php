<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services\Payments\Transactions;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\Transactions\SplitsInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Bearer;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\SplitType;

/**
 * Service for managing transaction split configurations.
 */
class Splits implements SplitsInterface
{
    /**
     * The Splits service constructor.
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
     * Create Split.
     * Create a split payment on your integration
     *
     * @param string $name
     * @param \Faridibin\Paystack\Enums\SplitType|string $type
     * @param \Faridibin\Paystack\Enums\Currency|string $currency
     * @param array $subaccounts
     * @param \Faridibin\Paystack\Enums\Bearer|string $bearer
     * @param string $bearerSubaccount
     * @return Response
     */
    public function createSplit(string $name, SplitType|string $type, Currency|string $currency, array $subaccounts, Bearer|string $bearer, string $bearerSubaccount): Response
    {
        $response = $this->client->send('POST', '/split', [
            'json' => [
                'name' => $name,
                'type' => $type,
                'currency' => $currency,
                'subaccounts' => $subaccounts,
                'bearer' => $bearer,
                'bearer_subaccount' => $bearerSubaccount
            ]
        ]);

        return new Response($response);
    }

    /**
     * List Splits.
     * List the transaction splits available on your integration
     *
     * @param string $name
     * @param bool $active
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function listSplit(string $name, bool $active = true, int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/split', [
            'query' => [
                'name' => $name,
                'active' => var_export($active, true),
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Split.
     * Get details of a split on your integration
     *
     * @param string $id
     * @return Response
     */
    public function fetchSplit(string $id): Response
    {
        $response = $this->client->send('GET', "/split/{$id}");

        return new Response($response);
    }

    /**
     * Update Split.
     * Update a transaction split details on your integration
     *
     * @param string $id
     * @param array $data
     * @return Response
     */
    public function updateSplit(string $id, array $data): Response
    {
        $response = $this->client->send('PUT', "/split/{$id}", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Add Subaccount Split.
     * Add a Subaccount to a Transaction Split, or update the share of an existing Subaccount in a Transaction Split
     *
     * @param string $id
     * @param string $subaccount
     * @param int $share
     * @return Response
     */
    public function addSubaccountSplit(string $id, string $subaccount, int $share): Response
    {
        $response = $this->client->send('POST', "/split/{$id}/subaccount/add", [
            'json' => [
                'subaccount' => $subaccount,
                'share' => $share
            ]
        ]);

       return new Response($response);
    }

    /**
     * Remove Subaccount Split.
     * Remove a Subaccount from a Transaction Split
     *
     * @param string $id
     * @param string $subaccount
     * @return Response
     */
    public function removeSubaccountSplit(string $id, string $subaccount): Response
    {
        $response = $this->client->send('POST', "/split/{$id}/subaccount/remove", [
            'json' => [
                'subaccount' => $subaccount
            ]
        ]);

       return new Response($response);
    }
}
