<?php

namespace Faridibin\PaystackLaravel\Enums;

enum WebhookEvent: string
{
    case CHARGE_DISPUTE_CREATE = 'charge.dispute.create';
    case CHARGE_DISPUTE_REMIND = 'charge.dispute.remind';
    case CHARGE_DISPUTE_RESOLVE = 'charge.dispute.resolve';
    case CHARGE_SUCCESS = 'charge.success';
    case CUSTOMER_IDENTIFICATION_FAILED = 'customeridentification.failed';
    case CUSTOMER_IDENTIFICATION_SUCCESS = 'customeridentification.success';
    case DEDICATED_ACCOUNT_ASSIGN_FAILED = 'dedicatedaccount.assign.failed';
    case DEDICATED_ACCOUNT_ASSIGN_SUCCESS = 'dedicatedaccount.assign.success';
    case INVOICE_CREATE = 'invoice.create';
    case INVOICE_PAYMENT_FAILED = 'invoice.payment_failed';
    case INVOICE_UPDATE = 'invoice.update';
    case PAYMENT_REQUEST_PENDING = 'paymentrequest.pending';
    case PAYMENT_REQUEST_SUCCESS = 'paymentrequest.success';
    case REFUND_FAILED = 'refund.failed';
    case REFUND_PENDING = 'refund.pending';
    case REFUND_PROCESSED = 'refund.processed';
    case REFUND_PROCESSING = 'refund.processing';
    case SUBSCRIPTION_CREATE = 'subscription.create';
    case SUBSCRIPTION_DISABLE = 'subscription.disable';
    case SUBSCRIPTION_EXPIRING_CARDS = 'subscription.expiring_cards';
    case SUBSCRIPTION_NOT_RENEW = 'subscription.not_renew';
    case TRANSFER_FAILED = 'transfer.failed';
    case TRANSFER_SUCCESS = 'transfer.success';
    case TRANSFER_REVERSED = 'transfer.reversed';

    /**
     * Get the event description.
     */
    public function description(): string
    {
        return match ($this) {
            self::CHARGE_DISPUTE_CREATE => 'A dispute was logged against your business.',
            self::CHARGE_DISPUTE_REMIND => 'A logged dispute has not been resolved.',
            self::CHARGE_DISPUTE_RESOLVE => 'A dispute has been resolved.',
            self::CHARGE_SUCCESS => 'A successful charge was made.',
            self::CUSTOMER_IDENTIFICATION_FAILED => 'A customer ID validation has failed.',
            self::CUSTOMER_IDENTIFICATION_SUCCESS => 'A customer ID validation was successful.',
            self::DEDICATED_ACCOUNT_ASSIGN_FAILED => 'This is sent when a DVA couldn\'t be created and assigned to a customer.',
            self::DEDICATED_ACCOUNT_ASSIGN_SUCCESS => 'This is sent when a DVA has been successfully created and assigned to a customer.',
            self::INVOICE_CREATE => 'An invoice has been created for a subscription on your account.',
            self::INVOICE_PAYMENT_FAILED => 'A payment for an invoice failed.',
            self::INVOICE_UPDATE => 'An invoice has been updated.',
            self::PAYMENT_REQUEST_PENDING => 'A payment request has been sent to a customer.',
            self::PAYMENT_REQUEST_SUCCESS => 'A payment request has been paid for.',
            self::REFUND_FAILED => 'Refund cannot be processed.',
            self::REFUND_PENDING => 'Refund initiated, waiting for response from the processor.',
            self::REFUND_PROCESSED => 'Refund has successfully been processed by the processor.',
            self::REFUND_PROCESSING => 'Refund has been received by the processor.',
            self::SUBSCRIPTION_CREATE => 'A subscription has been created.',
            self::SUBSCRIPTION_DISABLE => 'A subscription on your account has been disabled.',
            self::SUBSCRIPTION_EXPIRING_CARDS => 'Contains information on all subscriptions with cards that are expiring.',
            self::SUBSCRIPTION_NOT_RENEW => 'A subscription on your account\'s status has changed to non-renewing.',
            self::TRANSFER_FAILED => 'A transfer you attempted has failed.',
            self::TRANSFER_SUCCESS => 'A successful transfer has been completed.',
            self::TRANSFER_REVERSED => 'A transfer you attempted has been reversed',
        };
    }

    /**
     * Get all event values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
