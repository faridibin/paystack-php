<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\Disputes;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Disputes(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('lists disputes with date range', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/dispute', Mockery::on(
            fn($o) => $o['query']['from'] === '2024-01-01' && $o['query']['to'] === '2024-12-31'
        ))
        ->andReturn(Fixtures::disputeList());

    $response = $this->service->listDisputes('2024-01-01', '2024-12-31');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Disputes retrieved');
});

it('fetches a dispute by id', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/dispute/DIS_xxx')
        ->andReturn(['status' => true, 'message' => 'Dispute retrieved', 'data' => Fixtures::disputeList()['data'][0]]);

    $response = $this->service->fetchDispute('DIS_xxx');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Dispute retrieved');
});

it('lists disputes for a transaction', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/dispute/transaction/TXN_xxx')
        ->andReturn(['status' => true, 'message' => 'Dispute retrieved', 'data' => Fixtures::disputeList()['data'][0]]);

    $response = $this->service->listTransactionDisputes('TXN_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a dispute', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/dispute/DIS_xxx', Mockery::on(fn($o) => isset($o['json'])))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->updateDispute('DIS_xxx', ['refund_amount' => 500]);
    expect($response->getStatus())->toBeTrue();
});

it('adds evidence to a dispute', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/dispute/DIS_xxx/evidence', Mockery::on(
            fn($o) => $o['json']['customer_email'] === 'user@example.com'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->addEvidence('DIS_xxx', 'user@example.com', 'John Doe', '+2348000000000', 'Software subscription');
    expect($response->getStatus())->toBeTrue();
});

it('gets the upload url for evidence', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/dispute/DIS_xxx/upload_url', Mockery::on(fn($o) => $o['query']['filename'] === 'receipt.pdf'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->getUploadUrl('DIS_xxx', 'receipt.pdf');
    expect($response->getStatus())->toBeTrue();
});

it('resolves a dispute', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/dispute/DIS_xxx/resolve', Mockery::on(
            fn($o) => $o['json']['resolution'] === 'merchant-accepted'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->resolveDispute('DIS_xxx', 'merchant-accepted', 'Resolved in favour of merchant', 0, 'receipt.pdf');
    expect($response->getStatus())->toBeTrue();
});

it('exports disputes with date range', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/dispute/export', Mockery::on(
            fn($o) => $o['query']['from'] === '2024-01-01'
        ))
        ->andReturn(Fixtures::disputeList());

    $response = $this->service->exportDisputes('2024-01-01', '2024-12-31');
    expect($response->getStatus())->toBeTrue();
});
