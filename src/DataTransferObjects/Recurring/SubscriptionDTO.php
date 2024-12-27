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
use Faridibin\Paystack\Traits\MapToArray;

class SubscriptionDTO implements DataTransferObject
{
    use MapToArray;

    /**
     * The authorization of the subscription
     *
     * @var AuthorizationDTO|string|int|null $authorization
     */
    public readonly AuthorizationDTO|string|int|null $authorization;

    /**
     * The customer of the subscription
     *
     * @var CustomerDTO|string|int|null $customer
     */
    public readonly CustomerDTO|string|int|null $customer;

    /**
     * The most recent invoice of the subscription
     *
     * @var InvoiceDTO|string|int|null $most_recent_invoice
     */
    public readonly InvoiceDTO|string|int|null $most_recent_invoice;

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
    public readonly Collection|null $invoices;

    /**
     * The invoices history of the subscription
     *
     * @var Collection $invoices_history
     */
    public readonly Collection|null $invoices_history;

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
     * @param int|null $id
     * @param string|null $domain
     * @param int|null $quantity
     * @param int|null $amount
     * @param string|null $email_token
     * @param string|null $subscription_code
     * @param string|null $open_invoice
     * @param string|null $split_code
     * @param int|null $integration
     * @param int|null $successful_payments
     * @param int|null $invoice_limit
     * @param int|null $payments_count
     * @param string|null $cron_expression
     * @param array $authorization
     * @param array $customer
     * @param array $plan
     * @param mixed $most_recent_invoice
     * @param mixed $invoices
     * @param mixed $invoices_history
     * @param Status|string $status
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $updatedAt
     * @param DateTime|string|null $created_at
     * @param DateTime|string|null $updated_at
     * @param DateTime|string|null $next_payment_date
     * @param DateTime|string|int|null $start
     * @param DateTime|string|null $cancelledAt
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $domain = null,
        public readonly ?int $quantity = null,
        public readonly ?int $amount = null,
        public readonly ?string $email_token = null,
        public readonly ?string $subscription_code = null,
        public readonly ?string $open_invoice = null,
        public readonly ?string $split_code = null,
        public readonly ?int $integration = null,
        public readonly ?int $successful_payments = null,
        public readonly ?int $invoice_limit = null,
        public readonly ?int $payments_count = null,
        public readonly ?string $cron_expression = null,
        array $authorization = [],
        array $customer = [],
        array $plan = [],
        mixed $most_recent_invoice = null,
        mixed $invoices = null,
        mixed $invoices_history = null,
        Status|string $status = Status::UNKNOWN,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updated_at = null,
        DateTime|string|null $next_payment_date = null,
        DateTime|string|int|null $start = null,
        DateTime|string|null $cancelledAt = null,

        ...$args // TODO: Remove this line
    ) {
        $this->authorization = is_array($authorization) ? new AuthorizationDTO(...$authorization) : $authorization;
        $this->customer = is_array($customer) ? new CustomerDTO(...$customer) : $customer;
        $this->plan = is_array($plan) ? new PlanDTO(...$plan) : $plan;
        $this->most_recent_invoice = is_array($most_recent_invoice) ? new InvoiceDTO(...$most_recent_invoice) : $most_recent_invoice;
        $this->invoices = is_array($invoices) ? new Collection($invoices, InvoiceDTO::class) : $invoices;
        $this->invoices_history = is_array($invoices_history) ? new Collection($invoices_history, InvoiceDTO::class) : $invoices_history;

        $createdAt = $createdAt ?? $created_at;
        $updatedAt = $updatedAt ?? $updated_at;

        if ($createdAt) {
            $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
        }

        if ($updatedAt) {
            $this->updatedAt = $updatedAt instanceof DateTime ? $updatedAt : new DateTime($updatedAt);
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

        // dump([
        //     'code' => $subscription_code,
        //     'subscription_args' => $args, // TODO: Remove this line
        // ]);
    }
}
