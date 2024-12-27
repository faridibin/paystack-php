<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Payments\Transactions\TransactionDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\SubscriptionDTO;
use Faridibin\Paystack\Enums\Channels;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Status;
use Faridibin\Paystack\Traits\MapToArray;

class InvoiceDTO implements DataTransferObject
{
    use MapToArray;

    /**
     * The currency of the plan
     *
     * @var Currency $currency
     */
    public readonly Currency $currency;

    /**
     * The status of the invoice
     *
     * @var Status $status
     */
    public readonly Status $status;

    // /**
    //  * The channel of the invoice
    //  *
    //  * @var Channels $channel
    //  */
    // public readonly Channels $channel;

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

    // /**
    //  * The plan of the invoice
    //  *
    //  * @var PlanDTO|string|int|null $plan
    //  */
    // public readonly PlanDTO|string|int|null $plan;

    /**
     * The Authorization DTO constructor.
     *
     */
    public function __construct(
        // public readonly ?int $id = null,
        // public readonly string|int|null $subscription = null,
        // public readonly string|int|null $integration = null,
        // public readonly string|int|null $transaction = null,
        // public readonly string|int|null $order_id = null,
        // public readonly ?string $invoice_code = null,
        // public readonly ?string $receipt_number = null,
        // public readonly ?string $reference = null,
        // public readonly ?string $domain = null,
        // public readonly ?string $message = null,
        // public readonly ?string $gateway_response = null,
        // public readonly ?string $ip_address = null,
        // public readonly ?string $description = null,
        // public readonly ?string $notification_flag = null,
        // public readonly ?int $amount = null,
        // public readonly ?int $fees = null,
        // public readonly ?int $requested_amount = null,
        // public readonly ?int $retries = null,
        // bool|int|null $paid = null,
        // Status|string $status = Status::UNKNOWN,
        // Currency|string|null $currency = null,
        // Channels|string|null $channel = null,
        // DateTime|string|null $createdAt = null,
        // DateTime|string|null $created_at = null,
        // DateTime|string|null $updatedAt = null,
        // DateTime|string|null $updated_at = null,
        // DateTime|string|null $period_start = null,
        // DateTime|string|null $period_end = null,
        // DateTime|string|null $paid_at = null,
        // DateTime|string|null $paidAt = null,
        // DateTime|string|null $next_notification = null,
        // mixed $plan = null,
        // mixed $customer = null,
        // mixed $authorization = null,
        // mixed $subaccount = null, // TODO: Implement Subaccount DTO
        // mixed $metadata = null, // TODO: Implement Meta DTO
        // mixed $log = null, // TODO: Implement Log DTO
        // mixed $fees_split = null,
        // mixed $split = null,
        // mixed $pos_transaction_data = null,
        // mixed $source = null,
        // mixed $fees_breakdown = null,
        // mixed $connect = null,



        public readonly ?int $id = null,
        public readonly string|int|null $integration = null,
        public readonly ?string $invoice_code = null,
        public readonly ?string $domain = null,
        public readonly ?string $reference = null,
        public readonly ?string $description = null,
        public readonly ?string $receipt_number = null,
        public readonly ?int $amount = null,
        // public readonly string $message,
        // public readonly string $gateway_response,
        // public readonly string $paid_at,
        // public readonly string $created_at,
        // public readonly string $channel,
        // public readonly string $ip_address,
        // public readonly array $metadata,
        // public readonly array $log,
        // public readonly int $fees,
        // public readonly ?array $fees_split,
        // public readonly array $authorization,
        // public readonly array $customer,
        // public readonly array $plan,
        // public readonly array $subaccount,
        // public readonly array $split,
        // public readonly ?string $order_id,
        // public readonly int $requested_amount,
        // public readonly ?array $pos_transaction_data = null,
        // public readonly ?string $source = null,
        // public readonly ?array $fees_breakdown = null,
        // public readonly ?array $connect = null,
        public readonly ?string $notification_flag = null,
        public readonly ?int $retries = null,

        mixed $authorization = null,
        mixed $customer = null,
        mixed $subscription = null,
        mixed $transaction = null,
        bool|int|null $paid = null,
        Currency|string|null $currency = null,
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
        // TODO: Implement remaining properties

        // if ($createdAt || $created_at) {
        //     $createdAt = $createdAt ?? $created_at;

        //     $this->createdAt = !($createdAt instanceof DateTime) ? new DateTime($createdAt) : $createdAt;
        // }

        // if ($updatedAt || $updated_at) {
        //     $updatedAt = $updatedAt ?? $updated_at;

        //     $this->updatedAt = !($updatedAt instanceof DateTime) ? new DateTime($updatedAt) : $updatedAt;
        // }

        // if ($period_start) {
        //     $this->period_start = !($period_start instanceof DateTime) ? new DateTime($period_start) : $period_start;
        // }

        // if ($period_end) {
        //     $this->period_end = !($period_end instanceof DateTime) ? new DateTime($period_end) : $period_end;
        // }

        // if ($paidAt || $paid_at) {
        //     $paidAt = $paidAt ?? $paid_at;

        //     $this->paidAt = !($paidAt instanceof DateTime) ? new DateTime($paidAt) : $paidAt;
        // }



        // if (!is_null($paid)) {
        //   
        // }

        $this->authorization = is_array($authorization) ? new AuthorizationDTO(...$authorization) : $authorization;
        $this->customer = is_array($customer) ? new CustomerDTO(...$customer) : $customer;
        $this->subscription = is_array($subscription) ? new SubscriptionDTO(...$subscription) : $subscription;
        $this->transaction = is_array($transaction) ? new TransactionDTO(...$transaction) : $transaction;

        $this->paid = !is_null($paid) ? (bool) $paid : null;

        if ($currency && !($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
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

        // if ($channel && !($channel instanceof Channels)) {
        //     $this->channel = Channels::from($channel);
        // }

        // if ($plan) {
        //     $this->plan = is_array($plan) ? new PlanDTO(...$plan) : $plan;
        // }

        // if ($customer) {
        //     $this->customer = is_array($customer) ? new CustomerDTO(...$customer) : $customer;
        // }

        // if ($authorization) {
        //     $this->authorization = is_array($authorization) ? new AuthorizationDTO(...$authorization) : $authorization;
        // }

        // dd(
        //     $args,
        //     $this
        // );


        dump([
            'code' => $invoice_code,
            'invoice_args' => $args, // TODO: Remove this line
        ]);
    }
}
