<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DataTransferObjects\Response;

interface SubaccountsInterface extends PaymentsInterface
{
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
    public function createSubaccount(string $businessName, string $bankCode, string $accountNumber, float $percentageCharge, array $optional = []): Response;

    /**
     * List Subaccounts
     * List subaccounts available on your integration
     *
     * @param string $id
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listSubaccounts(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Subaccount
     * Get details of a subaccount on your integration
     *
     * @param string $identifier The subaccount ID or code you want to fetch
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchSubaccount(string $identifier): Response;

    /**
     * Update Subaccount
     * Update a subaccount details on your integration
     *
     * @param string $identifier The subaccount ID or code you want to update
     * @param array $data
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function updateSubaccount(string $identifier, array $data): Response;
}
