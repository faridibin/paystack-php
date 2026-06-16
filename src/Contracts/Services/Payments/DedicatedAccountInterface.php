<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Defines the contract for dedicated virtual account operations.
 */
interface DedicatedAccountInterface extends PaymentsInterface
{
    /**
     * Create Dedicated Account.
     * Create a dedicated virtual account and assign to a customer.
     *
     * @param string $customer Customer ID or code
     * @param array $optional Additional optional parameters (e.g. preferred_bank, subaccount)
     * @return Response
     */
    public function create(string $customer, array $optional = []): Response;

    /**
     * List Dedicated Accounts.
     * List dedicated virtual accounts available on your integration.
     *
     * @param int $perPage Number of records per page
     * @param int $page Page number to retrieve
     * @param array $optional Additional optional filters (e.g. customer, bank_id, currency)
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Assign Dedicated Account.
     * Create a customer, validate the customer, and assign a DVA to the customer.
     *
     * @param string $email Customer email address
     * @param string $firstName Customer first name
     * @param string $lastName Customer last name
     * @param string $phone Customer phone number (with country code, e.g. +2348100000000)
     * @param string $preferredBank Bank slug for preferred bank (e.g. wema-bank)
     * @param string $country Two-letter country code (e.g. NG)
     * @param array $optional Additional optional parameters (e.g. account_number, bvn, bank_code)
     * @return Response
     */
    public function assign(string $email, string $firstName, string $lastName, string $phone, string $preferredBank, string $country, array $optional = []): Response;

    /**
     * Fetch Dedicated Account.
     * Get details of a dedicated virtual account on your integration.
     *
     * @param string $dedicatedAccountId The ID of the dedicated virtual account
     * @return Response
     */
    public function fetch(string $dedicatedAccountId): Response;

    /**
     * Deactivate Dedicated Account.
     * Deactivate a dedicated virtual account on your integration.
     *
     * @param string $dedicatedAccountId The ID of the dedicated virtual account to deactivate
     * @return Response
     */
    public function deactivate(string $dedicatedAccountId): Response;

    /**
     * Requery Dedicated Account.
     * Requery a dedicated virtual account for new transactions.
     *
     * @param string $accountNumber Virtual account number to requery
     * @param string $providerSlug The bank provider slug in lowercase without spaces (e.g. wema-bank)
     * @param array $optional Additional optional parameters (e.g. date)
     * @return Response
     */
    public function requery(string $accountNumber, string $providerSlug, array $optional = []): Response;

    /**
     * Add Split to Dedicated Account.
     * Split a dedicated virtual account transaction with one or more accounts.
     *
     * @param string $customer Customer ID, code, or email
     * @param array $optional Split configuration (e.g. subaccount, split_code, preferred_bank)
     * @return Response
     */
    public function addSplit(string $customer, array $optional = []): Response;

    /**
     * Remove Split from Dedicated Account.
     * Remove a split from a dedicated virtual account.
     *
     * @param string $accountNumber Dedicated virtual account number
     * @return Response
     */
    public function removeSplit(string $accountNumber): Response;

    /**
     * Fetch Bank Providers.
     * Get available bank providers for a dedicated virtual account.
     *
     * @return Response
     */
    public function availableProviders(): Response;
}
