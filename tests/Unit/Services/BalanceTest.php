<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Balance;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Balance(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('fetches the integration balance', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/balance')
        ->andReturn(Fixtures::balance());

    $response = $this->service->fetch();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Balances retrieved');
});
