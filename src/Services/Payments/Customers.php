<?php

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\CustomersInterface;
use Faridibin\Paystack\DataTransferObjects\Payments\CustomerDTO;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\RiskAction;

class Customers implements CustomersInterface
{
    /**
     * The Customers service constructor.
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
     * Create a customer.
     * Create a customer on your integration
     *
     * @param array $data
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function createCustomer(array $data = []): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchCustomer(string $identifier): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function updateCustomer(string $code, array $data): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listCustomers(int $perPage = 50, int $page = 1, array $optional = []): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function validateCustomer(string $identifier, array $data): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function setCustomerRiskStatus(string $identifier, RiskAction|string $riskAction = 'default'): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
}
