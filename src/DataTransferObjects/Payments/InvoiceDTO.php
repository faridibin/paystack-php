<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\Enums\Channels;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Status;

class InvoiceDTO implements DataTransferObject
{
    /**
     * The status of the invoice
     *
     * @var Status $status
     */
    public readonly Status $status;

    /**
     * The currency of the plan
     *
     * @var Currency $currency
     */
    public readonly Currency $currency;

    /**
     * The channel of the invoice
     *
     * @var Channels $channel
     */
    public readonly Channels $channel;

    /**
     * The Invoice creation date
     *
     * @var DateTime $createdAt
     */
    public readonly ?DateTime $createdAt;

    /**
     * The Invoice updated date
     *
     * @var DateTime $updatedAt
     */
    public readonly ?DateTime $updatedAt;

    /**
     * The Invoice period start date
     *
     * @var DateTime $period_start
     */
    public readonly ?DateTime $period_start;

    /**
     * The Invoice period end date
     *
     * @var DateTime $period_end
     */
    public readonly ?DateTime $period_end;

    /**
     * The Invoice paid date
     *
     * @var DateTime $paidAt
     */
    public readonly ?DateTime $paidAt;

    /**
     * The Invoice next notification date
     *
     * @var DateTime $next_notification
     */
    public readonly ?DateTime $next_notification;

    /**
     * The paid status of the invoice
     *
     * @var bool $paid
     */
    public readonly ?bool $paid;

    /**
     * The customer of the invoice
     *
     * @var CustomerDTO|string|int|null $customer
     */
    public readonly CustomerDTO|string|int|null $customer;

    /**
     * The authorization of the invoice
     *
     * @var AuthorizationDTO|string|int|null $authorization
     */
    public readonly AuthorizationDTO|string|int|null $authorization;

    /**
     * The plan of the invoice
     *
     * @var PlanDTO|string|int|null $plan
     */
    public readonly PlanDTO|string|int|null $plan;

