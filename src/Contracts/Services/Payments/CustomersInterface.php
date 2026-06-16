<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\RiskAction;

interface CustomersInterface extends PaymentsInterface
{
    /**
     * Create a customer.
     * Create a customer on your integration
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data = []): Response;

    /**
     * Fetch Customer
     * Get details of a customer on your integration.
     *
     * @param string $identifier An email or customer code for the customer you want to fetch
     * @return Response
     */
    public function fetch(string $identifier): Response;

    /**
     * Update a customer.
     * Update a customer's details on your integration
     *
     * @param string $id
     * @param array $data
     * @return Response
     */
    public function update(string $id, array $data): Response;

    /**
     * List Customer.
     * List customers available on your integration.
     *
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Validate Customer.
     * Validate a customer on your integration
     *
     * @param string $identifier Email, or customer code of customer to be identified
     * @param array $data
     * @return Response
     */
    public function validate(string $identifier, array $data): Response;

    /**
     * Deactivate Customer.
     * Deactivate a customer on your integration
     *
     * @param string $identifier Customer's code, or email address
     * @param RiskAction|string $riskAction The risk action to be applied
     * @return Response
     */
    public function setRiskStatus(string $identifier, RiskAction|string $riskAction = 'default'): Response;

    /**
     * Deactivate Authorization.
     * Deactivate an authorization when the card needs to be forgotten
     *
     * @param string $authorizationCode
     * @return Response
     */
    public function deactivateAuthorization(string $authorizationCode): Response;

    /**
     * Initialize Authorization.
     * Initiate a reusable authorization request to your customers
     *
     * @param string $email The customer's email address
     * @param string $channel The authorization channel. Currently only 'direct_debit' is supported.
     * @param array $optional Optional parameters for the authorization initialization
     * @return Response
     */
    public function initializeAuthorization(string $email, string $channel = 'direct_debit', array $optional = []): Response;

    /**
     * Verify Authorization.
     * Check the status of an authorization request
     *
     * @param string $reference The reference of the authorization request
     * @return Response
     */
    public function verifyAuthorization(string $reference): Response;

    /**
     * Initialize Direct Debit.
     * Link a customer's account for Direct Debit
     * 
     * @param string $customerId The customer's ID
     * @param array $data The data required to initialize Direct Debit
     * @return Response
     */
    public function initializeDirectDebit(string $customerId, array $data): Response;

    /**
     * Direct Debit Activation Charge.
     * Trigger the activation charge for a Direct Debit mandate
     * 
     * @param string $customerId The customer's ID
     * @param array $data The data required to trigger the activation charge
     * @return Response
     */
    public function directDebitActivationCharge(string $customerId, array $data): Response;

    /**
     * Fetch Mandate Authorizations.
     * Get a customer's Direct Debit mandate authorizations
     * 
     * @param string $customerId The customer's ID
     * @return Response
     */
    public function fetchMandateAuthorizations(string $customerId): Response;
}
