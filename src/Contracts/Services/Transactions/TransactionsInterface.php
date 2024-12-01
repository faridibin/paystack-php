<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Transactions;

use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\Currency;

interface TransactionsInterface
{
    /**
     * Initialize Transaction.
     * Initialize a transaction from your backend
     *
     * @param int $amount
     * @param string $email
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function initializeTransaction(int $amount, string $email, array $optional = []): Response;

    /**
     * Verify Transaction.
     * Confirm the status of a transaction
     *
     * @param string $reference
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function verifyTransaction(string $reference): Response;

    /**
     * List Transactions.
     * List transactions on your integration.
     * 
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listTransactions(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Transaction
     * Get details of a transaction carried out on your integration.
     *
     * @param string $id
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchTransaction(string $id): Response;

    /**
     * Charge Authorization
     * All authorizations marked as reusable can be charged with this endpoint whenever you need to receive payments
     *
     * @param string $authorizationCode
     * @param int $amount
     * @param string $email
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function chargeAuthorization(string $authorizationCode, int $amount, string $email,  array $optional = []): Response;

    /**
     * View Transaction Timeline
     * Get a detailed timeline of a transaction carried out on your integration.
     *
     * @param string $id
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function viewTransactionTimeline(string $id): Response;

    /**
     * Transaction Totals
     * Total amount received on your account
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function transactionTotals(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Export Transactions
     * Export a list of transactions carried out on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function exportTransaction(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Partial Debit
     * Retrieve part of a payment from a customer
     * 
     * @param string $authorizationCode
     * @param int $amount
     * @param Currency|string $currency
     * @param string $email
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function partialDebit(string $authorizationCode, int $amount,  Currency|string $currency, string $email, array $optional = []): Response;
}
