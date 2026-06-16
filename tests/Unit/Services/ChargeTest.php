<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\Charge;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Charge(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a charge with email and amount', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/charge', Mockery::on(
            fn($o) => $o['json']['email'] === 'user@example.com' && $o['json']['amount'] === 10000
        ))
        ->andReturn(Fixtures::charge());

    $response = $this->service->create('user@example.com', 10000);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Charge attempted');
});

it('submits a PIN', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/charge/submit_pin', Mockery::on(
            fn($o) => $o['json']['pin'] === '1234' && $o['json']['reference'] === 'ref_xxx'
        ))
        ->andReturn(Fixtures::charge());

    $response = $this->service->submitPin('1234', 'ref_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('submits an OTP', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/charge/submit_otp', Mockery::on(
            fn($o) => $o['json']['otp'] === '123456' && $o['json']['reference'] === 'ref_xxx'
        ))
        ->andReturn(Fixtures::charge());

    $response = $this->service->submitOtp('123456', 'ref_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('submits a phone number', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/charge/submit_phone', Mockery::on(
            fn($o) => $o['json']['phone'] === '+2348000000000'
        ))
        ->andReturn(Fixtures::charge());

    $response = $this->service->submitPhone('+2348000000000', 'ref_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('submits a birthday', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/charge/submit_birthday', Mockery::on(
            fn($o) => $o['json']['birthday'] === '1990-01-15'
        ))
        ->andReturn(Fixtures::charge());

    $response = $this->service->submitBirthday('1990-01-15', 'ref_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('submits an address', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/charge/submit_address', Mockery::on(
            fn($o) => $o['json']['address'] === '1 Lagos St'
                && $o['json']['city'] === 'Lagos'
                && $o['json']['zip_code'] === '100001'
        ))
        ->andReturn(Fixtures::charge());

    $response = $this->service->submitAddress('1 Lagos St', 'Lagos', 'Lagos', '100001', 'ref_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('checks a pending charge by reference', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/charge/ref_xxx')
        ->andReturn(Fixtures::charge());

    $response = $this->service->checkPendingCharge('ref_xxx');
    expect($response->getStatus())->toBeTrue();
});
