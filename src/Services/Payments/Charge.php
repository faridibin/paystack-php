<?php

namespace Faridibin\Paystack\Services\Payments;

use DateTime;
use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\ChargeInterface;
use Faridibin\Paystack\DTOs\Response;

class Charge implements ChargeInterface
{
    /**
     * The Charge service constructor.
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
     * Create a charge.
     * Initiate a payment by integrating the payment channel of your choice.
     *
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createCharge(string $email, int $amount, array $optional = []): Response
    {
        // 
    }

    /**
     * Submit PIN.
     * Submit PIN to continue a charge
     *
     * @param string $pin
     * @param string $reference
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function submitPin(string $pin, string $reference): Response
    {
        // 
    }

    /**
     * Submit OTP.
     * Submit OTP to complete a charge
     *
     * @param string $otp
     * @param string $reference
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function submitOtp(string $otp, string $reference): Response
    {
        // 
    }

    /**
     * Submit Phone.
     * Submit phone number when requested
     *
     * @param string $phone
     * @param string $reference
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function submitPhone(string $phone, string $reference): Response
    {
        // 
    }

    /**
     * Submit Birthday.
     * Submit Birthday when requested
     *
     * @param DateTime|string $birthday
     * @param string $reference
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function submitBirthday(DateTime|string $birthday, string $reference): Response
    {
        $birthday = $birthday instanceof DateTime ? $birthday->format('Y-m-d') : $birthday;
    }

    /**
     * Submit Address.
     * Submit Address when requested
     *
     * @param string $address
     * @param string $city
     * @param string $state
     * @param string $zipcode
     * @param string $reference
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function submitAddress(string $address, string $city, string $state, string $zipcode, string $reference): Response
    {
        // 
    }

    /**
     * Check Pending Charge.
     * Check the status of a pending charge
     *
     * @param string $reference
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function checkPendingCharge(string $reference): Response
    {
        // 
    }
}
