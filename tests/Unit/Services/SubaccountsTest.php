<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\Subaccounts;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Subaccounts(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a subaccount with required fields', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/subaccount', Mockery::on(
            fn($o) => $o['json']['business_name'] === 'Acme Inc'
                && $o['json']['settlement_bank'] === '058'
                && $o['json']['account_number'] === '0123456789'
                && $o['json']['percentage_charge'] === 2.5
        ))
        ->andReturn(Fixtures::subaccount());

    $response = $this->service->createSubaccount('Acme Inc', '058', '0123456789', 2.5);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Subaccount created');
});

it('lists subaccounts with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/subaccount', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(Fixtures::subaccountList());

    $response = $this->service->listSubaccounts();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Subaccounts retrieved');
});

it('fetches a subaccount by identifier', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/subaccount/ACCT_xxx')
        ->andReturn(Fixtures::subaccount());

    $response = $this->service->fetchSubaccount('ACCT_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a subaccount with PUT', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/subaccount/ACCT_xxx', Mockery::on(fn($o) => $o['json']['business_name'] === 'Updated'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->updateSubaccount('ACCT_xxx', ['business_name' => 'Updated']);
    expect($response->getStatus())->toBeTrue();
});
