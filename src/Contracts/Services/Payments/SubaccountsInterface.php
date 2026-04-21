<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Defines the contract for subaccount management operations.
 */
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
     * @return Response
     */
    public function createSubaccount(string $businessName, string $bankCode, string $accountNumber, float $percentageCharge, array $optional = []): Response;

    /**
     * List Subaccounts
     * List subaccounts available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function listSubaccounts(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Subaccount
     * Get details of a subaccount on your integration
     *
     * @param string $identifier The subaccount ID or code you want to fetch
     * @return Response
     */
    public function fetchSubaccount(string $identifier): Response;

    /**
     * Update Subaccount
     * Update a subaccount details on your integration
     *
     * @param string $identifier The subaccount ID or code you want to update
     * @param array $data
     * @return Response
     */
    public function updateSubaccount(string $identifier, array $data): Response;
}
