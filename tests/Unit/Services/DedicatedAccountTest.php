<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\DedicatedAccount;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new DedicatedAccount(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a dedicated account for a customer', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/dedicated_account', Mockery::on(fn($o) => $o['json']['customer'] === 'CUS_xxx'))
        ->andReturn(Fixtures::dedicatedAccount());

    $response = $this->service->create('CUS_xxx');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('NUBAN successfully created');
});

it('lists dedicated accounts with pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/dedicated_account', Mockery::any())
        ->andReturn(Fixtures::dedicatedAccountList());

    $response = $this->service->list();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Dedicated accounts retrieved');
});

it('assigns a dedicated account with correct payload', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/dedicated_account/assign', Mockery::on(
            fn($o) => $o['json']['email'] === 'test@example.com'
                && $o['json']['preferred_bank'] === 'wema-bank'
                && $o['json']['country'] === 'NG'
        ))
        ->andReturn(Fixtures::dedicatedAccount());

    $response = $this->service->assign('test@example.com', 'Test', 'User', '+2348000000000', 'wema-bank', 'NG');
    expect($response->getStatus())->toBeTrue();
});

it('fetches a dedicated account by id', function () {
    $this->client->shouldReceive('send')->once()->with('GET', '/dedicated_account/123')->andReturn(Fixtures::dedicatedAccount());

    $response = $this->service->fetch('123');
    expect($response->getStatus())->toBeTrue();
});

it('deactivates a dedicated account using DELETE', function () {
    $this->client->shouldReceive('send')->once()->with('DELETE', '/dedicated_account/123')->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->deactivate('123');
    expect($response->getStatus())->toBeTrue();
});

it('requeries a dedicated account', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/dedicated_account/requery', Mockery::on(
            fn($o) => $o['query']['account_number'] === '0123456789' && $o['query']['provider_slug'] === 'wema-bank'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->requery('0123456789', 'wema-bank');
    expect($response->getStatus())->toBeTrue();
});

it('adds a split to a dedicated account', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/dedicated_account/split', Mockery::on(fn($o) => $o['json']['customer'] === 'CUS_xxx'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->addSplit('CUS_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('removes a split from a dedicated account', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('DELETE', '/dedicated_account/split', Mockery::on(fn($o) => $o['json']['account_number'] === '0123456789'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->removeSplit('0123456789');
    expect($response->getStatus())->toBeTrue();
});

it('lists available bank providers', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/dedicated_account/available_providers')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->availableProviders();
    expect($response->getStatus())->toBeTrue();
});
