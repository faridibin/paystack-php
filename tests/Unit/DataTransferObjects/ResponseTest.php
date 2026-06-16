<?php

use Faridibin\Paystack\DataTransferObjects\Collection;
use Faridibin\Paystack\DataTransferObjects\Generic;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Exceptions\PaystackException;

it('reads top-level status, message and code', function () {
    $response = new Response(['status' => true, 'message' => 'OK', 'code' => 201, 'data' => []]);

    expect($response->getStatus())->toBeTrue()
        ->and($response->getMessage())->toBe('OK')
        ->and($response->getStatusCode())->toBe(201);
});

it('defaults code to 200 and missing fields gracefully', function () {
    $response = new Response(['data' => ['x' => 1]]);

    expect($response->getStatus())->toBeFalse()
        ->and($response->getMessage())->toBe('')
        ->and($response->getStatusCode())->toBe(200);
});

it('wraps untyped data in a Generic DTO', function () {
    $response = new Response(['status' => true, 'data' => ['reference' => 'ref_1']]);

    expect($response->getData())->toBeInstanceOf(Generic::class)
        ->and($response->getData()->reference)->toBe('ref_1');
});

it('transforms data into the given DTO class', function () {
    $response = new Response(
        ['status' => true, 'data' => ['id' => 7, 'name' => 'Gold', 'currency' => 'NGN', 'interval' => 'monthly']],
        PlanDTO::class
    );

    expect($response->getData())->toBeInstanceOf(PlanDTO::class)
        ->and($response->getData()->id)->toBe(7)
        ->and($response->getData()->name)->toBe('Gold');
});

it('transforms a list into a typed Collection when isCollection is true', function () {
    $response = new Response(
        ['status' => true, 'data' => [
            ['id' => 1, 'name' => 'A', 'currency' => 'NGN', 'interval' => 'monthly'],
            ['id' => 2, 'name' => 'B', 'currency' => 'NGN', 'interval' => 'monthly'],
        ]],
        PlanDTO::class,
        true
    );

    expect($response->getData())->toBeInstanceOf(Collection::class)
        ->and($response->getData()->get())->toHaveCount(2)
        ->and($response->getData()->get()[0])->toBeInstanceOf(PlanDTO::class);
});

it('wraps meta in a Generic DTO', function () {
    $response = new Response(['status' => true, 'data' => [], 'meta' => ['total' => 50, 'page' => 1]]);

    expect($response->getMeta())->toBeInstanceOf(Generic::class)
        ->and($response->getMeta()->total)->toBe(50);
});

it('has null meta when absent', function () {
    expect((new Response(['status' => true, 'data' => []]))->getMeta())->toBeNull();
});

it('reads a key off the data DTO via get()', function () {
    $response = new Response(['status' => true, 'data' => ['reference' => 'ref_9']]);

    expect($response->get('reference'))->toBe('ref_9')
        ->and($response->get('missing', 'fallback'))->toBe('fallback');
});

it('maps an exception into a failed response', function () {
    $response = new Response(new PaystackException('Boom', 422));

    expect($response->getStatus())->toBeFalse()
        ->and($response->getStatusCode())->toBe(422)
        ->and($response->getMessage())->toBe('Boom')
        ->and($response->getData())->toBeInstanceOf(Generic::class)
        ->and($response->getData()->error)->toBe('Boom');
});

it('defaults exception status code to 500 when the exception has none', function () {
    $response = new Response(new PaystackException('No code'));

    expect($response->getStatusCode())->toBe(500);
});

it('serializes back to an array including meta', function () {
    $response = new Response(['status' => true, 'message' => 'OK', 'data' => ['a' => 1], 'meta' => ['total' => 3]]);

    $array = $response->toArray();

    expect($array)->toMatchArray(['status' => true, 'message' => 'OK'])
        ->and($array['data'])->toBe(['a' => 1])
        ->and($array['meta'])->toBe(['total' => 3]);
});
