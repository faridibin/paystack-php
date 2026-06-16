<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\VerificationInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Service for verifying accounts, card BINs, and bank account details.
 */
class Verification implements VerificationInterface
{
    /**
     * The Verification service constructor.
     *
     * @param string|null $secretKey The Paystack secret key (used if no client is injected)
     * @param \Faridibin\Paystack\Contracts\ClientInterface|null $client The HTTP client instance
     * @throws \Faridibin\Paystack\Exceptions\PaystackException
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

       return new Response($response);
    }

    /**
     * Resolve a card BIN
     * Get more information about a customer's card
     *
     * @param string $bin
     * @return Response
     */
    public function resolveCardBin(string $bin): Response
    {
        $response = $this->client->send('GET', "/decision/bin/{$bin}");

        return new Response($response);
    }

    /**
     * Validate an account
     * Confirm the authenticity of a customer's account number before sending money
     *
     * @param array $data
     * @return Response
     */
    public function validateAccount(array $data): Response
    {
        $response = $this->client->send('POST', '/bank/validate', [
            'json' => $data
        ]);

       return new Response($response);
    }
}
