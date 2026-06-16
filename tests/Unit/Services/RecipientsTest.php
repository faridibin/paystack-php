<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Transfers\Recipients;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Recipients(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a recipient with required fields', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transferrecipient', Mockery::on(
            fn($o) => $o['json']['type'] === 'nuban'
                && $o['json']['name'] === 'John Doe'
                && $o['json']['account_number'] === '0123456789'
                && $o['json']['bank_code'] === '058'
        ))
        ->andReturn(['status' => true, 'message' => 'Transfer recipient created successfully', 'data' => []]);

    $response = $this->service->createRecipient('nuban', 'John Doe', '0123456789', '058');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Transfer recipient created successfully');
});

it('creates bulk recipients', function () {
    $batch = [
        ['type' => 'nuban', 'name' => 'A', 'account_number' => '001', 'bank_code' => '058'],
        ['type' => 'nuban', 'name' => 'B', 'account_number' => '002', 'bank_code' => '058'],
    ];

    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/transferrecipient/bulk', Mockery::on(fn($o) => count($o['json']['batch']) === 2))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->createBulkRecipients($batch);
    expect($response->getStatus())->toBeTrue();
});

it('lists recipients with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/transferrecipient', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(['status' => true, 'message' => 'Transfer recipients retrieved', 'data' => []]);

    $response = $this->service->listRecipients();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Transfer recipients retrieved');
});

it('fetches a recipient by identifier', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/transferrecipient/RCP_xxx')
        ->andReturn(['status' => true, 'message' => 'Transfer recipient retrieved', 'data' => []]);

    $response = $this->service->fetchRecipient('RCP_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a recipient with PUT', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/transferrecipient/RCP_xxx', Mockery::on(fn($o) => $o['json']['name'] === 'Updated'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->updateRecipient('RCP_xxx', ['name' => 'Updated']);
    expect($response->getStatus())->toBeTrue();
});

it('deletes a recipient using DELETE', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('DELETE', '/transferrecipient/RCP_xxx')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->deleteRecipient('RCP_xxx');
    expect($response->getStatus())->toBeTrue();
});
