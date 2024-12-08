<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Transfers;

use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Reason;

interface ControlInterface extends TransferInterface
{
    /**
     * Check Balance
     * Fetch the balance of your integration
     * 
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function checkBalance(): Response;

    /**
     * Fetch Balance Ledger
     * Fetch all pay-ins and pay-outs that occured on your integration
     * 
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchBalanceLedger(): Response;

    /**
     * Resend OTP
     * Generates a new OTP and sends to customer in the event they are having trouble receiving one.
     * 
     * @param string $transferCode
     * @param \Faridibin\Paystack\Enums\Reason|string $reason
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function resendOtp(string $transferCode, Reason|string $reason): Response;

    /**
     * Disable OTP
     * This is used in the event that you want to be able to complete transfers programmatically without use of OTPs. 
     * No arguments required. You will get an OTP to complete the request.
     * 
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function disableOtp(): Response;

    /**
     * Finalize Disable OTP
     * Finalize the request to disable OTP on your transfers.
     * 
     * @param string $otp
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function finalizeDisableOtp(string $otp): Response;

    /**
     * Enable OTP
     * In the event that a customer wants to stop being able to complete transfers programmatically, this endpoint helps turn OTP requirement back on. 
     * No arguments required.
     * 
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function enableOtp(): Response;
}
