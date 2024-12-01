<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\SubaccountsInterface;
use Faridibin\Paystack\DTOs\Response;

class Subaccounts implements SubaccountsInterface
{
    /**
     * The Subaccounts service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
    }

    /**
     * Create a subaccount.
     *
     * @param string $businessName
     * @param string $bankCode
     * @param string $accountNumber
     * @param float $percentageCharge
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createSubaccount(string $businessName, string $bankCode, string $accountNumber, float $percentageCharge, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/subaccount', [
            'json' => [
                'business_name' => $businessName,
                'bank_code' => $bankCode,
                'account_number' => $accountNumber,
                'percentage_charge' => $percentageCharge,
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
     * List Subaccounts
     * List subaccounts available on your integration
     *
     * @param string $id
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listSubaccounts(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/subaccount', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
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
     * Fetch Subaccount
     * Get details of a subaccount on your integration
     *
     * @param string $identifier The subaccount ID or code you want to fetch
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchSubaccount(string $identifier): Response
    {
        $response = $this->client->send('GET', "/subaccount/{$identifier}");

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Update Subaccount
     * Update a subaccount details on your integration
     *
     * @param string $identifier The subaccount ID or code you want to update
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function updateSubaccount(string $identifier, array $data): Response
    {
        $response = $this->client->send('PUT', "/subaccount/{$identifier}", [
            'json' => $data
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }
}