    /**
     * The Authorization DTO constructor.
     *
     * @param int|null $id
     * @param string|int|null $subscription
     * @param string|int|null $integration
     * @param string|int|null $transaction
     * @param string|null $invoice_code
     * @param string|null $receipt_number
     * @param string|null $reference
     * @param string|null $domain
     * @param string|null $message
     * @param string|null $gateway_response
     * @param string|null $ip_address
     * @param string|null $description
     * @param string|null $notification_flag
     * @param int|null $amount
     * @param int|null $fees
     * @param int|null $requested_amount
     * @param int|null $retries
     * @param bool|int|null $paid
     * @param Status|string $status
     * @param Currency|string|null $currency
     * @param Channels|string|null $channel
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $created_at
     * @param DateTime|string|null $updatedAt
     * @param DateTime|string|null $updated_at
     * @param DateTime|string|null $period_start
     * @param DateTime|string|null $period_end
     * @param DateTime|string|null $paid_at
     * @param DateTime|string|null $next_notification
     * @param mixed $plan
     * @param mixed $customer
     * @param mixed $authorization
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly string|int|null $subscription = null,
        public readonly string|int|null $integration = null,
        public readonly string|int|null $transaction = null,
        public readonly string|int|null $order_id = null,
        public readonly ?string $invoice_code = null,
        public readonly ?string $receipt_number = null,
        public readonly ?string $reference = null,
        public readonly ?string $domain = null,
        public readonly ?string $message = null,
        public readonly ?string $gateway_response = null,
        public readonly ?string $ip_address = null,
        public readonly ?string $description = null,
        public readonly ?string $notification_flag = null,
        public readonly ?int $amount = null,
        public readonly ?int $fees = null,
        public readonly ?int $requested_amount = null,
        public readonly ?int $retries = null,
        bool|int|null $paid = null,
        Status|string $status = Status::UNKNOWN,
        Currency|string|null $currency = null,
        Channels|string|null $channel = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $updated_at = null,
        DateTime|string|null $period_start = null,
        DateTime|string|null $period_end = null,
        DateTime|string|null $paid_at = null,
        DateTime|string|null $paidAt = null,
        DateTime|string|null $next_notification = null,
        mixed $plan = null,
        mixed $customer = null,
        mixed $authorization = null,
        mixed $subaccount = null, // TODO: Implement Subaccount DTO
        mixed $metadata = null, // TODO: Implement Meta DTO
        mixed $log = null, // TODO: Implement Log DTO
        mixed $fees_split = null,
        mixed $split = null,
        mixed $pos_transaction_data = null,
        mixed $source = null,
        mixed $fees_breakdown = null,
        mixed $connect = null,
    ) {
        // TODO: Implement remaining properties

        if ($createdAt || $created_at) {
            $createdAt = $createdAt ?? $created_at;

            $this->createdAt = !($createdAt instanceof DateTime) ? new DateTime($createdAt) : $createdAt;
        }

        if ($updatedAt || $updated_at) {
            $updatedAt = $updatedAt ?? $updated_at;

            $this->updatedAt = !($updatedAt instanceof DateTime) ? new DateTime($updatedAt) : $updatedAt;
        }

        if ($period_start) {
            $this->period_start = !($period_start instanceof DateTime) ? new DateTime($period_start) : $period_start;
        }

        if ($period_end) {
            $this->period_end = !($period_end instanceof DateTime) ? new DateTime($period_end) : $period_end;
        }

        if ($paidAt || $paid_at) {
            $paidAt = $paidAt ?? $paid_at;

            $this->paidAt = !($paidAt instanceof DateTime) ? new DateTime($paidAt) : $paidAt;
        }

        if ($next_notification) {
            $this->next_notification = !($next_notification instanceof DateTime) ? new DateTime($next_notification) : $next_notification;
        }

        if (!is_null($paid)) {
            $this->paid = (bool) $paid;
        }

        if ($status && !($status instanceof Status)) {
            $this->status = Status::from($status);
        }

        if ($currency && !($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        if ($channel && !($channel instanceof Channels)) {
            $this->channel = Channels::from($channel);
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
    }

    /**
     * Convert the authorization to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            // TODO: Implement toArray() method. Only include the properties that are not null

            // 'id' => $this->id,
            // 'subscription' => $this->subscription,
            // 'integration' => $this->integration,
            // 'transaction' => $this->transaction,
            // 'order_id' => $this->order_id,
            // 'invoice_code' => $this->invoice_code,
            // 'receipt_number' => $this->receipt_number,
            // 'reference' => $this->reference,
            // 'domain' => $this->domain,
            // 'message' => $this->message,
            // 'gateway_response' => $this->gateway_response,
            // 'ip_address' => $this->ip_address,
            // 'description' => $this->description,
            // 'notification_flag' => $this->notification_flag,
            // 'amount' => $this->amount,
            // 'fees' => $this->fees,
            // 'requested_amount' => $this->requested_amount,
            // 'retries' => $this->retries,
            // 'paid' => $this->paid,
            // 'status' => $this->status?->value,
            // 'currency' => $this->currency?->value,
            // 'channel' => $this->channel?->value,
            // 'createdAt' => $this->createdAt?->format(DateTime::ATOM),
            // 'updatedAt' => $this->updatedAt?->format(DateTime::ATOM),
            // 'period_start' => $this->period_start?->format(DateTime::ATOM),
            // 'period_end' => $this->period_end?->format(DateTime::ATOM),
            // 'paidAt' => $this->paidAt?->format(DateTime::ATOM),
            // 'next_notification' => $this->next_notification?->format(DateTime::ATOM),
            // 'plan' => $this->plan?->toArray(),
            // 'customer' => $this->customer?->toArray(),
            // 'authorization' => $this->authorization?->toArray(),
            // // TODO: Implement remaining properties
        ];
    }
}
