<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\VerificationInterface;
use Faridibin\Paystack\DTOs\Response;

class Verification implements VerificationInterface
{
    /**
     * The Verification service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
    }

    /**
     * Resolve an account number
     *
     * @param string $accountNumber
     * @param string $bankCode
     * @return Response
     */
    public function resolveAccount(string $accountNumber, string $bankCode): Response
    {
        $response = $this->client->send('GET', '/bank/resolve', [
            'query' => [
                'account_number' => $accountNumber,
                'bank_code' => $bankCode
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Validate an account
     *
     * @param array $account
     * @return Response
     */
    public function resolveCardBin(string $bin): Response
    {
        $response = $this->client->send('GET', "/decision/bin/{$bin}");

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Resolve a card bin
     *
     * @param string $bin
     * @return Response
     */
    public function validateAccount(array $data): Response
    {
        $response = $this->client->send('POST', '/bank/validate', [
            'json' => $data
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }
}
