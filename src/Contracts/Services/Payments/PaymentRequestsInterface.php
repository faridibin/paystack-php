<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DTOs\Response;
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
    public function createPaymentRequest(string $customer, int $amount, array $optional): Response;

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
}
