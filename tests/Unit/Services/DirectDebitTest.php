<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\DirectDebit;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new DirectDebit(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('triggers a direct debit activation charge', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/directdebit/activation-charge', Mockery::on(fn($o) => $o['json']['customer'] === 'CUS_xxx'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->triggerActivationCharge(['customer' => 'CUS_xxx', 'amount' => 5000]);
    expect($response->getStatus())->toBeTrue();
});

it('lists mandate authorizations with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/directdebit/mandate-authorizations', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->listMandateAuthorizations();
    expect($response->getStatus())->toBeTrue();
});

it('lists mandate authorizations with custom pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/directdebit/mandate-authorizations', Mockery::on(
            fn($o) => $o['query']['perPage'] === 10 && $o['query']['page'] === 2
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->listMandateAuthorizations(10, 2);
    expect($response->getStatus())->toBeTrue();
});
