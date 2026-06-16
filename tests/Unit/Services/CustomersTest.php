<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Services\Payments\Customers;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Customers(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a customer', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/customer', Mockery::any())
        ->andReturn(Fixtures::customer());

    $response = $this->service->create(['email' => 'test@example.com']);
    expect($response)->toBeInstanceOf(Response::class);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Customer created');
});

it('fetches a customer by code', function () {
    $this->client->shouldReceive('send')->once()->with('GET', '/customer/CUS_xxx')->andReturn(Fixtures::customer());

    $response = $this->service->fetch('CUS_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a customer', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/customer/CUS_xxx', Mockery::any())
        ->andReturn(Fixtures::customer());

    $response = $this->service->update('CUS_xxx', ['first_name' => 'Updated']);
    expect($response->getStatus())->toBeTrue();
});

it('lists customers with pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/customer', Mockery::on(fn($o) => $o['query']['perPage'] === 10 && $o['query']['page'] === 1))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->list(10, 1);
    expect($response->getStatus())->toBeTrue();
});

it('sets risk status with correct payload', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/customer/set_risk_action', Mockery::on(
            fn($o) => $o['json']['customer'] === 'CUS_xxx' && $o['json']['risk_action'] === 'blacklist'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->setRiskStatus('CUS_xxx', 'blacklist');
    expect($response->getStatus())->toBeTrue();
});

it('deactivates an authorization', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/customer/authorization/deactivate', Mockery::on(
            fn($o) => $o['json']['authorization_code'] === 'AUTH_xxx'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->deactivateAuthorization('AUTH_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('initializes an authorization', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/customer/authorization/initialize', Mockery::on(
            fn($o) => $o['json']['email'] === 'test@example.com' && $o['json']['channel'] === 'direct_debit'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->initializeAuthorization('test@example.com');
    expect($response->getStatus())->toBeTrue();
});

it('verifies an authorization by reference', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/customer/authorization/verify/ref_123')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->verifyAuthorization('ref_123');
    expect($response->getStatus())->toBeTrue();
});

it('initializes direct debit for a customer', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/customer/CUS_xxx/initialize-direct-debit', Mockery::any())
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->initializeDirectDebit('CUS_xxx', ['bank_code' => '057']);
    expect($response->getStatus())->toBeTrue();
});

it('fetches mandate authorizations for a customer', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/customer/CUS_xxx/directdebit-mandate-authorizations')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->fetchMandateAuthorizations('CUS_xxx');
    expect($response->getStatus())->toBeTrue();
});
