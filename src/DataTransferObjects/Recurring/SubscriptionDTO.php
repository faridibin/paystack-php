<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Recurring;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Collection;
use Faridibin\Paystack\DataTransferObjects\Payments\AuthorizationDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\CustomerDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\InvoiceDTO;
use Faridibin\Paystack\Enums\Status;

class SubscriptionDTO implements DataTransferObject
{
    /**
     * The customer of the subscription
     *
     * @var CustomerDTO|string|int|null $customer
     */
    public readonly CustomerDTO|string|int|null $customer;

    /**
     * The authorization of the subscription
     *
     * @var AuthorizationDTO|string|int|null $authorization
     */
    public readonly AuthorizationDTO|string|int|null $authorization;

    /**
     * The plan of the subscription
     *
     * @var PlanDTO|string|int|null $plan
     */
    public readonly PlanDTO|string|int|null $plan;

    /**
     * The invoices of the subscription
     *
     * @var Collection $invoices
     */
    public readonly Collection $invoices;

    /**
     * The status of the subscription
     *
     * @var Status $status
     */
    public readonly Status $status;

    /**
     * The Subscription creation date
     *
     * @var DateTime $createdAt
     */
    public readonly ?DateTime $createdAt;

    /**
     * The Subscription updated date
     *
     * @var DateTime $updatedAt
     */
    public readonly ?DateTime $updatedAt;

    /**
     * The next payment date of the subscription
     *
     * @var DateTime $next_payment_date
     */
    public readonly ?DateTime $next_payment_date;

    /**
     * The start date of the subscription
     *
     * @var DateTime $start
     */
    public readonly ?DateTime $start;

    /**
     * The date the subscription was cancelled
     *
     * @var DateTime $cancelledAt
     */
    public readonly ?DateTime $cancelledAt;

    /**
     * The Subscription DTO constructor.
     *
     * @param int $integration
     * @param string|null $domain
     * @param string|null $email_token
     * @param string|null $subscription_code
     * @param string|null $open_invoice
     * @param string|null $split_code
     * @param int|null $quantity
     * @param int|null $amount
     * @param int|null $invoice_limit
     * @param int|null $payments_count
     * @param int|null $successful_payments
     * @param int|null $id
     * @param string|null $most_recent_invoice
     * @param string|null $easy_cron_id
     * @param string|null $cron_expression
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $updatedAt
     * @param DateTime|string|null $next_payment_date
     * @param DateTime|string|int|null $start
     * @param DateTime|string|null $cancelledAt
     * @param Status|string $status
     * @param mixed $plan
     * @param mixed $customer
     * @param mixed $authorization
     * @param mixed $invoices
     * @param mixed $invoices_history
     */
    public function __construct(
        public readonly ?int $integration = null,
        public readonly ?string $domain = null,
        public readonly ?string $email_token = null,
        public readonly ?string $subscription_code = null,
        public readonly ?string $open_invoice = null,
        public readonly ?string $split_code = null,
        public readonly ?int $quantity = null,
        public readonly ?int $amount = null,
        public readonly ?int $invoice_limit = null,
        public readonly ?int $payments_count = null,
        public readonly ?int $successful_payments = null,
        public readonly ?int $id = null,
        public readonly ?string $most_recent_invoice = null,
        public readonly ?string $easy_cron_id = null,
        public readonly ?string $cron_expression = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $next_payment_date = null,
        DateTime|string|int|null $start = null,
        DateTime|string|null $cancelledAt = null,
        Status|string $status = Status::ACTIVE,
        mixed $plan = null,
        mixed $customer = null,
        mixed $authorization = null,
        mixed $invoices = null,
        mixed $invoices_history = null,
    ) {
        if ($createdAt) {
            $this->createdAt = !($createdAt instanceof DateTime) ? new DateTime($createdAt) : $createdAt;
        }

        if ($updatedAt) {
            $this->updatedAt = !($updatedAt instanceof DateTime) ? new DateTime($updatedAt) : $updatedAt;
        }

        if ($next_payment_date) {
            $this->next_payment_date = !($next_payment_date instanceof DateTime) ? new DateTime($next_payment_date) : $next_payment_date;
        }

        if ($start) {
            if (is_int($start)) {
                $start = date('Y-m-d H:i:s', $start);
            }

            $this->start = !($start instanceof DateTime) ? new DateTime($start) : $start;
        }

        if ($cancelledAt) {
            $this->cancelledAt = !($cancelledAt instanceof DateTime) ? new DateTime($cancelledAt) : $cancelledAt;
        }

        if ($status && !($status instanceof Status)) {
            $this->status = Status::from($status);
        }

        if ($plan) {
            $this->plan = is_array($plan) ? new PlanDTO(...$plan) : $plan;
        }

        if ($customer) {
            $this->customer = is_array($customer) ? new CustomerDTO(...$customer) : $customer;
        }

        if ($authorization) {
            $this->authorization = is_array($authorization) ? new AuthorizationDTO(...$authorization) : $authorization;
        }

        if ($invoices) {
            $this->invoices = is_array($invoices) ? new Collection($invoices, InvoiceDTO::class) : $invoices;
        }

        if ($invoices_history) {
            // TODO: Implement invoices_history
            // $this->invoices_history = is_array($invoices_history) ? new InvoiceHistoryDTO(...$invoices_history) : $invoices_history;
        }
    }

    /**
     * Convert the subscription to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'integration' => $this->integration,
            'domain' => $this->domain,
            'email_token' => $this->email_token,
            'subscription_code' => $this->subscription_code,
            'open_invoice' => $this->open_invoice,
            'split_code' => $this->split_code,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'invoice_limit' => $this->invoice_limit,
            'payments_count' => $this->payments_count,
            'successful_payments' => $this->successful_payments,
            'id' => $this->id,
            'most_recent_invoice' => $this->most_recent_invoice,
            'easy_cron_id' => $this->easy_cron_id,
            'cron_expression' => $this->cron_expression,
            'createdAt' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'next_payment_date' => $this->next_payment_date?->format('Y-m-d H:i:s'),
            'start' => $this->start?->format('Y-m-d H:i:s'),
            'cancelledAt' => $this->cancelledAt?->format('Y-m-d H:i:s'),
            'status' => $this->status->value,
            'plan' => $this->plan instanceof DataTransferObject ? $this->plan->toArray() : $this->plan,
            'customer' => $this->customer instanceof DataTransferObject ? $this->customer->toArray() : $this->customer,
            'authorization' => $this->authorization instanceof DataTransferObject ? $this->authorization->toArray() : $this->authorization,
            'invoices' => $this->invoices instanceof DataTransferObject ? $this->invoices->toArray() : $this->invoices,
            // 'invoices_history' => $this->invoices_history instanceof DataTransferObject ? $this->invoices_history->toArray() : $this->invoices_history
        ];
    }
}
