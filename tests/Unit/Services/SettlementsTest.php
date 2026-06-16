<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\Settlements;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Settlements(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('lists settlements with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/settlement', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(Fixtures::settlementList());

    $response = $this->service->listSettlements();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Settlements retrieved');
});

it('lists settlement transactions for a settlement id', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/settlement/STL_xxx/transactions', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(['status' => true, 'message' => 'Settlement transactions retrieved', 'data' => []]);

    $response = $this->service->listSettlementTransactions('STL_xxx');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Settlement transactions retrieved');
});
