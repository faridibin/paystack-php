<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Services\Miscellaneous;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->service = new Miscellaneous(client: $this->client);
});

afterEach(fn() => Mockery::close());

it('lists supported countries', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/country')
        ->andReturn(Fixtures::countryList());

    $response = $this->service->listCountries();
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Countries retrieved');
});

it('lists states for a country', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/address_verification/states', Mockery::on(fn($o) => $o['query']['country'] === 'US'))
        ->andReturn(['status' => true, 'message' => 'States retrieved', 'data' => [['name' => 'Lagos', 'slug' => 'lagos', 'abbreviation' => 'LA']]]);

    $response = $this->service->listStates('US');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('States retrieved');
});

it('lists banks for a country', function () {
    $this->client->shouldReceive('send')
        ->once()
        ->with('GET', '/bank', Mockery::on(fn($o) => $o['query']['country'] === 'nigeria'))
        ->andReturn(Fixtures::bankList());

    $response = $this->service->listBanks('nigeria');
    expect($response->getStatus())->toBeTrue();
    expect($response->getMessage())->toBe('Banks retrieved');
});
