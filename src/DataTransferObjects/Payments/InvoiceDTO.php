<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Miscellaneous\Logs\LogDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\Transactions\TransactionDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\SubscriptionDTO;
use Faridibin\Paystack\Enums\Channels;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Status;
use Faridibin\Paystack\Traits\HasMetadata;
use Faridibin\Paystack\Traits\MapToArray;

class InvoiceDTO implements DataTransferObject
{
    use HasMetadata, MapToArray;

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
     * The status of the invoice
     *
     * @var Status $status
     */
    public readonly Status $status;

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
     * The Invoice paid date
     *
     * @var DateTime $paidAt
     */
    public readonly ?DateTime $paidAt;

    /**
     * The Invoice period start date
     *
     * @var DateTime $periodStart
     */
    public readonly ?DateTime $periodStart;

    /**
     * The Invoice period end date
     *
     * @var DateTime $periodEnd
     */
    public readonly ?DateTime $periodEnd;

    /**
     * The Invoice next notification date
     *
     * @var DateTime $nextNotification
     */
    public readonly ?DateTime $nextNotification;

    /**
     * The paid status of the invoice
     *
     * @var bool $paid
     */
    public readonly ?bool $paid;

    /**
     * The authorization of the invoice
     *
     * @var AuthorizationDTO|string|int|null $authorization
     */
    public readonly AuthorizationDTO|string|int|null $authorization;

    /**
     * The customer of the invoice
     *
     * @var CustomerDTO|string|int|null $customer
     */
    public readonly CustomerDTO|string|int|null $customer;

    /**
     * The subscription of the invoice
     *
     * @var SubscriptionDTO|string|int|null $subscription
     */
    public readonly SubscriptionDTO|string|int|null $subscription;

    /**
     * The transaction of the invoice
     *
     * @var TransactionDTO|string|int|null $transaction
     */
    public readonly TransactionDTO|string|int|null $transaction;

    /**
     * The plan of the invoice
     *
     * @var PlanDTO|string|int|null $plan
     */
    public readonly PlanDTO|string|int|null $plan;

    /**
     * The subaccount of the invoice
     *
     * @var SubaccountDTO|string|int|null $subaccount
     */
    public readonly SubaccountDTO|string|int|null $subaccount;

    /**
     * The log of the invoice
     * 
     * @var LogDTO|null $log
     */
    public readonly LogDTO|null $log;

