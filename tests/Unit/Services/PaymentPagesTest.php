<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Commerce\PaymentPages;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new PaymentPages(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a payment page', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/page', Mockery::on(fn($o) => $o['json']['name'] === 'My Page'))
        ->andReturn(Fixtures::paymentPage());

    $response = $this->service->createPaymentPage('My Page');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Page created');
});

it('lists payment pages with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/page', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(Fixtures::paymentPageList());

    $response = $this->service->listPaymentPages();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Pages retrieved');
});

it('fetches a payment page by identifier', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/page/pg_xxx')
        ->andReturn(Fixtures::paymentPage());

    $response = $this->service->fetchPaymentPage('pg_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a payment page with PUT', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/page/pg_xxx', Mockery::on(fn($o) => $o['json']['name'] === 'Updated'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->updatePaymentPage('pg_xxx', ['name' => 'Updated']);
    expect($response->getStatus())->toBeTrue();
});

it('checks slug availability', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/page/check_slug_availability/my-slug')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->checkSlugAvailability('my-slug');
    expect($response->getStatus())->toBeTrue();
});

it('adds products to a payment page', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/page/pg_xxx/product', Mockery::on(
            fn($o) => $o['json']['products'] === [1, 2, 3]
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->addProduct('pg_xxx', [1, 2, 3]);
    expect($response->getStatus())->toBeTrue();
});
