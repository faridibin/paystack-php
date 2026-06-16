<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Commerce\Products;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Products(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a product', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/product', Mockery::on(
            fn($o) => $o['json']['name'] === 'T-shirt'
                && $o['json']['price'] === 2500
                && $o['json']['currency'] === 'NGN'
        ))
        ->andReturn(Fixtures::product());

    $response = $this->service->createProduct('T-shirt', 'A nice shirt', 2500, 'NGN');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Product successfully created');
});

it('fetches a product by id', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/product/PROD_xxx')
        ->andReturn(Fixtures::product());

    $response = $this->service->fetchProduct('PROD_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a product with PUT', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/product/PROD_xxx', Mockery::on(fn($o) => $o['json']['name'] === 'Updated Shirt'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->updateProduct('PROD_xxx', ['name' => 'Updated Shirt']);
    expect($response->getStatus())->toBeTrue();
});

it('lists products with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/product', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(Fixtures::productList());

    $response = $this->service->listProducts();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Products retrieved');
});

it('deletes a product by id', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('DELETE', '/product/PROD_xxx')
        ->andReturn(['status' => true, 'message' => 'Product successfully deleted', 'data' => []]);

    $response = $this->service->deleteProduct('PROD_xxx');
    expect($response->getStatus())->toBeTrue();
});
