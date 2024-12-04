<?php

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\PaymentRequestsInterface;
use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Status;

class PaymentRequests implements PaymentRequestsInterface
{
    /**
     * The Payment Requests service constructor.
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
     * Create a payment request.
     * Create a payment request for a transaction on your integration
     *
     * @param string $customer Customer id or code
     * @param int $amount
     * @param array $optional
     * @return Response
     */
    public function createPaymentRequest(string $customer, int $amount, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/paymentrequest', [
            'json' => [
                'customer' => $customer,
                'amount' => $amount,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * List Payment Requests
     * List the payment requests available on your integration
     *
     * @param string $id
     * @return Response
     */
    public function listPaymentRequests(string $customer, Status|string $status, Currency|string $currency, bool $includeArchive, int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/paymentrequest', [
            'query' => [
                'customer' => $customer,
                'status' => $status,
                'currency' => $currency,
                'include_archive' => $includeArchive,
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Payment Request
     * Get details of a payment request on your integration
     *
     * @param string $identifier
     * @return Response
     */
    public function fetchPaymentRequest(string $identifier): Response
    {
        $response = $this->client->send('GET', "/paymentrequest/{$identifier}");

        return new Response($response);
    }

    /**
     * Verify Payment Request
     * Verify details of a payment request on your integration
     *
     * @param string $code Payment Request code
     * @return Response
     */
    public function verifyPaymentRequest(string $code): Response
    {
        $response = $this->client->send('GET', "/paymentrequest/verify/{$code}");

        return new Response($response);
    }

    /**
     * Update Payment Request
     * Send notification of a payment request to your customers
     *
     * @param string $code Payment Request code
     * @param array $optional
     * @return Response
     */
    public function sendNotification(string $code): Response
    {
        $response = $this->client->send('POST', "/paymentrequest/notify/{$code}");

        return new Response($response);
    }

    /**
     * Payment Request Totals
     * Get payment requests metric
     *
     * @return Response
     */
    public function paymentRequestTotal(): Response
    {
        $response = $this->client->send('GET', "/paymentrequest/totals");

        return new Response($response);
    }

    /**
     * Finalize Payment
     * Finalize a draft payment request
     *
     * @param string $code Payment Request code
     * @param bool $notify
     * @return Response
     */
    public function finalizePayment(string $code, bool $notify = true): Response
    {
        $response = $this->client->send('POST', "/paymentrequest/finalize/{$code}", [
            'json' => [
                'notify' => $notify
            ]
        ]);

        return new Response($response);
    }

    /**
     * Update Payment Request
     * Update a payment request details on your integration
     *
     * @param string $identifier The payment request ID or code you want to update
     * @param array $data
     * @return Response
     */
    public function updatePaymentRequest(string $identifier, array $data): Response
    {
        $response = $this->client->send('PUT', "/paymentrequest/{$identifier}", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Archive Payment Request
     * Used to archive a payment request. A payment request will no longer be fetched on list or returned on verify
     *
     * @param string $code Payment Request code
     * @param array $data
     * @return Response
     */
    public function archivePaymentRequest(string $code): Response
    {
        $response = $this->client->send('POST', "/paymentrequest/archive/{$code}");

        return new Response($response);
    }
}
