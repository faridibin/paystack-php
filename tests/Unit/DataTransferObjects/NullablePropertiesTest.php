<?php

/**
 * Regression guard for the "uninitialized typed property" bug class.
 *
 * Several DTOs declared non-nullable typed properties (enums, DateTime) and
 * assigned them only inside conditional branches. When the source API field
 * was absent the property was never initialized, so accessing it threw
 * `Error: Typed property ... must not be accessed before initialization`.
 *
 * These tests construct each affected DTO with the relevant field(s) absent and
 * assert the property reads back as null (and toArray() does not throw).
 */

use Faridibin\Paystack\DataTransferObjects\Payments\AuthorizationDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\CustomerDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\InvoiceDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\PageDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\SubaccountDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\Transactions\TransactionDTO;
use Faridibin\Paystack\DataTransferObjects\Miscellaneous\Logs\LogDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\SubscriberDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\SubscriptionDTO;
use Faridibin\Paystack\DataTransferObjects\Transfers\RecipientDTO;
use Faridibin\Paystack\Enums\Status;

it('PlanDTO leaves enum and date fields null when absent', function () {
    $dto = new PlanDTO(name: 'Bare');

    expect($dto->currency)->toBeNull()
        ->and($dto->interval)->toBeNull()
        ->and($dto->createdAt)->toBeNull()
        ->and($dto->updatedAt)->toBeNull()
        ->and($dto->toArray())->toBeArray();
});

it('SubscriberDTO leaves currency and status null when absent', function () {
    $dto = new SubscriberDTO(customer_email: 'a@b.com');

    expect($dto->currency)->toBeNull()
        ->and($dto->status)->toBeNull()
        ->and($dto->toArray())->toBeArray();
});

it('SubscriptionDTO leaves dates null and defaults status to UNKNOWN when absent', function () {
    $dto = new SubscriptionDTO(subscription_code: 'SUB_x');

    expect($dto->createdAt)->toBeNull()
        ->and($dto->updatedAt)->toBeNull()
        ->and($dto->next_payment_date)->toBeNull()
        ->and($dto->start)->toBeNull()
        ->and($dto->cancelledAt)->toBeNull()
        ->and($dto->status)->toBe(Status::UNKNOWN);
});

it('SubaccountDTO leaves currency and dates null when absent', function () {
    $dto = new SubaccountDTO(business_name: 'Acme');

    expect($dto->currency)->toBeNull()
        ->and($dto->createdAt)->toBeNull()
        ->and($dto->updatedAt)->toBeNull();
});

it('PageDTO leaves type, currency and dates null when absent', function () {
    $dto = new PageDTO(name: 'Page');

    expect($dto->type)->toBeNull()
        ->and($dto->currency)->toBeNull()
        ->and($dto->createdAt)->toBeNull()
        ->and($dto->updatedAt)->toBeNull();
});

it('TransactionDTO leaves enums and dates null when absent', function () {
    $dto = new TransactionDTO(reference: 'ref');

    expect($dto->currency)->toBeNull()
        ->and($dto->status)->toBeNull()
        ->and($dto->channel)->toBeNull()
        ->and($dto->createdAt)->toBeNull()
        ->and($dto->paidAt)->toBeNull()
        ->and($dto->transactionDate)->toBeNull();
});

it('AuthorizationDTO leaves channel, exp_month and reusable null when absent', function () {
    $dto = new AuthorizationDTO(authorization_code: 'AUTH_x');

    expect($dto->channel)->toBeNull()
        ->and($dto->exp_month)->toBeNull()
        ->and($dto->reusable)->toBeNull();
});

it('InvoiceDTO leaves enums and dates null when absent', function () {
    $dto = new InvoiceDTO(invoice_code: 'INV_x');

    expect($dto->currency)->toBeNull()
        ->and($dto->channel)->toBeNull()
        ->and($dto->status)->toBeNull()
        ->and($dto->createdAt)->toBeNull()
        ->and($dto->periodStart)->toBeNull()
        ->and($dto->nextNotification)->toBeNull();
});

it('CustomerDTO leaves dates null when absent', function () {
    $dto = new CustomerDTO(email: 'a@b.com');

    expect($dto->createdAt)->toBeNull()
        ->and($dto->updatedAt)->toBeNull();
});

it('RecipientDTO leaves type, currency and dates null when absent', function () {
    $dto = new RecipientDTO(name: 'John');

    expect($dto->type)->toBeNull()
        ->and($dto->currency)->toBeNull()
        ->and($dto->createdAt)->toBeNull()
        ->and($dto->updatedAt)->toBeNull();
});

it('LogDTO leaves start_time null when absent and getEndTime returns null', function () {
    $dto = new LogDTO(attempts: 1);

    expect($dto->start_time)->toBeNull()
        ->and($dto->getEndTime())->toBeNull();
});

it('still resolves enums and dates when the fields ARE present', function () {
    $dto = new PlanDTO(name: 'Full', currency: 'NGN', interval: 'monthly', createdAt: '2020-01-01T00:00:00Z');

    expect($dto->currency?->value)->toBe('NGN')
        ->and($dto->interval?->value)->toBe('monthly')
        ->and($dto->createdAt)->toBeInstanceOf(DateTime::class);
});
