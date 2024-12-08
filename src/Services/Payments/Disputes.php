<?php

namespace Faridibin\Paystack\Services\Payments;

use DateTime;
use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\DisputesInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Resolution;

class Disputes implements DisputesInterface
{
    /**
     * The Terminal service constructor.
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
     * List disputes.
     * List disputes filed against you
     *
     * @param DateTime|string $from
     * @param DateTime|string $to
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listDisputes(DateTime|string $from, DateTime|string $to, int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $from = $from instanceof DateTime ? $from->format('Y-m-d') : $from;
        $to = $to instanceof DateTime ? $to->format('Y-m-d') : $to;

        $response = $this->client->send('GET', '/dispute', [
            'query' => [
                'from' => $from,
                'to' => $to,
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch dispute.
     * Get more details about a dispute.
     *
     * @param string $id
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchDispute(string $id): Response
    {
        $response = $this->client->send('GET', "/dispute/{$id}");

        return new Response($response);
    }

    /**
     * List Transaction Disputes
     * This retrieves disputes for a particular transaction
     *
     * @param string $transactionId
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listTransactionDisputes(string $transactionId): Response
    {
        $response = $this->client->send('GET', "/dispute/transaction/{$transactionId}");

        return new Response($response);
    }

    /**
     * Update Dispute
     * Update details of a dispute on your integration
     *
     * @param string $id
     * @param array $data
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function updateDispute(string $id, array $data): Response
    {
        $response = $this->client->send('PUT', "dispute/{$id}", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Add Evidence
     * Provide evidence for a dispute
     *
     * @param string $id
     * @param string $customerEmail
     * @param string $customerName
     * @param string $customerPhone
     * @param string $serviceDetails
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function addEvidence(string $id, string $customerEmail, string $customerName, string $customerPhone, string $serviceDetails, array $optional = []): Response
    {
        $response = $this->client->send('POST', "dispute/{$id}/evidence", [
            'json' => [
                'customer_email' => $customerEmail,
                'customer_name' => $customerName,
                'customer_phone' => $customerPhone,
                'service_details' => $serviceDetails,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Upload Evidence
     * This retrieves the URL to upload evidence for a dispute
     *
     * @param string $id
     * @param string $filename
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function getUploadUrl(string $id, string $filename): Response
    {
        $response = $this->client->send('GET', "/dispute/{$id}/upload_url", [
            'query' => [
                'filename' => $filename
            ]
        ]);

        return new Response($response);
    }

    /**
     * Resolve Dispute
     * Resolve a dispute on your integration
     *
     * @param string $id
     * @param Resolution|string $resolution
     * @param string $message
     * @param int $refundAmount
     * @param string $filename
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function resolveDispute(string $id, Resolution|string $resolution, string $message, int $refundAmount, string $filename, array $optional = []): Response
    {
        $response = $this->client->send('PUT', "dispute/{$id}/resolve", [
            'json' => [
                'resolution' => $resolution,
                'message' => $message,
                'uploaded_filename' => $filename,
                'refund_amount' => $refundAmount,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Export Disputes
     * Export disputes available on your integration
     *
     * @param DateTime|string $from
     * @param DateTime|string $to
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function exportDisputes(DateTime|string $from, DateTime|string $to, int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $from = $from instanceof DateTime ? $from->format('Y-m-d') : $from;
        $to = $to instanceof DateTime ? $to->format('Y-m-d') : $to;

        $response = $this->client->send('GET', '/dispute/export', [
            'query' => [
                'from' => $from,
                'to' => $to,
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }
}
