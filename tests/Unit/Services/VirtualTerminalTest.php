<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\VirtualTerminal;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new VirtualTerminal(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a virtual terminal', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/virtual_terminal', Mockery::on(fn($o) => $o['json']['name'] === 'Main Terminal'))
        ->andReturn(['status' => true, 'message' => 'Virtual Terminal created', 'data' => ['id' => 'VT_xxx', 'name' => 'Main Terminal']]);

    $response = $this->service->create(['name' => 'Main Terminal']);
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Virtual Terminal created');
});

it('lists virtual terminals with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/virtual_terminal', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->list();
    expect($response->getStatus())->toBeTrue();
});

it('fetches a virtual terminal by code', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/virtual_terminal/VT_xxx')
        ->andReturn(['status' => true, 'message' => 'Virtual Terminal created', 'data' => ['id' => 'VT_xxx', 'name' => 'Main Terminal']]);

    $response = $this->service->fetch('VT_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a virtual terminal with PUT', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/virtual_terminal/VT_xxx', Mockery::on(fn($o) => $o['json']['name'] === 'Updated'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->update('VT_xxx', ['name' => 'Updated']);
    expect($response->getStatus())->toBeTrue();
});

it('deactivates a virtual terminal', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/virtual_terminal/VT_xxx/deactivate')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->deactivate('VT_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('assigns a destination to a virtual terminal', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/virtual_terminal/VT_xxx/destination/assign', Mockery::on(fn($o) => $o['json']['type'] === 'whatsapp'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->assignDestination('VT_xxx', ['type' => 'whatsapp']);
    expect($response->getStatus())->toBeTrue();
});

it('unassigns a destination from a virtual terminal', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/virtual_terminal/VT_xxx/destination/unassign')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->unassignDestination('VT_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('adds a split code to a virtual terminal', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/virtual_terminal/VT_xxx/split_code', Mockery::on(fn($o) => $o['json']['split_code'] === 'SPL_xxx'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->addSplitCode('VT_xxx', 'SPL_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('removes a split code from a virtual terminal', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('DELETE', '/virtual_terminal/VT_xxx/split_code')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->removeSplitCode('VT_xxx');
    expect($response->getStatus())->toBeTrue();
});
