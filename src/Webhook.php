<?php

declare(strict_types=1);

namespace Faridibin\Paystack;

use Faridibin\Paystack\Exceptions\PaystackException;

class Webhook
{
    /**
     * Paystack whitelisted IPs.
     */
    private const PAYSTACK_WHITELISTED_IPS = [
        '52.31.139.75',
        '52.49.173.169',
        '52.214.14.220',
    ];

    /**
     * Validate the webhook signature.
     * 
     * @param string $payload
     * @param string $signature
     * @param string $secretKey
     */
    public static function validateSignature(string $payload, string $signature, string $secretKey): self
    {
        if (empty($secretKey)) {
            throw new PaystackException('No secret key provided');
        }

        $expectedSignature = hash_hmac('sha512', $payload, $secretKey);

        if (!hash_equals($signature, $expectedSignature)) {
            throw new PaystackException('Invalid signature');
        }

        return new self();
    }

    /**
     * Check if the IP is whitelisted.
     * @param string $ip
     */
    public static function isIpWhitelisted(string $ip): self
    {
        dump($ip);

        // if (!in_array($ip, self::PAYSTACK_WHITELISTED_IPS, true)) {
        //     throw new PaystackException('IP not whitelisted');
        // }

        return new self();
    }
}
