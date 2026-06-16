<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\BulkCharges;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new BulkCharges(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('initiates a bulk charge', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/bulkcharge', Mockery::any())
        ->andReturn(Fixtures::bulkChargeBatch());

    $response = $this->service->initiateBulkCharge([['authorization' => 'AUTH_xxx', 'amount' => 500]]);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Charges have been queued');
});

it('lists bulk charge batches', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/bulkcharge', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(['status' => true, 'message' => 'Bulk charges retrieved', 'data' => [Fixtures::bulkChargeBatch()['data']]]);

    $response = $this->service->listBulkChargeBatches();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Bulk charges retrieved');
});

it('fetches a bulk charge batch', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/bulkcharge/BCH_xxx')
        ->andReturn(Fixtures::bulkChargeBatch());

    $response = $this->service->fetchBulkChargeBatch('BCH_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('fetches charges in a batch filtered by status', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/bulkcharge/BCH_xxx/charges', Mockery::on(fn($o) => $o['query']['status'] === 'success'))
        ->andReturn(['status' => true, 'message' => 'Charges retrieved', 'data' => []]);

    $response = $this->service->fetchChargesInBatch('BCH_xxx', 'success');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Charges retrieved');
});

it('pauses a bulk charge batch', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/bulkcharge/pause/BCH_xxx')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->pauseBulkChargeBatch('BCH_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('resumes a bulk charge batch', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/bulkcharge/resume/BCH_xxx')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->resumeBulkChargeBatch('BCH_xxx');
    expect($response->getStatus())->toBeTrue();
});
