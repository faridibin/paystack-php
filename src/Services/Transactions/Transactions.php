<?php

namespace Faridibin\Paystack\Services\Transactions;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Transactions\TransactionsInterface;
use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\Currency;

class Transactions implements TransactionsInterface
{
    /**
     * The Transactions service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
    }

    /**
     * Initialize Transaction.
     * Initialize a transaction from your backend
     *
     * @param int $amount
     * @param string $email
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function initializeTransaction(int $amount, string $email, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/transaction/initialize', [
            'json' => [
                'amount' => $amount,
                'email' => $email,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Verify Transaction.
     * Confirm the status of a transaction
     *
     * @param string $reference
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function verifyTransaction(string $reference): Response
    {
        $response = $this->client->send('GET', "/transaction/verify/{$reference}");

        return new Response($response);
    }

    /**
     * List Transactions.
     * List transactions on your integration.
     * 
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listTransactions(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/transaction', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Transaction
     * Get details of a transaction carried out on your integration.
     *
     * @param string $id
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchTransaction(string $id): Response
    {
        $response = $this->client->send('GET', "/transaction/{$id}");

        return new Response($response);
    }

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
    public function chargeAuthorization(string $authorizationCode, int $amount, string $email,  array $optional = []): Response
    {
        $response = $this->client->send('POST', '/transaction/charge_authorization', [
            'json' => [
                'amount' => $amount,
                'email' => $email,
                'authorization_code' => $authorizationCode,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * View Transaction Timeline
     * Get a detailed timeline of a transaction carried out on your integration.
     *
     * @param string $id
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function viewTransactionTimeline(string $id): Response
    {
        $response = $this->client->send('GET', "/transaction/timeline/{$id}");

        return new Response($response);
    }

    /**
     * Transaction Totals
     * Total amount received on your account
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function transactionTotals(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/transaction/totals', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Export Transactions
     * Export a list of transactions carried out on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function exportTransaction(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/transaction/export', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

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
    public function partialDebit(string $authorizationCode, int $amount,  Currency|string $currency, string $email, array $optional = []): Response
    {
        $currency instanceof Currency ? $currency->value : $currency;

        $response = $this->client->send('POST', '/transaction/charge_authorization', [
            'json' => [
                'currency' => $currency,
                'amount' => $amount,
                'email' => $email,
                'authorization_code' => $authorizationCode,
                ...$optional
            ]
        ]);

        return new Response($response);
    }
}
