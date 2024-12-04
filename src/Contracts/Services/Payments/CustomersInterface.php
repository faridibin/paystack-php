<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\RiskAction;

interface CustomersInterface extends PaymentsInterface
{
    /**
     * Create a customer.
     * Create a customer on your integration
     *
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createCustomer(array $data = []): Response;

    /**
     * Fetch Customer
     * Get details of a customer on your integration.
     *
     * @param string $identifier An email or customer code for the customer you want to fetch
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchCustomer(string $identifier): Response;

    /**
     * Update a customer.
     * Update a customer's details on your integration
     *
     * @param string $id
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function updateCustomer(string $code, array $data = []): Response;

    /**
     * List Customer.
     * List customers available on your integration.
     *
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listCustomers(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Validate Customer.
     * Validate a customer on your integration
     *
     * @param string $identifier Email, or customer code of customer to be identified
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function validateCustomer(string $identifier, array $data): Response;

    /**
     * Deactivate Customer.
     * Deactivate a customer on your integration
     *
     * @param string $identifier Customer's code, or email address
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function setCustomerRiskStatus(string $identifier, RiskAction|string $riskAction = 'default'): Response;

    /**
     * Deactivate Authorization.
     * Deactivate an authorization when the card needs to be forgotten
     *
     * @param string $authorizationCode
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function deactivateAuthorization(string $authorizationCode): Response;
}
