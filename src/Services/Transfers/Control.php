<?php

namespace Faridibin\Paystack\Services\Transfers;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Transfers\ControlInterface;
use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\Reason;

class Control implements ControlInterface
{
    /**
     * The Recipients service constructor.
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
     * Check Balance
     * Fetch the balance of your integration
     * 
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function checkBalance(): Response
    {
        $response = $this->client->send('GET', '/balance');

        return new Response($response, null, true);
    }

    /**
     * Fetch Balance Ledger
     * Fetch all pay-ins and pay-outs that occured on your integration
     * 
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchBalanceLedger(): Response
    {
        $response = $this->client->send('GET', '/balance/ledger');

        return new Response($response, null, true);
    }

    /**
     * Resend OTP
     * Generates a new OTP and sends to customer in the event they are having trouble receiving one.
     * 
     * @param string $transferCode
     * @param \Faridibin\Paystack\Enums\Reason|string $reason
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function resendOtp(string $transferCode, Reason|string $reason): Response
    {
        $response = $this->client->send('POST', '/transfer/resend_otp', [
            'json' => [
                'transfer_code' => $transferCode,
                'reason' => $reason
            ]
        ]);

        return new Response($response, null, true);
    }

    /**
     * Disable OTP
     * This is used in the event that you want to be able to complete transfers programmatically without use of OTPs. 
     * No arguments required. You will get an OTP to complete the request.
     * 
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function disableOtp(): Response
    {
        $response = $this->client->send('POST', '/transfer/disable_otp');

        return new Response($response, null, true);
    }

    /**
     * Finalize Disable OTP
     * Finalize the request to disable OTP on your transfers.
     * 
     * @param string $otp
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function finalizeDisableOtp(string $otp): Response
    {
        $response = $this->client->send('POST', '/transfer/disable_otp_finalize', [
            'json' => [
                'otp' => $otp
            ]
        ]);

        return new Response($response, null, true);
    }

    /**
     * Enable OTP
     * In the event that a customer wants to stop being able to complete transfers programmatically, this endpoint helps turn OTP requirement back on. 
     * No arguments required.
     * 
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function enableOtp(): Response
    {
        $response = $this->client->send('POST', '/transfer/enable_otp');

        return new Response($response, null, true);
    }
}
