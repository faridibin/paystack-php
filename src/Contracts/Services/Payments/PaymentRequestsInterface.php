<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Status;

interface PaymentRequestsInterface extends PaymentsInterface
{
    /**
     * Create a payment request.
     * Create a payment request for a transaction on your integration
     *
     * @param string $customer Customer id or code
     * @param int $amount
     * @param array $optional
     * @return Response
     */
    public function createPaymentRequest(string $customer, int $amount, array $optional = []): Response;

    /**
     * List Payment Requests
     * List the payment requests available on your integration
     *
     * @param string $id
     * @return Response
     */
    public function listPaymentRequests(string $customer, Status|string $status, Currency|string $currency, bool $includeArchive, int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Payment Request
     * Get details of a payment request on your integration
     *
     * @param string $identifier
     * @return Response
     */
    public function fetchPaymentRequest(string $identifier): Response;

    /**
     * Verify Payment Request
     * Verify details of a payment request on your integration
     *
     * @param string $code Payment Request code
     * @return Response
     */
    public function verifyPaymentRequest(string $code): Response;

    /**
     * Update Payment Request
     * Send notification of a payment request to your customers
     *
     * @param string $code Payment Request code
     * @param array $optional
     * @return Response
     */
    public function sendNotification(string $code): Response;

    /**
     * Payment Request Totals
     * Get payment requests metric
     *
     * @return Response
     */
    public function paymentRequestTotal(): Response;

    /**
     * Finalize Payment
     * Finalize a draft payment request
     *
     * @param string $code Payment Request code
     * @param bool $notify
     * @return Response
     */
    public function finalizePayment(string $code, bool $notify = true): Response;

    /**
     * Update Payment Request
     * Update a payment request details on your integration
     *
     * @param string $identifier The payment request ID or code you want to update
     * @param array $data
     * @return Response
     */
    public function updatePaymentRequest(string $identifier, array $data): Response;

    /**
     * Archive Payment Request
     * Used to archive a payment request. A payment request will no longer be fetched on list or returned on verify
     *
     * @param string $code Payment Request code
     * @param array $data
     * @return Response
     */
    public function archivePaymentRequest(string $code): Response;
}
