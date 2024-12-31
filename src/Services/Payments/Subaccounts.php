<?php

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\SubaccountsInterface;
use Faridibin\Paystack\DataTransferObjects\Payments\SubaccountDTO;
use Faridibin\Paystack\DataTransferObjects\Response;

class Subaccounts implements SubaccountsInterface
{
    /**
     * The Subaccounts service constructor.
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
     * Create a subaccount.
     *
     * @param string $businessName
     * @param string $bankCode
     * @param string $accountNumber
     * @param float $percentageCharge
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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

        return new Response($response, SubaccountDTO::class);
    }

    /**
     * List Subaccounts
     * List subaccounts available on your integration
     *
     * @param string $id
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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

        return new Response($response, SubaccountDTO::class, true);
    }

    /**
     * Fetch Subaccount
     * Get details of a subaccount on your integration
     *
     * @param string $identifier The subaccount ID or code you want to fetch
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchSubaccount(string $identifier): Response
    {
        $response = $this->client->send('GET', "/subaccount/{$identifier}");

        return new Response($response, SubaccountDTO::class);
    }

    /**
     * Update Subaccount
     * Update a subaccount details on your integration
     *
     * @param string $identifier The subaccount ID or code you want to update
     * @param array $data
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function updateSubaccount(string $identifier, array $data): Response
    {
        $response = $this->client->send('PUT', "/subaccount/{$identifier}", [
            'json' => $data
        ]);

        return new Response($response, SubaccountDTO::class);
    }
}
