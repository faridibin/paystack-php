<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Services\Transfers\Transfers;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Transfers(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('initiates a transfer with correct payload', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transfer', Mockery::on(
            fn($o) => $o['json']['amount'] === 50000
                && $o['json']['recipient'] === 'RCP_xxx'
                && $o['json']['reference'] === 'ref_abc123'
        ))
        ->andReturn(Fixtures::transfer());

    $response = $this->service->initiateTransfer(50000, 'RCP_xxx', 'ref_abc123');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Transfer requires OTP to continue');
});

it('finalizes a transfer with otp', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transfer/finalize_transfer', Mockery::on(
            fn($o) => $o['json']['transfer_code'] === 'TRF_xxx' && $o['json']['otp'] === '123456'
        ))
        ->andReturn(Fixtures::transfer());

    $response = $this->service->finalizeTransfer('TRF_xxx', '123456');
    expect($response->getStatus())->toBeTrue();
});

it('uses the correct endpoint for bulk transfer', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transfer/bulk', Mockery::any())
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->initiateBulkTransfer(Currency::NGN, [
        ['amount' => 10000, 'recipient' => 'RCP_1'],
        ['amount' => 20000, 'recipient' => 'RCP_2'],
    ]);
    expect($response->getStatus())->toBeTrue();
});

it('fetches a transfer by identifier', function () {
    $this->client->shouldReceive('send')->once()->with('GET', '/transfer/TRF_xxx')->andReturn(Fixtures::transfer());

    $response = $this->service->fetchTransfer('TRF_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('verifies a transfer by reference', function () {
    $this->client->shouldReceive('send')->once()->with('GET', '/transfer/verify/ref_123')->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->verifyTransfer('ref_123');
    expect($response->getStatus())->toBeTrue();
});

it('exports transfers', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/transfer/export', Mockery::any())
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->exportTransfers();
    expect($response->getStatus())->toBeTrue();
});

it('resends otp with correct payload', function () {
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
    $this->client->shouldReceive('send')->once()->with('POST', '/transfer/disable_otp')->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->disableOtp();
    expect($response->getStatus())->toBeTrue();
});

it('enables otp requirement', function () {
    $this->client->shouldReceive('send')->once()->with('POST', '/transfer/enable_otp')->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->enableOtp();
    expect($response->getStatus())->toBeTrue();
});
