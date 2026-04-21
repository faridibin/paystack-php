<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use DateTime;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Defines the contract for charge operations.
 */
interface ChargeInterface extends PaymentsInterface
{
    /**
     * Create a charge.
     * Initiate a payment by integrating the payment channel of your choice.
     *
     * @param string $email
     * @param int $amount
     * @param array $optional
     * @return Response
     */
    public function create(string $email, int $amount, array $optional = []): Response;

    /**
     * Submit PIN.
     * Submit PIN to continue a charge
     *
     * @param string $pin
     * @param string $reference
     * @return Response
     */
    public function submitPin(string $pin, string $reference): Response;

    /**
     * Submit OTP.
     * Submit OTP to complete a charge
     *
     * @param string $otp
     * @param string $reference
     * @return Response
     */
    public function submitOtp(string $otp, string $reference): Response;

    /**
     * Submit Phone.
     * Submit phone number when requested
     *
     * @param string $phone
     * @param string $reference
     * @return Response
     */
    public function submitPhone(string $phone, string $reference): Response;

    /**
     * Submit Birthday.
     * Submit Birthday when requested
     *
     * @param DateTime|string $birthday
     * @param string $reference
     * @return Response
     */
    public function submitBirthday(DateTime|string $birthday, string $reference): Response;

    /**
     * Submit Address.
     * Submit Address when requested
     *
     * @param string $address
     * @param string $city
     * @param string $state
     * @param string $zipcode
     * @param string $reference
     * @return Response
     */
    public function submitAddress(string $address, string $city, string $state, string $zipcode, string $reference): Response;

    /**
     * Check Pending Charge.
     * Check the status of a pending charge
     *
     * @param string $reference
     * @return Response
     */
    public function checkPendingCharge(string $reference): Response;
}
