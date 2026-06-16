<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Services\Payments\Transactions\Transactions;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Transactions(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('initializes a transaction', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transaction/initialize', Mockery::on(
            fn($o) => $o['json']['amount'] === 10000 && $o['json']['email'] === 'test@example.com'
        ))
        ->andReturn(Fixtures::transactionInitialize());

    $response = $this->service->initialize(10000, 'test@example.com');
    expect($response)->toBeInstanceOf(Response::class);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Authorization URL created');
});

it('verifies a transaction by reference', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/transaction/verify/ref_123')
        ->andReturn(Fixtures::transaction());

    $response = $this->service->verify('ref_123');
    expect($response)->toBeInstanceOf(Response::class);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Verification successful');
});

it('lists transactions with pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/transaction', Mockery::on(fn($o) => $o['query']['perPage'] === 25 && $o['query']['page'] === 2))
        ->andReturn(Fixtures::transactionList());

    $response = $this->service->list(25, 2);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Transactions retrieved');
});

it('fetches a transaction by id', function () {
    $this->client->shouldReceive('send')->once()->with('GET', '/transaction/12345')->andReturn(Fixtures::transaction());

    $response = $this->service->fetch('12345');
    expect($response->getStatus())->toBeTrue();
});

it('charges an authorization with correct payload', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transaction/charge_authorization', Mockery::on(
            fn($o) => $o['json']['authorization_code'] === 'AUTH_xxx'
                && $o['json']['amount'] === 5000
                && $o['json']['email'] === 'customer@example.com'
        ))
        ->andReturn(Fixtures::transaction());

    $response = $this->service->chargeAuthorization('AUTH_xxx', 5000, 'customer@example.com');
    expect($response->getStatus())->toBeTrue();
});

it('uses the correct endpoint for partial debit', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transaction/partial_debit', Mockery::any())
        ->andReturn(Fixtures::transaction());

    $response = $this->service->partialDebit('AUTH_xxx', 5000, Currency::NGN, 'customer@example.com');
    expect($response->getStatus())->toBeTrue();
});

it('exports transactions', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/transaction/export', Mockery::any())
        ->andReturn(['status' => true, 'message' => 'Export successful', 'data' => ['path' => 'https://example.com/export.csv']]);

    $response = $this->service->export();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Export successful');
});

it('fetches transaction totals', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/transaction/totals', Mockery::any())
        ->andReturn([
            'status'  => true,
            'message' => 'Transaction totals',
            'data'    => [
                'total_volume'       => 100000,
                'total_transactions' => 10,
                'pending_transfers'  => 0,
            ],
        ]);

    $response = $this->service->transactionTotals();
    expect($response->getStatus())->toBeTrue();
});

it('fetches transaction timeline', function () {
    $this->client->shouldReceive('send')->once()->with('GET', '/transaction/timeline/12345')->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->viewTransactionTimeline('12345');
    expect($response->getStatus())->toBeTrue();
});
