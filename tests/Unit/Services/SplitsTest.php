<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\Transactions\Splits;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Splits(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a split with required fields', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/split', Mockery::on(
            fn($o) => $o['json']['name'] === 'Main Split'
                && $o['json']['type'] === 'percentage'
                && $o['json']['currency'] === 'NGN'
                && $o['json']['bearer_type'] === 'account'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->createSplit('Main Split', 'percentage', 'NGN', [], 'account', 'ACCT_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('lists splits by name', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/split', Mockery::on(fn($o) => $o['query']['name'] === 'Main Split'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->listSplit('Main Split');
    expect($response->getStatus())->toBeTrue();
});

it('fetches a split by id', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/split/SPL_xxx')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->fetchSplit('SPL_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a split with PUT', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/split/SPL_xxx', Mockery::on(fn($o) => $o['json']['name'] === 'Updated'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->updateSplit('SPL_xxx', ['name' => 'Updated']);
    expect($response->getStatus())->toBeTrue();
});

it('adds a subaccount to a split', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/split/SPL_xxx/subaccount/add', Mockery::on(
            fn($o) => $o['json']['subaccount'] === 'ACCT_xxx' && $o['json']['share'] === 20
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->addSubaccountSplit('SPL_xxx', 'ACCT_xxx', 20);
    expect($response->getStatus())->toBeTrue();
});

it('removes a subaccount from a split', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/split/SPL_xxx/subaccount/remove', Mockery::on(fn($o) => $o['json']['subaccount'] === 'ACCT_xxx'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->removeSubaccountSplit('SPL_xxx', 'ACCT_xxx');
    expect($response->getStatus())->toBeTrue();
});
