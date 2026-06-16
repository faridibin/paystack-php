<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\Refunds;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Refunds(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a refund for a transaction', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/refund', Mockery::on(fn($o) => $o['json']['transaction'] === 'TXN_xxx'))
        ->andReturn(Fixtures::refund());

    $response = $this->service->createRefund('TXN_xxx');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Refund created');
});

it('retries a failed refund', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/refund/retry_with_customer_details/REF_xxx', Mockery::on(
            fn($o) => $o['json']['refund_account_details']['currency'] === 'NGN'
                && $o['json']['refund_account_details']['account_number'] === '0123456789'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->retryRefund('REF_xxx', 'NGN', 'bank_123', '0123456789');
    expect($response->getStatus())->toBeTrue();
});

it('lists refunds for a transaction', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/refund', Mockery::on(
            fn($o) => $o['query']['transaction'] === 'TXN_xxx' && $o['query']['currency'] === 'NGN'
        ))
        ->andReturn(['status' => true, 'message' => 'Refunds retrieved', 'data' => [Fixtures::refund()['data']]]);

    $response = $this->service->listRefunds('TXN_xxx', 'NGN');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Refunds retrieved');
});

it('fetches a refund by id', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/refund/REF_xxx')
        ->andReturn(Fixtures::refund());

    $response = $this->service->fetchRefund('REF_xxx');
    expect($response->getStatus())->toBeTrue();
});
