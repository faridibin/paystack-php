<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Order;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Order(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates an order with the given data', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/order', Mockery::on(fn($o) => $o['json']['amount'] === 5000))
        ->andReturn(['status' => true, 'message' => 'Order created', 'data' => ['id' => 'ord_xxx', 'amount' => 5000]]);

    $response = $this->service->create(['amount' => 5000, 'currency' => 'NGN']);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Order created');
});

it('lists orders with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/order', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(['status' => true, 'message' => 'Orders retrieved', 'data' => []]);

    $response = $this->service->list();
    expect($response->getStatus())->toBeTrue();
});

it('lists orders with custom pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/order', Mockery::on(
            fn($o) => $o['query']['perPage'] === 20 && $o['query']['page'] === 3
        ))
        ->andReturn(['status' => true, 'message' => 'Orders retrieved', 'data' => []]);

    $response = $this->service->list(20, 3);
    expect($response->getStatus())->toBeTrue();
});

it('fetches an order by id', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/order/ord_xxx')
        ->andReturn(['status' => true, 'message' => 'Order retrieved', 'data' => ['id' => 'ord_xxx', 'amount' => 5000]]);

    $response = $this->service->fetch('ord_xxx');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Order retrieved');
});

it('fetches orders for a product', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/order/product/123')
        ->andReturn(['status' => true, 'message' => 'Orders retrieved', 'data' => []]);

    $response = $this->service->fetchByProduct('123');
    expect($response->getStatus())->toBeTrue();
});

it('validates a pay-for-me order', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/order/ORD_xxx/validate')
        ->andReturn(['status' => true, 'message' => 'Order validated', 'data' => []]);

    $response = $this->service->validate('ORD_xxx');
    expect($response->getStatus())->toBeTrue();
});
