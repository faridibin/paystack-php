<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\CustomersInterface;
use Faridibin\Paystack\DataTransferObjects\Payments\CustomerDTO;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\RiskAction;

/**
 * Service for creating and managing customers on your Paystack integration.
 */
class Customers implements CustomersInterface
{
    /**
     * The Customers service constructor.
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
     * Create a customer.
     * Create a customer on your integration
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data = []): Response
    {
        $response = $this->client->send('POST', '/customer', [
            'json' => $data
        ]);

        return new Response($response, CustomerDTO::class);
    }

    /**
     * Fetch Customer
     * Get details of a customer on your integration.
     *
     * @param string $identifier An email or customer code for the customer you want to fetch
     * @return Response
     */
    public function fetch(string $identifier): Response
    {
        $response = $this->client->send('GET', "/customer/{$identifier}");

        return new Response($response, CustomerDTO::class);
    }

    /**
     * Update a customer.
     * Update a customer's details on your integration
     *
     * @param string $code Customer's code
     * @param array $data
     * @return Response
     */
    public function update(string $code, array $data): Response
    {
        $response = $this->client->send('PUT', "/customer/{$code}", [
            'json' => $data
        ]);

        return new Response($response, CustomerDTO::class);
    }

    /**
     * List Customer.
     * List customers available on your integration.
     * 
     * @param int $perPage
     * @param int $page
     * @param array $optional
     *
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/customer', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response, CustomerDTO::class, true);
    }

    /**
     * Validate Customer.
     * Validate a customer on your integration
     *
     * @param string $identifier Email, or customer code of customer to be identified
     * @param array $data
     * @return Response
     */
    public function validate(string $identifier, array $data): Response
    {
        $response = $this->client->send('POST', "/customer/{$identifier}/identification", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Deactivate Customer.
     * Deactivate a customer on your integration
     *
     * @param string $identifier Customer's code, or email address
     * @return Response
     */
    public function setRiskStatus(string $identifier, RiskAction|string $riskAction = 'default'): Response
    {
        $response = $this->client->send('POST', '/customer/set_risk_action', [
            'json' => [
                'customer' => $identifier,
                'risk_action' => $riskAction
            ]
        ]);

        return new Response($response, CustomerDTO::class);
    }

    /**
     * Deactivate Authorization.
     * Deactivate an authorization when the card needs to be forgotten
     *
     * @param string $authorizationCode
     * @return Response
     */
    public function deactivateAuthorization(string $authorizationCode): Response
    {
        $response = $this->client->send('POST', '/customer/deactivate_authorization', [
            'json' => [
                'authorization_code' => $authorizationCode,
            ]
        ]);

        return new Response($response);
    }

    /**
     * Initialize Authorization.
     * Initiate a reusable authorization request to your customers
     *
     * @param string $email
     * @param int $amount
     * @param array $optional
     * @return Response
     */
    public function initializeAuthorization(string $email, int $amount, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/customer/authorization/initialize', [
            'json' => [
                'email' => $email,
                'amount' => $amount,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Verify Authorization.
     * Check the status of an authorization request
     *
     * @param string $reference
     * @return Response
     */
    public function verifyAuthorization(string $reference): Response
    {
        $response = $this->client->send('GET', "/customer/authorization/verify/{$reference}");

        return new Response($response);
    }

    /**
     * Initialize Direct Debit.
     * Link a customer's account for Direct Debit
     *
     * @param string $customerId
     * @param array $data
     * @return Response
     */
    public function initializeDirectDebit(string $customerId, array $data): Response
    {
        $response = $this->client->send('POST', "/customer/{$customerId}/initialize-direct-debit", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Direct Debit Activation Charge.
     * Trigger the activation charge for a Direct Debit mandate
     *
     * @param string $customerId
     * @param array $data
     * @return Response
     */
    public function directDebitActivationCharge(string $customerId, array $data): Response
    {
        $response = $this->client->send('PUT', "/customer/{$customerId}/directdebit-activation-charge", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Fetch Mandate Authorizations.
     * Get a customer's Direct Debit mandate authorizations
     *
     * @param string $customerId
     * @return Response
     */
    public function fetchMandateAuthorizations(string $customerId): Response
    {
        $response = $this->client->send('GET', "/customer/{$customerId}/directdebit-mandate-authorizations");

        return new Response($response);
    }
}
