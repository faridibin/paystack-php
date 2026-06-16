<?php

use Faridibin\Paystack\DataTransferObjects\Collection;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;

it('hydrates each item into the given DTO class', function () {
    $collection = new Collection([
        ['id' => 1, 'name' => 'Basic', 'currency' => 'NGN', 'interval' => 'monthly'],
        ['id' => 2, 'name' => 'Pro', 'currency' => 'NGN', 'interval' => 'annually'],
    ], PlanDTO::class);

    expect($collection->get())->toHaveCount(2)
        ->and($collection->get()[0])->toBeInstanceOf(PlanDTO::class)
        ->and($collection->get()[0]->name)->toBe('Basic')
        ->and($collection->get()[1]->id)->toBe(2);
});

it('keeps items as-is when no DTO class is given', function () {
    $rows = [['a' => 1], ['b' => 2]];

    expect((new Collection($rows))->get())->toBe($rows);
});

it('keeps items as-is when the DTO class does not exist', function () {
    $rows = [['a' => 1]];

    expect((new Collection($rows, 'Nope\\DoesNotExist'))->get())->toBe($rows);
});

it('serializes hydrated DTOs back to arrays', function () {
    $collection = new Collection([
        ['id' => 1, 'name' => 'Basic', 'currency' => 'NGN', 'interval' => 'monthly'],
    ], PlanDTO::class);

    $array = $collection->toArray();

    expect($array)->toHaveCount(1)
        ->and($array[0]['name'])->toBe('Basic')
        ->and($array[0]['currency'])->toBe('NGN');
});

it('handles an empty collection', function () {
    expect((new Collection([], PlanDTO::class))->get())->toBe([]);
});
