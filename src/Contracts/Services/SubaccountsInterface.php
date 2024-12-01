<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DTOs\Response;

interface SubaccountsInterface
{
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
    public function createSubaccount(string $businessName, string $bankCode, string $accountNumber, float $percentageCharge, array $optional = []): Response;

    /**
     * List Subaccounts
     * List subaccounts available on your integration
     *
     * @param string $id
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listSubaccounts(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Subaccount
     * Get details of a subaccount on your integration
     *
     * @param string $identifier The subaccount ID or code you want to fetch
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchSubaccount(string $identifier): Response;

    /**
     * Update Subaccount
     * Update a subaccount details on your integration
     *
     * @param string $identifier The subaccount ID or code you want to update
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function updateSubaccount(string $identifier, array $data): Response;
}
