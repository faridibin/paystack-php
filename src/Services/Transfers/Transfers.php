<?php

namespace Faridibin\Paystack\Services\Transfers;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Transfers\TransfersInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\TransferSource;

class Transfers implements TransfersInterface
{
    /**
     * The Transfers service constructor.
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
     * Initiate Transfer
     * Send money to your customers.
     * Status of transfer object returned will be pending if OTP is disabled. In the event that an OTP is required, status will read otp.
     *
     * @param int $amount
     * @param string $recipient
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function initiateTransfer(int $amount, string $recipient, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/transfer', [
            'json' => [
                'amount' => $amount,
                'recipient' => $recipient,
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function initiateBulkTransfer(Currency|string $currency, array $transfers): Response
    {
        $response = $this->client->send('POST', '/transfer/finalize_transfer', [
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function verifyTransfer(string $reference): Response
    {
        $response = $this->client->send('GET', "/transfer/verify/{$reference}");

        return new Response($response);
    }
}
