<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services\Transfers;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Transfers\TransfersInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\TransferSource;

/**
 * Service for initiating and managing money transfers.
 */
class Transfers implements TransfersInterface
{
    /**
     * The Transfers service constructor.
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
     * Initiate Transfer
     * Send money to your customers.
     * Status of transfer object returned will be pending if OTP is disabled. In the event that an OTP is required, status will read otp.
     *
     * @param int $amount
     * @param string $recipient
     * @param string $reference Unique identifier for idempotency (lowercase alphanumeric with -,_ allowed)
     * @param array $optional
     * @return Response
     */
    public function initiateTransfer(int $amount, string $recipient, string $reference, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/transfer', [
            'json' => [
                'amount' => $amount,
                'recipient' => $recipient,
                'reference' => $reference,
                'source' => TransferSource::BALANCE,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Finalize Transfer
     * Finalize an initiated transfer.
     *
     * @param string $transferCode
     * @param string $otp
     * @return Response
     */
    public function finalizeTransfer(string $transferCode, string $otp): Response
    {
        $response = $this->client->send('POST', '/transfer/finalize_transfer', [
            'json' => [
                'transfer_code' => $transferCode,
                'otp' => $otp
            ]
        ]);

        return new Response($response);
    }

    /**
     * Initiate Bulk Transfer
     * Batch multiple transfers in a single request.
     * You need to disable the Transfers OTP requirement to use this endpoint.
     *
     * @param Currency|string $currency
     * @param array $transfers
     * @return Response
     */
    public function initiateBulkTransfer(Currency|string $currency, array $transfers): Response
    {
        $response = $this->client->send('POST', '/transfer/bulk', [
            'json' => [
                'currency' => $currency,
                'source' => TransferSource::BALANCE,
                'transfers' => $transfers
            ]
        ]);

        return new Response($response);
    }

    /**
     * List Transfers
     * List the transfers made on your integration.
     *
     * @param string $recipient
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function listTransfers(string $recipient, int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/transfer', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                'recipient' => $recipient,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Transfer
     * Get details of a transfer on your integration.
     *
     * @param string $identifier
     * @return Response
     */
    public function fetchTransfer(string $identifier): Response
    {
        $response = $this->client->send('GET', "/transfer/{$identifier}");

        return new Response($response);
    }

    /**
     * Verify Transfer
     * Verify the status of a transfer on your integration.
     *
     * @param string $reference
     * @return Response
     */
    public function verifyTransfer(string $reference): Response
    {
        $response = $this->client->send('GET', "/transfer/verify/{$reference}");

        return new Response($response);
    }

    /**
     * Export Transfers
     * Export a list of transfers you made on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function exportTransfers(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/transfer/export', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Resend OTP for Transfer
     * Generates a new OTP and sends to customer in the event they are having trouble receiving one.
     *
     * @param string $transferCode
     * @param string $reason
     * @return Response
     */
    public function resendOtp(string $transferCode, string $reason): Response
    {
        $response = $this->client->send('POST', '/transfer/resend_otp', [
            'json' => [
                'transfer_code' => $transferCode,
                'reason' => $reason
            ]
        ]);

        return new Response($response);
    }

    /**
     * Disable OTP Requirement for Transfers
     * This is used in the event that you want to be able to complete transfers programmatically without use of OTPs.
     * No arguments required.
     *
     * @return Response
     */
    public function disableOtp(): Response
    {
        $response = $this->client->send('POST', '/transfer/disable_otp');

        return new Response($response);
    }

    /**
     * Finalize Disabling of OTP Requirement for Transfers
     * Finalize the request to disable OTP on your transfers.
     *
     * @param string $otp
     * @return Response
     */
    public function disableOtpFinalize(string $otp): Response
    {
        $response = $this->client->send('POST', '/transfer/disable_otp_finalize', [
            'json' => [
                'otp' => $otp
            ]
        ]);

        return new Response($response);
    }

    /**
     * Enable OTP Requirement for Transfers
     * In the event that a transfer was initiated without OTP, Paystack will stop sending OTP to your business number.
     * Use this endpoint to enable OTP again.
     *
     * @return Response
     */
    public function enableOtp(): Response
    {
        $response = $this->client->send('POST', '/transfer/enable_otp');

        return new Response($response);
    }
}
