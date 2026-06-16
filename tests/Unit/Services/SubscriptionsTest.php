<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Recurring\Subscriptions;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Subscriptions(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('creates a subscription', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/subscription', Mockery::on(
            fn($o) => $o['json']['customer'] === 'CUS_xxx' && $o['json']['plan'] === 'PLN_xxx'
        ))
        ->andReturn(Fixtures::subscription());

    $response = $this->service->create('CUS_xxx', 'PLN_xxx');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Subscription successfully created');
});

it('lists subscriptions with default pagination', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/subscription', Mockery::on(
            fn($o) => $o['query']['perPage'] === 50 && $o['query']['page'] === 1
        ))
        ->andReturn(Fixtures::subscriptionList());

    $response = $this->service->list();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Subscriptions retrieved');
});

it('fetches a subscription by identifier', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/subscription/SUB_xxx')
        ->andReturn(Fixtures::subscription());

    $response = $this->service->fetch('SUB_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('enables a subscription', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/subscription/enable', Mockery::on(
            fn($o) => $o['json']['code'] === 'SUB_xxx' && $o['json']['token'] === 'tok_xxx'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->toggle('SUB_xxx', 'tok_xxx', true);
    expect($response->getStatus())->toBeTrue();
});

it('disables a subscription', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/subscription/disable', Mockery::on(
            fn($o) => $o['json']['code'] === 'SUB_xxx'
        ))
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->toggle('SUB_xxx', 'tok_xxx', false);
    expect($response->getStatus())->toBeTrue();
});

it('generates an update subscription link', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/subscription/SUB_xxx/manage/link')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->generateUpdateSubscriptionLink('SUB_xxx');
    expect($response->getStatus())->toBeTrue();
});

it('sends an update subscription link email', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('POST', '/subscription/SUB_xxx/manage/email')
        ->andReturn(['status' => true, 'message' => 'Request successful', 'data' => []]);

    $response = $this->service->sendUpdateSubscriptionLink('SUB_xxx');
    expect($response->getStatus())->toBeTrue();
});
