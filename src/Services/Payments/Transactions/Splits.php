<?php

namespace Faridibin\Paystack\Services\Payments\Transactions;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Transactions\SplitsInterface;
use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\Bearer;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\SplitType;

class Splits implements SplitsInterface
{
    /**
     * The Transaction Splits service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
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
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createSplit(string $name, SplitType|string $type, Currency|string $currency, array $subaccounts, Bearer|string $bearer, string $bearerSubaccount): Response
    {
        $type instanceof SplitType ? $type->value : $type;
        $currency instanceof Currency ? $currency->value : $currency;
        $bearer instanceof Bearer ? $bearer->value : $bearer;

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

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
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
     * @return \Faridibin\Paystack\DTOs\Response
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
     * @return \Faridibin\Paystack\DTOs\Response
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
     * @param string $name
     * @param bool $active
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function updateSplit(string $id, string $name, bool $active, array $optional = []): Response
    {
        $response = $this->client->send('PUT', "/split/{$id}", [
            'json' => [
                'name' => $name,
                'active' => var_export($active, true),
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
     * Add Subaccount Split.
     * Add a Subaccount to a Transaction Split, or update the share of an existing Subaccount in a Transaction Split
     *
     * @param string $id
     * @param string $subaccount
     * @param int $share
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function addSubaccountSplit(string $id, string $subaccount, int $share): Response
    {
        $response = $this->client->send('POST', "/split/{$id}/subaccount/add", [
            'json' => [
                'subaccount' => $subaccount,
                'share' => $share
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Remove Subaccount Split.
     * Remove a Subaccount from a Transaction Split
     *
     * @param string $id
     * @param string $subaccount
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function removeSubaccountSplit(string $id, string $subaccount): Response
    {
        $response = $this->client->send('POST', "/split/{$id}/subaccount/remove", [
            'json' => [
                'subaccount' => $subaccount
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }
}