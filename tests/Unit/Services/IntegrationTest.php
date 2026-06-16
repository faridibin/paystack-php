<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Integration;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Integration(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('fetches the payment session timeout', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/integration/payment_session_timeout')
        ->andReturn(Fixtures::timeout());

    $response = $this->service->fetchTimeout();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Payment session timeout retrieved');
});

it('updates the payment session timeout', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/integration/payment_session_timeout', Mockery::on(fn($o) => $o['json']['timeout'] === 60))
        ->andReturn(Fixtures::timeout());

    $response = $this->service->updateTimeout(60);
    expect($response->getStatus())->toBeTrue();
});
