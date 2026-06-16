<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\SubaccountsInterface;
use Faridibin\Paystack\DataTransferObjects\Payments\SubaccountDTO;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Service for managing subaccounts for split payments.
 */
class Subaccounts implements SubaccountsInterface
{
    /**
     * The Subaccounts service constructor.
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
     * Create a subaccount.
     *
     * @param string $businessName
     * @param string $settlementBank Bank code from the List Banks endpoint
     * @param string $accountNumber
     * @param float $percentageCharge
     * @param array $optional
     * @return Response
     */
    public function createSubaccount(string $businessName, string $settlementBank, string $accountNumber, float $percentageCharge, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/subaccount', [
            'json' => [
                'business_name' => $businessName,
                'settlement_bank' => $settlementBank,
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
     * @param int $perPage Number of records to return per page (default: 50)
     * @param int $page Page number to return (default: 1)
     * @param array $optional Additional query parameters to filter the list of subaccounts
     * @return Response
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
     * @return Response
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
     * @return Response
     */
    public function updateSubaccount(string $identifier, array $data): Response
    {
        $response = $this->client->send('PUT', "/subaccount/{$identifier}", [
            'json' => $data
        ]);

        return new Response($response, SubaccountDTO::class);
    }
}
