<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Transfers;

use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;

interface TransfersInterface extends TransferInterface
{
    /**
     * Initiate Transfer
     * Send money to your customers.
     * Status of transfer object returned will be pending if OTP is disabled. In the event that an OTP is required, status will read otp.
     *
     * @param int $amount
     * @param string $recipient
     * @param string $reference
     * @param array $optional
     * @return Response
     */
    public function initiateTransfer(int $amount, string $recipient, string $reference, array $optional = []): Response;

    /**
     * Finalize Transfer
     * Finalize an initiated transfer.
     *
     * @param string $transferCode
     * @param string $otp
     * @return Response
     */
    public function finalizeTransfer(string $transferCode, string $otp): Response;

    /**
     * Initiate Bulk Transfer
     * Batch multiple transfers in a single request.
     * You need to disable the Transfers OTP requirement to use this endpoint.
     *
     * @param Currency|string $currency
     * @param array $transfers
     * @return Response
     */
    public function initiateBulkTransfer(Currency|string $currency, array $transfers): Response;

    /**
     * List Transfers
     * List the transfers made on your integration.
     *
     * @param int $perPage
     * @param int $page
     * @param string $recipient
     * @param array $optional
     * @return Response
     */
    public function listTransfers(string $recipient, int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Transfer
     * Get details of a transfer on your integration.
     *
     * @param string $identifier
     * @return Response
     */
    public function fetchTransfer(string $identifier): Response;

    /**
     * Verify Transfer
     * Verify the status of a transfer on your integration.
     *
     * @param string $reference
     * @return Response
     */
    public function verifyTransfer(string $reference): Response;

    /**
     * Export Transfers
     * Export a list of transfers you made on your integration
     */
    public function exportTransfers(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Resend OTP for Transfer
     * Generates a new OTP and sends to customer
     */
    public function resendOtp(string $transferCode, string $reason): Response;

    /**
     * Disable OTP Requirement for Transfers
     */
    public function disableOtp(): Response;

    /**
     * Finalize Disabling of OTP Requirement for Transfers
     */
    public function disableOtpFinalize(string $otp): Response;

    /**
     * Enable OTP Requirement for Transfers
     */
    public function enableOtp(): Response;
}
