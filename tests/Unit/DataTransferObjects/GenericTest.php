<?php

use Faridibin\Paystack\DataTransferObjects\Generic;

it('exposes scalar attributes via magic access', function () {
    $g = new Generic(['name' => 'John', 'age' => 30]);

    expect($g->name)->toBe('John')
        ->and($g->age)->toBe(30);
});

it('returns null for unknown attributes', function () {
    $g = new Generic(['name' => 'John']);

    expect($g->missing)->toBeNull();
});

it('reports presence with isset', function () {
    $g = new Generic(['name' => 'John', 'empty' => null]);

    expect(isset($g->name))->toBeTrue()
        ->and(isset($g->missing))->toBeFalse()
        ->and(isset($g->empty))->toBeFalse();
});

it('recursively wraps nested arrays in Generic', function () {
    $g = new Generic(['customer' => ['email' => 'a@b.com', 'meta' => ['tier' => 'gold']]]);

    expect($g->customer)->toBeInstanceOf(Generic::class)
        ->and($g->customer->email)->toBe('a@b.com')
        ->and($g->customer->meta)->toBeInstanceOf(Generic::class)
        ->and($g->customer->meta->tier)->toBe('gold');
});

it('round-trips to a nested array via toArray', function () {
    $data = ['id' => 1, 'customer' => ['email' => 'a@b.com']];

    expect((new Generic($data))->toArray())->toBe($data);
});

it('exposes the raw attribute map', function () {
    $g = new Generic(['a' => 1, 'b' => 2]);

    expect($g->getAttributes())->toHaveKeys(['a', 'b']);
});
