<?php

use Faridibin\Paystack\Exceptions\PaystackException;
use Faridibin\Paystack\Webhook;

$secretKey = 'sk_test_abc123';
$sign = fn(string $payload) => hash_hmac('sha512', $payload, $secretKey);

it('passes a valid signature', function () use ($secretKey, $sign) {
    $payload = json_encode(['event' => 'charge.success', 'data' => []]);

    expect(Webhook::validateSignature($payload, $sign($payload), $secretKey))
        ->toBeInstanceOf(Webhook::class);
});

it('throws on invalid signature', function () use ($secretKey) {
    Webhook::validateSignature('payload', 'bad-signature', $secretKey);
})->throws(PaystackException::class, 'Invalid signature');

it('throws when secret key is empty', function () {
    Webhook::validateSignature('payload', 'sig', '');
})->throws(PaystackException::class, 'No secret key provided');

it('passes a whitelisted IP', function () {
    expect(Webhook::isIpWhitelisted('52.31.139.75'))
        ->toBeInstanceOf(Webhook::class);
});

it('throws for a non-whitelisted IP', function () {
    Webhook::isIpWhitelisted('1.2.3.4');
})->throws(PaystackException::class, 'IP not whitelisted');

it('accepts all three Paystack whitelisted IPs', function () {
    $ips = ['52.31.139.75', '52.49.173.169', '52.214.14.220'];

    foreach ($ips as $ip) {
        expect(Webhook::isIpWhitelisted($ip))->toBeInstanceOf(Webhook::class);
    }
});
