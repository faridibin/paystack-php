<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\ApplePay;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new ApplePay(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('registers a domain for apple pay', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/apple-pay/domain', Mockery::on(fn($o) => $o['json']['domainName'] === 'example.com'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->registerDomain('example.com');
    expect($response->getStatus())->toBeTrue();
});

it('lists registered apple pay domains', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/apple-pay/domain', Mockery::any())
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->listDomains();
    expect($response->getStatus())->toBeTrue();
});

it('unregisters a domain from apple pay', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('DELETE', '/apple-pay/domain', Mockery::on(fn($o) => $o['json']['domainName'] === 'example.com'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->unregisterDomain('example.com');
    expect($response->getStatus())->toBeTrue();
});
