<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\VerificationInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

class Verification implements VerificationInterface
{
    /**
     * The Verification service constructor.
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
     * Resolve an account number
     * Confirm an account belongs to the right customer
     *
     * @param string $accountNumber
     * @param string $bankCode
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
     * Confirm the authenticity of a customer's account number before sending money
     *
     * @param array $account
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
     * Get more information about a customer's card
     *
     * @param string $bin
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
