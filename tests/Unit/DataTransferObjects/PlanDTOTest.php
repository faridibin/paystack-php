<?php

use Faridibin\Paystack\DataTransferObjects\Collection;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Interval;

it('hydrates from a raw Paystack data payload', function () {
    $dto = new PlanDTO(...Fixtures::plan()['data']);

    expect($dto->id)->toBe(28)
        ->and($dto->name)->toBe('Monthly Retainer')
        ->and($dto->plan_code)->toBe('PLN_gx2wn373dvkern4')
        ->and($dto->amount)->toBe(50000);
});

it('coerces string currency and interval into enums', function () {
    $dto = new PlanDTO(...Fixtures::plan()['data']);

    expect($dto->currency)->toBe(Currency::NGN)
        ->and($dto->interval)->toBe(Interval::MONTHLY);
});

it('parses ISO date strings into DateTime', function () {
    $dto = new PlanDTO(...Fixtures::plan()['data']);

    expect($dto->createdAt)->toBeInstanceOf(DateTime::class)
        ->and($dto->createdAt->format('Y-m-d'))->toBe('2016-03-29');
});

it('normalizes integer flags into booleans', function () {
    $data = ['name' => 'X', 'currency' => 'NGN', 'interval' => 'monthly', 'send_invoices' => 1, 'send_sms' => 0];

    $dto = new PlanDTO(...$data);

    expect($dto->send_invoices)->toBeTrue()
        ->and($dto->send_sms)->toBeFalse();
});

it('wraps nested relations in typed collections', function () {
    $dto = new PlanDTO(...Fixtures::plan()['data']);

    expect($dto->pages)->toBeInstanceOf(Collection::class)
        ->and($dto->subscriptions)->toBeInstanceOf(Collection::class)
        ->and($dto->subscribers)->toBeInstanceOf(Collection::class);
});

it('absorbs unknown keys via the variadic catch-all without erroring', function () {
    $data = Fixtures::plan()['data'];
    $data['some_future_field'] = 'whatever';

    $dto = new PlanDTO(...$data);

    expect($dto->name)->toBe('Monthly Retainer');
});

it('serializes back to an array with enums and dates flattened', function () {
    $array = (new PlanDTO(...Fixtures::plan()['data']))->toArray();

    expect($array['currency'])->toBe('NGN')
        ->and($array['interval'])->toBe('monthly')
        ->and($array['createdAt'])->toBe('2016-03-29 22:42:50')
        ->and($array)->not->toHaveKey('description'); // null values are omitted
});
