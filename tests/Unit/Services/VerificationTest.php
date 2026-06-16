<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Verification;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Verification(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('resolves an account number', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/bank/resolve', Mockery::on(
            fn($o) => $o['query']['account_number'] === '0123456789' && $o['query']['bank_code'] === '058'
        ))
        ->andReturn(Fixtures::resolvedAccount());

    $response = $this->service->resolveAccount('0123456789', '058');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Account number resolved');
});

it('resolves a card bin', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/decision/bin/539983')
        ->andReturn(Fixtures::resolvedCardBin());

    $response = $this->service->resolveCardBin('539983');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Bin resolved');
});

it('validates an account', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/bank/validate', Mockery::on(fn($o) => $o['json']['account_number'] === '0123456789'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->validateAccount(['account_number' => '0123456789', 'bank_code' => '058', 'account_name' => 'John Doe']);
    expect($response->getStatus())->toBeTrue();
});
