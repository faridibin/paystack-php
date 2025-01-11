<?php

namespace Faridibin\Paystack\Services\Payments;

use DateTime;
use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\ChargeInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function create(string $email, int $amount, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/charge', [
            'json' => [
                'email' => $email,
                'amount' => $amount,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Submit PIN.
     * Submit PIN to continue a charge
     *
     * @param string $pin
     * @param string $reference
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function submitPin(string $pin, string $reference): Response
    {
        $response = $this->client->send('POST', '/charge/submit_pin', [
            'json' => [
                'pin' => $pin,
                'reference' => $reference
            ]
        ]);

        return new Response($response);
    }

    /**
     * Submit OTP.
     * Submit OTP to complete a charge
     *
     * @param string $otp
     * @param string $reference
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function submitOtp(string $otp, string $reference): Response
    {
        $response = $this->client->send('POST', '/charge/submit_otp', [
            'json' => [
                'otp' => $otp,
                'reference' => $reference
            ]
        ]);

        return new Response($response);
    }

    /**
     * Submit Phone.
     * Submit phone number when requested
     *
     * @param string $phone
     * @param string $reference
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function submitPhone(string $phone, string $reference): Response
    {
        $response = $this->client->send('POST', '/charge/submit_phone', [
            'json' => [
                'phone' => $phone,
                'reference' => $reference
            ]
        ]);

        return new Response($response);
    }

    /**
     * Submit Birthday.
     * Submit Birthday when requested
     *
     * @param DateTime|string $birthday
     * @param string $reference
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function submitBirthday(DateTime|string $birthday, string $reference): Response
    {
        $birthday = $birthday instanceof DateTime ? $birthday->format('Y-m-d') : $birthday;

        $response = $this->client->send('POST', '/charge/submit_birthday', [
            'json' => [
                'birthday' => $birthday,
                'reference' => $reference
            ]
        ]);

        return new Response($response);
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function submitAddress(string $address, string $city, string $state, string $zipcode, string $reference): Response
    {
        $response = $this->client->send('POST', '/charge/submit_address', [
            'json' => [
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'zip_code' => $zipcode,
                'reference' => $reference
            ]
        ]);

        return new Response($response);
    }

    /**
     * Check Pending Charge.
     * When you get pending as a charge status or if there was an exception when calling any of the /charge endpoints, 
     * wait 10 seconds or more, then make a check to see if its status has changed. 
     * Don't call too early as you may get a lot more pending than you should.
     *
     * @param string $reference
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function checkPendingCharge(string $reference): Response
    {
        $response = $this->client->send('GET', "/charge/{$reference}");

        return new Response($response);
    }
}
