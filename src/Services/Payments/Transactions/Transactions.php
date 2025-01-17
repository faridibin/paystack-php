<?php

namespace Faridibin\Paystack\Services\Payments\Transactions;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\Transactions\TransactionsInterface;
use Faridibin\Paystack\DataTransferObjects\Payments\Transactions\TransactionDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\Transactions\TransactionTotalsDTO;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;

class Transactions implements TransactionsInterface
{
    /**
     * The Transactions service constructor.
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
     * Initialize Transaction.
     * Initialize a transaction from your backend
     *
     * @param int $amount
     * @param string $email
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function initialize(int $amount, string $email, array $optional = []): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function verify(string $reference): Response
    {
        $response = $this->client->send('GET', "/transaction/verify/{$reference}");

        return new Response($response, TransactionDTO::class);
    }

    /**
     * List Transactions.
     * List transactions on your integration.
     * 
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/transaction', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response, TransactionDTO::class, true);
    }

    /**
     * Fetch Transaction
     * Get details of a transaction carried out on your integration.
     *
     * @param string $id
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetch(string $id): Response
    {
        $response = $this->client->send('GET', "/transaction/{$id}");

        return new Response($response, TransactionDTO::class);
    }

    /**
     * Charge Authorization
     * All authorizations marked as reusable can be charged with this endpoint whenever you need to receive payments
     *
     * @param string $authorizationCode
     * @param int $amount
     * @param string $email
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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

        return new Response($response, TransactionTotalsDTO::class);
    }

    /**
     * Export Transactions
     * Export a list of transactions carried out on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function export(int $perPage = 50, int $page = 1, array $optional = []): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function partialDebit(string $authorizationCode, int $amount,  Currency|string $currency, string $email, array $optional = []): Response
    {
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
