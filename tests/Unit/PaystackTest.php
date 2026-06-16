<?php

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\CustomersInterface;
use Faridibin\Paystack\Contracts\Services\Payments\Transactions\TransactionsInterface;
use Faridibin\Paystack\Exceptions\PaystackException;
use Faridibin\Paystack\Health;
use Faridibin\Paystack\Paystack;
use Faridibin\Paystack\Services\Payments\Customers;
use Faridibin\Paystack\Services\Payments\Transactions\Transactions;
use Mockery\MockInterface;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);
    $this->paystack = new Paystack('sk_test_abc', $this->client);
});

afterEach(fn() => Mockery::close());

it('throws without a secret key', function () {
    new Paystack(null);
})->throws(PaystackException::class, 'Secret key is required.');

it('resolves the health service', function () {
    expect($this->paystack->health())->toBeInstanceOf(Health::class);
});

it('resolves a registered service', function () {
    $this->paystack->registerService('transactions', Transactions::class, TransactionsInterface::class);

    expect($this->paystack->transactions())->toBeInstanceOf(Transactions::class);
});

it('caches service instances', function () {
    $this->paystack->registerService('customers', Customers::class, CustomersInterface::class);

    $first = $this->paystack->customers();
    $second = $this->paystack->customers();

    expect($first)->toBe($second);
});

it('throws for an unknown service', function () {
    $this->paystack->unknown();
})->throws(PaystackException::class, 'Service [unknown] not found.');

it('registers multiple services at once', function () {
    $this->paystack->registerServices([
        'transactions' => [Transactions::class, TransactionsInterface::class],
        'customers' => [Customers::class, CustomersInterface::class],
    ]);

    expect($this->paystack->transactions())->toBeInstanceOf(Transactions::class)
        ->and($this->paystack->customers())->toBeInstanceOf(Customers::class);
});
