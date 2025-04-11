<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments\Transactions;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Miscellaneous\Logs\LogDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\AuthorizationDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\CustomerDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\SubaccountDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\Enums\Channels;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Status;
use Faridibin\Paystack\Traits\HasMetadata;
use Faridibin\Paystack\Traits\MapToArray;

class TransactionDTO implements DataTransferObject
{
    use HasMetadata, MapToArray;

    /**
     * The currency of the transaction
     *
     * @var Currency $currency
     */
    public readonly Currency $currency;

    /**
     * The status of the transaction
     *
     * @var Status $status
     */
    public readonly Status $status;

    /**
     * The channel of the transaction
     *
     * @var Channels $channel
     */
    public readonly Channels $channel;

    /**
     * The Transaction creation date
     *
     * @var DateTime $createdAt
     */
    public readonly ?DateTime $createdAt;

    /**
     * The Transaction updated date
     *
     * @var DateTime $updatedAt
     */
    public readonly ?DateTime $updatedAt;

    /**
     * The Transaction paid date
     *
     * @var DateTime $paidAt
     */
    public readonly ?DateTime $paidAt;

    /**
     * The Transaction transaction date
     *
     * @var DateTime $transactionDate
     */
    public readonly ?DateTime $transactionDate;

    /**
     * The authorization of the transaction
     *
     * @var AuthorizationDTO|string|int|null $authorization
     */
    public readonly AuthorizationDTO|string|int|null $authorization;

    /**
     * The customer of the transaction
     *
     * @var CustomerDTO|string|int|null $customer
     */
    public readonly CustomerDTO|string|int|null $customer;

    /**
     * The plan of the transaction
     *
     * @var PlanDTO|string|null $plan
     */
    public readonly PlanDTO|string|null $plan;

    /**
     * The plan object of the transaction
     *
     * @var PlanDTO|string|null $plan_object
     */
    public readonly PlanDTO|string|null $plan_object;

    /**
     * The subaccount of the transaction
     *
     * @var SubaccountDTO|string|int|null $subaccount
     */
    public readonly SubaccountDTO|string|null $subaccount;

    /**
     * The log of the transaction
     *
     * @var LogDTO|null $log
     */
    public readonly LogDTO|null $log;

    /**
     * The Transaction DTO constructor.
     *
     * @param int|null $id
     * @param string|null $domain
     * @param string|null $reference
     * @param string|null $receipt_number
     * @param int|null $order_id
     * @param int|null $amount
     * @param int|null $requested_amount
     * @param int|null $fees
     * @param array|null $fees_split
     * @param array|null $fees_breakdown
     * @param array|null $split
     * @param array|null $source
     * @param string|null $message
     * @param string|null $gateway_response
     * @param string|null $ip_address
     * @param string|null $helpdesk_link
     * @param array|null $connect
     * @param array|null $pos_transaction_data
     * @param mixed|null $metadata
     * @param Status|string|null $status
     * @param Channels|string|null $channel
     * @param Currency|string|null $currency
     * @param mixed|null $customer
     * @param mixed|null $authorization
     * @param mixed|null $plan
     * @param mixed|null $plan_object
     * @param mixed|null $subaccount
     * @param mixed|null $log
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $updatedAt
     * @param DateTime|string|null $created_at
     * @param DateTime|string|null $updated_at
     * @param DateTime|string|null $paidAt
     * @param DateTime|string|null $paid_at
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $domain = null,
        public readonly ?string $reference = null,
        public readonly ?string $receipt_number = null,
        public readonly ?int $order_id = null,
        public readonly int|string|null $amount = null,
        public readonly ?int $requested_amount = null,
        public readonly ?int $fees = null,
        public readonly ?array $fees_split = null,
        public readonly ?array $fees_breakdown = null,
        public readonly ?array $split = null,
        public readonly ?array $source = null,
        public readonly ?string $message = null,
        public readonly ?string $gateway_response = null,
        public readonly ?string $ip_address = null,
        public readonly ?string $helpdesk_link = null,
        public readonly ?array $connect = null,
        public readonly ?array $pos_transaction_data = null,
        mixed $metadata = null,
        Status|string|null $status = null,
        Channels|string|null $channel = null,
        Currency|string|null $currency = null,
        mixed $customer = null,
        mixed $authorization = null,
        mixed $plan = null,
        mixed $plan_object = null,
        mixed $subaccount = null,
        mixed $log = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updated_at = null,
        DateTime|string|null $paidAt = null,
        DateTime|string|null $paid_at = null,
        DateTime|string|null $transactionDate = null,
        DateTime|string|null $transaction_date = null,


        ...$args // TODO: Remove this line
    ) {
        $this->customer = is_array($customer) ? new CustomerDTO(...$customer) : $customer;
        $this->authorization = is_array($authorization) ? new AuthorizationDTO(...$authorization) : $authorization;
        $this->plan = is_array($plan) ? new PlanDTO(...$plan) : $plan;
        $this->plan_object = is_array($plan_object) ? new PlanDTO(...$plan_object) : $plan_object;
        $this->subaccount = is_array($subaccount) ? new SubaccountDTO(...$subaccount) : $subaccount;
        $this->log = is_array($log) ? new LogDTO(...$log) : $log;


        if ($status && !($status instanceof Status)) {
            $this->status = Status::from($status);
        }

        if ($channel && !($channel instanceof Channels)) {
            $this->channel = Channels::from($channel);
        }

        if ($currency && !($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        $createdAt = $createdAt ?? $created_at;
        $updatedAt = $updatedAt ?? $updated_at;
        $paidAt = $paidAt ?? $paid_at;
        $transactionDate = $transactionDate ?? $transaction_date;

        if ($createdAt) {
            $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
        }

        if ($updatedAt) {
            $this->updatedAt = $updatedAt instanceof DateTime ? $updatedAt : new DateTime($updatedAt);
        }

        if ($paidAt) {
            $this->paidAt = $paidAt instanceof DateTime ? $paidAt : new DateTime($paidAt);
        }

        if ($transactionDate) {
            $this->transactionDate = $transactionDate instanceof DateTime ? $transactionDate : new DateTime($transactionDate);
        }

        $this->resolveMetadata($metadata);


        if (!empty($args)) {
            dump([
                'id' => $id,
                'transaction_args' => $args, // TODO: Remove this line
            ]);
        }
    }
}
