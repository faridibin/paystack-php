<?php

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\SettlementsInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

class Settlements implements SettlementsInterface
{
    /**
     * The Settlements service constructor.
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
     * List Settlements
     * List settlements made to your settlement accounts
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listSettlements(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/settlement', [
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
     * List Settlement Transactions
     * Get the transactions that make up a particular settlement
     *
     * @param string $identifier The settlement ID in which you want to fetch its transactions
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listSettlementTransactions(string $identifier, int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', "/settlement/{$identifier}/transactions", [
            "query" => [
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
}
