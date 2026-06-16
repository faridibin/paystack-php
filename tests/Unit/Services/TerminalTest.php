<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Payments\Terminal;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Terminal(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('sends an event to a terminal', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/terminal/TRM_xxx/event', Mockery::on(
            fn($o) => $o['json']['type'] === 'invoice'
                && $o['json']['action'] === 'process'
                && $o['json']['data'] === ['id' => 1]
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->sendEvent('TRM_xxx', 'invoice', 'process', ['id' => 1]);
    expect($response->getStatus())->toBeTrue();
});

it('fetches event status', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/terminal/TRM_xxx/event/EVT_xxx')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->fetchEventStatus('TRM_xxx', 'EVT_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('fetches terminal presence/status', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/terminal/TRM_xxx/presence')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->fetchTerminalStatus('TRM_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('lists terminals with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/terminal', Mockery::on(fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->list();
    expect($response->getStatus())->toBeTrue();
});

it('fetches a terminal by id', function () {
    $this->client->shouldReceive('send')->once()->with('GET', '/terminal/TRM_xxx')->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->fetch('TRM_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('updates a terminal', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('PUT', '/terminal/TRM_xxx', Mockery::on(fn($o) => $o['json']['name'] === 'My Terminal'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->update('TRM_xxx', ['name' => 'My Terminal']);
    expect($response->getStatus())->toBeTrue();
});

it('commissions a terminal by serial number', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/terminal/commission_device', Mockery::on(fn($o) => $o['json']['serial_number'] === 'SN123'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->commission('SN123');
    expect($response->getStatus())->toBeTrue();
});

it('decommissions a terminal by serial number', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/terminal/decommission_device', Mockery::on(fn($o) => $o['json']['serial_number'] === 'SN123'))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->decommission('SN123');
    expect($response->getStatus())->toBeTrue();
});
