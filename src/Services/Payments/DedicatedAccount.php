<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\DedicatedAccountInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Service for managing dedicated virtual accounts on Paystack.
 */
class DedicatedAccount implements DedicatedAccountInterface
{
    /**
     * The DedicatedAccount service constructor.
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
     * Create Dedicated Account
     * Create a dedicated virtual account for a customer
     *
     * @param string $customer Customer ID or code
     * @param array $optional
     * @return Response
     */
    public function create(string $customer, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/dedicated_account', [
            'json' => [
                'customer' => $customer,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * List Dedicated Accounts
     * List dedicated virtual accounts available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/dedicated_account', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Assign Dedicated Account
     * Create a customer, validate the customer, and assign a DVA to the customer
     *
     * @param string $email Customer email
     * @param string $firstName Customer first name
     * @param string $lastName Customer last name
     * @param string $phone Customer phone number
     * @param string $preferredBank Bank slug for preferred bank (e.g. wema-bank)
     * @param string $country Country code (e.g. NG)
     * @param array $optional
     * @return Response
     */
    public function assign(string $email, string $firstName, string $lastName, string $phone, string $preferredBank, string $country, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/dedicated_account/assign', [
            'json' => [
                'email' => $email,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone' => $phone,
                'preferred_bank' => $preferredBank,
                'country' => $country,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Dedicated Account
     * Get details of a dedicated virtual account on your integration
     *
     * @param string $dedicatedAccountId
     * @return Response
     */
    public function fetch(string $dedicatedAccountId): Response
    {
        $response = $this->client->send('GET', "/dedicated_account/{$dedicatedAccountId}");

        return new Response($response);
    }

    /**
     * Deactivate Dedicated Account
     * Deactivate a dedicated virtual account on your integration
     *
     * @param string $dedicatedAccountId
     * @return Response
     */
    public function deactivate(string $dedicatedAccountId): Response
    {
        $response = $this->client->send('DELETE', "/dedicated_account/{$dedicatedAccountId}");

        return new Response($response);
    }

    /**
     * Requery Dedicated Account
     * Requery Dedicated Virtual Account for new transactions
     *
     * @param string $accountNumber Virtual account number to requery
     * @param string $providerSlug The bank's slug in lowercase, without spaces
     * @param array $optional
     * @return Response
     */
    public function requery(string $accountNumber, string $providerSlug, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/dedicated_account/requery', [
            'query' => [
                'account_number' => $accountNumber,
                'provider_slug' => $providerSlug,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Add Split to Dedicated Account
     * Split a dedicated virtual account transaction with one or more accounts
     *
     * @param string $customer Customer ID, code, or email
     * @param array $optional
     * @return Response
     */
    public function addSplit(string $customer, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/dedicated_account/split', [
            'json' => [
                'customer' => $customer,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Remove Split from Dedicated Account
     * Remove a split from a dedicated virtual account
     *
     * @param string $accountNumber Dedicated virtual account number
     * @return Response
     */
    public function removeSplit(string $accountNumber): Response
    {
        $response = $this->client->send('DELETE', '/dedicated_account/split', [
            'json' => [
                'account_number' => $accountNumber
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Bank Providers
     * Get available bank providers for a dedicated virtual account
     *
     * @return Response
     */
    public function availableProviders(): Response
    {
        $response = $this->client->send('GET', '/dedicated_account/available_providers');

        return new Response($response);
    }
}
