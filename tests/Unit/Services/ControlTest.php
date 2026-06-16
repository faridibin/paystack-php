<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Transfers\Control;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Control(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('checks the integration balance', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/balance')
        ->andReturn(['status' => true, 'message' => 'Balances retrieved', 'data' => []]);

    $response = $this->service->checkBalance();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Balances retrieved');
});

it('fetches the balance ledger', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/balance/ledger')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->fetchBalanceLedger();
    expect($response->getStatus())->toBeTrue();
});

it('resends transfer OTP', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transfer/resend_otp', Mockery::on(
            fn($o) => $o['json']['transfer_code'] === 'TRF_xxx' && $o['json']['reason'] === 'resend_otp'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->resendOtp('TRF_xxx', 'resend_otp');
    expect($response->getStatus())->toBeTrue();
});

it('disables otp requirement', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transfer/disable_otp')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->disableOtp();
    expect($response->getStatus())->toBeTrue();
});

it('finalizes disable otp with code', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transfer/disable_otp_finalize', Mockery::on(fn($o) => $o['json']['otp'] === '123456'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->finalizeDisableOtp('123456');
    expect($response->getStatus())->toBeTrue();
});

it('enables otp requirement', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transfer/enable_otp')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->enableOtp();
    expect($response->getStatus())->toBeTrue();
});
