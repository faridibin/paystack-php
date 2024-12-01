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
     * @inheritDoc
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
     * @inheritDoc
     */
    public function resolveCardBin(string $bin): Response
    {
        // 
    }

    /**
     * @inheritDoc
     */
    public function validateAccount(array $account): Response
    {
        // 
    }
}
