<?php

/**
 * Guards the fields that were previously swallowed by the `...$args` catch-all.
 *
 * Now that the constructors enumerate every spec-documented field explicitly,
 * these assertions ensure the data is captured as real typed properties rather
 * than silently dropped. `...$args` remains as a safety net for undocumented
 * fields, so these tests also confirm an unknown key still does not crash.
 */

use Faridibin\Paystack\DataTransferObjects\Payments\InvoiceDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\SubscriptionDTO;
use Faridibin\Paystack\DataTransferObjects\Transfers\RecipientDTO;

it('InvoiceDTO captures the payment-request fields it used to drop', function () {
    $dto = new InvoiceDTO(
        request_code: 'PRQ_x',
        offline_reference: 'OFF_1',
        pdf_url: 'https://x/invoice.pdf',
        split_code: 'SPL_x',
        due_date: '2026-05-01',
        invoice_number: 42,
        pending_amount: 1500,
        has_invoice: true,
        discount: 250,
        line_items: [['name' => 'Item', 'amount' => 1000]],
        tax: [['name' => 'VAT', 'amount' => 75]],
        notifications: [['sent_at' => '2026-04-01']],
    );

    expect($dto->request_code)->toBe('PRQ_x')
        ->and($dto->offline_reference)->toBe('OFF_1')
        ->and($dto->pdf_url)->toBe('https://x/invoice.pdf')
        ->and($dto->split_code)->toBe('SPL_x')
        ->and($dto->due_date)->toBe('2026-05-01')
        ->and($dto->invoice_number)->toBe(42)
        ->and($dto->pending_amount)->toBe(1500)
        ->and($dto->has_invoice)->toBeTrue()
        ->and($dto->discount)->toBe(250)
        ->and($dto->line_items)->toHaveCount(1)
        ->and($dto->tax)->toHaveCount(1)
        ->and($dto->notifications)->toHaveCount(1);
});

it('SubscriptionDTO captures metadata', function () {
    $dto = new SubscriptionDTO(subscription_code: 'SUB_x', metadata: ['custom' => 'value']);

    expect($dto->metadata)->toBe(['custom' => 'value']);
});

it('RecipientDTO captures is_deleted in both Paystack spellings', function () {
    expect((new RecipientDTO(name: 'A', is_deleted: true))->isDeleted)->toBeTrue()
        ->and((new RecipientDTO(name: 'B', isDeleted: false))->isDeleted)->toBeFalse()
        ->and((new RecipientDTO(name: 'C'))->isDeleted)->toBeNull();
});

it('still absorbs genuinely unknown fields without crashing (safety net intact)', function () {
    $dto = new InvoiceDTO(request_code: 'PRQ_x', some_field_paystack_adds_in_2030: 'surprise');

    expect($dto->request_code)->toBe('PRQ_x');
});
