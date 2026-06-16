<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Recurring\Plans;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Plans(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a plan with required fields', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/plan', Mockery::on(
            fn($o) => $o['json']['name'] === 'Monthly'
                && $o['json']['amount'] === 5000
                && $o['json']['interval'] === 'monthly'
        ))
        ->andReturn(Fixtures::plan());

    $response = $this->service->create('Monthly', 5000, 'monthly');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Plan created');
});

it('lists plans with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/plan', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(Fixtures::planList());

    $response = $this->service->list();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Plans retrieved');
});

it('fetches a plan by identifier', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/plan/PLN_xxx')
        ->andReturn(Fixtures::plan());

    $response = $this->service->fetch('PLN_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a plan with PUT', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/plan/PLN_xxx', Mockery::on(fn($o) => $o['json']['name'] === 'Updated'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->update('PLN_xxx', ['name' => 'Updated']);
    expect($response->getStatus())->toBeTrue();
});
