<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\PaymentRequests;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new PaymentRequests(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a payment request', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/paymentrequest', Mockery::on(
            fn($o) => $o['json']['customer'] === 'CUS_xxx' && $o['json']['amount'] === 5000
        ))
        ->andReturn(Fixtures::paymentRequest());

    $response = $this->service->createPaymentRequest('CUS_xxx', 5000);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Payment request created');
});

it('lists payment requests', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/paymentrequest', Mockery::any())
        ->andReturn(['status' => true, 'message' => 'Payment requests retrieved', 'data' => [Fixtures::paymentRequest()['data']]]);

    $response = $this->service->listPaymentRequests('CUS_xxx', 'pending', 'NGN', false);
    expect($response->getStatus())->toBeTrue();
});

it('fetches a payment request by identifier', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/paymentrequest/PRQ_xxx')
        ->andReturn(Fixtures::paymentRequest());

    $response = $this->service->fetchPaymentRequest('PRQ_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('verifies a payment request by code', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/paymentrequest/verify/PRQ_xxx')
        ->andReturn(Fixtures::paymentRequest());

    $response = $this->service->verifyPaymentRequest('PRQ_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('sends a notification for a payment request', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/paymentrequest/notify/PRQ_xxx')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->sendNotification('PRQ_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('gets payment request totals', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/paymentrequest/totals')
        ->andReturn(['status' => true, 'message' => 'Payment request totals', 'data' => ['pending' => 0, 'successful' => 0, 'total' => 0]]);

    $response = $this->service->paymentRequestTotal();
    expect($response->getStatus())->toBeTrue();
});

it('finalizes a draft payment request', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/paymentrequest/finalize/PRQ_xxx', Mockery::on(fn($o) => $o['json']['notify'] === true))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->finalizePayment('PRQ_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a payment request', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/paymentrequest/PRQ_xxx', Mockery::on(fn($o) => $o['json']['amount'] === 10000))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->updatePaymentRequest('PRQ_xxx', ['amount' => 10000]);
    expect($response->getStatus())->toBeTrue();
});

it('archives a payment request', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/paymentrequest/archive/PRQ_xxx')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->archivePaymentRequest('PRQ_xxx');
    expect($response->getStatus())->toBeTrue();
});