    /**
     * The Authorization DTO constructor.
     *
     * @param int|null $id
     * @param int|string|null $integration
     * @param string|null $invoice_code
     * @param string|null $domain
     * @param string|null $reference
     * @param string|null $description
     * @param string|null $receipt_number
     * @param int|null $amount
     * @param int|null $requested_amount
     * @param string|null $message
     * @param string|null $gateway_response
     * @param string|null $ip_address
     * @param int|null $fees
     * @param array|null $fees_split
     * @param array|null $split
     * @param string|null $order_id
     * @param array|null $pos_transaction_data
     * @param string|null $source
     * @param array|null $fees_breakdown
     * @param array|null $connect
     * @param string|null $notification_flag
     * @param int|null $retries
     * @param mixed|null $log
     * @param mixed|null $authorization
     * @param mixed|null $customer
     * @param mixed|null $subscription
     * @param mixed|null $transaction
     * @param mixed|null $plan
     * @param mixed|null $subaccount
     * @param mixed|null $metadata
     * @param bool|int|null $paid
     * @param Currency|string|null $currency
     * @param Channels|string|null $channel
     * @param Status|string|null $status
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $updatedAt
     * @param DateTime|string|null $created_at
     * @param DateTime|string|null $updated_at
     * @param DateTime|string|null $periodStart
     * @param DateTime|string|null $periodEnd
     * @param DateTime|string|null $period_start
     * @param DateTime|string|null $period_end
     * @param DateTime|string|null $paid_at
     * @param DateTime|string|null $paidAt
     * @param DateTime|string|null $nextNotification
     * @param DateTime|string|null $next_notification
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly string|int|null $integration = null,
        public readonly ?string $invoice_code = null,
        public readonly ?string $domain = null,
        public readonly ?string $reference = null,
        public readonly ?string $description = null,
        public readonly ?string $receipt_number = null,
        public readonly ?int $amount = null,
        public readonly ?int $requested_amount = null,
        public readonly ?string $message = null,
        public readonly ?string $gateway_response = null,
        public readonly ?string $ip_address = null,
        public readonly ?int $fees = null,
        public readonly ?array $fees_split = null,
        public readonly ?array $split = null,
        public readonly ?string $order_id = null,
        public readonly ?array $pos_transaction_data = null,
        public readonly ?string $source = null,
        public readonly ?array $fees_breakdown = null,
        public readonly ?array $connect = null,
        public readonly ?string $notification_flag = null,
        public readonly ?int $retries = null,
        mixed $log = null,
        mixed $authorization = null,
        mixed $customer = null,
        mixed $subscription = null,
        mixed $transaction = null,
        mixed $plan = null,
        mixed $subaccount = null,
        mixed $metadata = null,
        bool|int|null $paid = null,
        Currency|string|null $currency = null,
        Channels|string|null $channel = null,
        Status|string|null $status = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updated_at = null,
        DateTime|string|null $periodStart = null,
        DateTime|string|null $periodEnd = null,
        DateTime|string|null $period_start = null,
        DateTime|string|null $period_end = null,
        DateTime|string|null $paid_at = null,
        DateTime|string|null $paidAt = null,
        DateTime|string|null $nextNotification = null,
        DateTime|string|null $next_notification = null,

        ...$args // TODO: Remove this line
    ) {
        $this->authorization = is_array($authorization) ? new AuthorizationDTO(...$authorization) : $authorization;
        $this->customer = is_array($customer) ? new CustomerDTO(...$customer) : $customer;
        $this->subscription = is_array($subscription) ? new SubscriptionDTO(...$subscription) : $subscription;
        $this->transaction = is_array($transaction) ? new TransactionDTO(...$transaction) : $transaction;
        $this->plan = is_array($plan) ? new PlanDTO(...$plan) : $plan;
        $this->subaccount = is_array($subaccount) ? new SubaccountDTO(...$subaccount) : $subaccount;
        $this->log = is_array($log) ? new LogDTO(...$log) : $log;

        $this->paid = !is_null($paid) ? (bool) $paid : null;

        if ($currency && !($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        if ($channel && !($channel instanceof Channels)) {
            $this->channel = Channels::from($channel);
        }

        if ($status && !($status instanceof Status)) {
            $this->status = Status::from($status);
        }

        $createdAt = $createdAt ?? $created_at;
        $updatedAt = $updatedAt ?? $updated_at;
        $paidAt = $paidAt ?? $paid_at;
        $periodStart = $periodStart ?? $period_start;
        $periodEnd = $periodEnd ?? $period_end;
        $nextNotification = $nextNotification ?? $next_notification;

        if ($createdAt) {
            $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
        }

        if ($updatedAt) {
            $this->updatedAt = $updatedAt instanceof DateTime ? $updatedAt : new DateTime($updatedAt);
        }

        if ($paidAt) {
            $this->paidAt = $paidAt instanceof DateTime ? $paidAt : new DateTime($paidAt);
        }

        if ($periodStart) {
            $this->periodStart = $periodStart instanceof DateTime ? $periodStart : new DateTime($periodStart);
        }

        if ($periodEnd) {
            $this->periodEnd = $periodEnd instanceof DateTime ? $periodEnd : new DateTime($periodEnd);
        }

        if ($nextNotification) {
            $this->nextNotification = $next_notification instanceof DateTime ?  $nextNotification : new DateTime($nextNotification);
        }

        $this->resolveMetadata($metadata);

        if (!empty($args)) {
            dump([
                'code' => $invoice_code,
                'invoice_args' => $args, // TODO: Remove this line
            ]);
        }
    }
}
