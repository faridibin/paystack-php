<?php

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Exceptions\ApiException;
use Faridibin\Paystack\Exceptions\AuthenticationException;
use Faridibin\Paystack\Exceptions\PaystackException;
use Faridibin\Paystack\Exceptions\RateLimitException;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response as Psr7Response;

/**
 * Build a Client whose underlying Guzzle instance is driven by a queued mock,
 * so we can exercise the HTTP error-to-exception mapping without real network IO.
 */
function clientWith(mixed $queued): Client
{
    $guzzle = new Guzzle(['handler' => HandlerStack::create(new MockHandler([$queued]))]);

    $client = new Client('sk_test_abc');

    $ref = new ReflectionProperty(Client::class, 'client');
    $ref->setAccessible(true);
    $ref->setValue($client, $guzzle);

    return $client;
}

function clientException(int $status, array $body): ClientException
{
    return new ClientException(
        'HTTP ' . $status,
        new Request('GET', '/x'),
        new Psr7Response($status, [], json_encode($body))
    );
}

it('decodes a successful JSON response into an array', function () {
    $client = clientWith(new Psr7Response(200, [], json_encode(['status' => true, 'message' => 'OK'])));

    $result = $client->send('GET', '/balance');

    expect($result)->toBe(['status' => true, 'message' => 'OK']);
});

it('maps a 401 to an AuthenticationException', function () {
    $client = clientWith(clientException(401, ['message' => 'Invalid key']));

    expect($client->send('GET', '/balance'))->toBeInstanceOf(AuthenticationException::class);
});

it('maps a 429 to a RateLimitException', function () {
    $client = clientWith(clientException(429, ['message' => 'Slow down']));

    expect($client->send('GET', '/balance'))->toBeInstanceOf(RateLimitException::class);
});

it('maps other 4xx to an ApiException carrying the message and code', function () {
    $result = clientWith(clientException(404, ['message' => 'Not found']))->send('GET', '/balance');

    expect($result)->toBeInstanceOf(ApiException::class)
        ->and($result->getMessage())->toBe('Not found')
        ->and($result->getCode())->toBe(404);
});

it('maps a 5xx ServerException to a generic unavailable PaystackException', function () {
    $server = new ServerException(
        'Server error',
        new Request('GET', '/x'),
        new Psr7Response(500, [], json_encode(['message' => 'boom']))
    );

    $result = clientWith($server)->send('GET', '/balance');

    expect($result)->toBeInstanceOf(PaystackException::class)
        ->and($result->getMessage())->toBe('Paystack is currently unavailable')
        ->and($result->getCode())->toBe(500);
});

it('maps a transport-level GuzzleException to a PaystackException', function () {
    $connect = new ConnectException('Connection refused', new Request('GET', '/x'));

    $result = clientWith($connect)->send('GET', '/balance');

    expect($result)->toBeInstanceOf(PaystackException::class)
        ->and($result->getMessage())->toBe('Connection refused');
});

it('exposes the secret key', function () {
    expect((new Client('sk_test_xyz'))->getSecretKey())->toBe('sk_test_xyz');
});
