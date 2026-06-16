<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Storefront;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Storefront(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a storefront', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/storefront', Mockery::on(fn($o) => $o['json']['name'] === 'My Store'))
        ->andReturn(['status' => true, 'message' => 'Storefront created', 'data' => ['id' => 1]]);

    $response = $this->service->create(['name' => 'My Store', 'slug' => 'my-store']);
    expect($response->getStatus())->toBeTrue();
});

it('lists storefronts with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/storefront', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->list();
    expect($response->getStatus())->toBeTrue();
});

it('lists storefronts with custom pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/storefront', Mockery::on(
            fn($o) => $o['query']['perPage'] === 10 && $o['query']['page'] === 2
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->list(10, 2);
    expect($response->getStatus())->toBeTrue();
});

it('fetches a storefront by id', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/storefront/1')
        ->andReturn(['status' => true, 'message' => 'Storefront retrieved', 'data' => ['id' => 1]]);

    $response = $this->service->fetch('1');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Storefront retrieved');
});

it('updates a storefront', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/storefront/1', Mockery::on(fn($o) => $o['json']['name'] === 'New Name'))
        ->andReturn(['status' => true, 'message' => 'Storefront updated', 'data' => []]);

    $response = $this->service->update('1', ['name' => 'New Name']);
    expect($response->getStatus())->toBeTrue();
});

it('deletes a storefront', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('DELETE', '/storefront/1')
        ->andReturn(['status' => true, 'message' => 'Storefront deleted', 'data' => []]);

    $response = $this->service->delete('1');
    expect($response->getStatus())->toBeTrue();
});

it('verifies a storefront slug', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/storefront/verify/my-store')
        ->andReturn(['status' => true, 'message' => 'Slug available', 'data' => []]);

    $response = $this->service->verifySlug('my-store');
    expect($response->getStatus())->toBeTrue();
});

it('duplicates a storefront', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/storefront/1/duplicate')
        ->andReturn(['status' => true, 'message' => 'Storefront duplicated', 'data' => []]);

    $response = $this->service->duplicate('1');
    expect($response->getStatus())->toBeTrue();
});

it('publishes a storefront', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/storefront/1/publish')
        ->andReturn(['status' => true, 'message' => 'Storefront published', 'data' => []]);

    $response = $this->service->publish('1');
    expect($response->getStatus())->toBeTrue();
});

it('fetches orders for a storefront', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/storefront/1/order')
        ->andReturn(['status' => true, 'message' => 'Orders retrieved', 'data' => []]);

    $response = $this->service->fetchOrders('1');
    expect($response->getStatus())->toBeTrue();
});

it('lists products for a storefront', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/storefront/1/product')
        ->andReturn(['status' => true, 'message' => 'Products retrieved', 'data' => []]);

    $response = $this->service->listProducts('1');
    expect($response->getStatus())->toBeTrue();
});

it('adds products to a storefront', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/storefront/1/product', Mockery::on(fn($o) => $o['json']['products'] === [10, 20]))
        ->andReturn(['status' => true, 'message' => 'Products added', 'data' => []]);

    $response = $this->service->addProducts('1', ['products' => [10, 20]]);
    expect($response->getStatus())->toBeTrue();
});
