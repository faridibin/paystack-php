<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use DateTime;
use Faridibin\Paystack\DataTransferObjects\Response;

interface DisputesInterface extends PaymentsInterface
{
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
    public function listDisputes(DateTime|string $from, DateTime|string $to, int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch dispute.
     * Get more details about a dispute.
     *
     * @param string $id
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchDispute(string $id): Response;

    /**
     * List Transaction Disputes
     * This retrieves disputes for a particular transaction
     *
     * @param string $transactionId
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listTransactionDisputes(string $transactionId): Response;

    /**
     * Update Dispute
     * Update details of a dispute on your integration
     *
     * @param string $id
     * @param array $data
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function updateDispute(string $id, array $data): Response;

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
    public function addEvidence(string $id, string $customerEmail, string $customerName, string $customerPhone, string $serviceDetails, array $optional = []): Response;

    /**
     * Upload Evidence
     * This retrieves the URL to upload evidence for a dispute
     *
     * @param string $id
     * @param string $filename
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function getUploadUrl(string $id, string $filename): Response;

    /**
     * Resolve Dispute
     * Resolve a dispute on your integration
     *
     * @param string $id
     * @param string $resolution
     * @param string $message
     * @param int $refundAmount
     * @param string $filename
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function resolveDispute(string $id, string $resolution, string $message, int $refundAmount, string $filename, array $optional = []): Response;

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
    public function exportDisputes(DateTime|string $from, DateTime|string $to, int $perPage = 50, int $page = 1, array $optional = []): Response;
}
