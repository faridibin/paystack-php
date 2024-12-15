<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

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
     * The Authorization DTO constructor.
     *
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly string|int|null $subscription = null,
        public readonly string|int|null $integration = null,
        public readonly string|int|null $transaction = null,
        public readonly ?string $invoice_code = null,
        public readonly ?string $receipt_number = null,
        public readonly ?string $reference = null,
        public readonly ?string $domain = null,
        public readonly ?string $message = null,
        public readonly ?string $gateway_response = null,
        public readonly ?string $ip_address = null,
        public readonly ?string $description = null,

        public readonly ?int $amount = null,
        public readonly ?int $fees = null,
        public readonly ?int $requested_amount = null,
        public readonly ?int $retries = null,
        public readonly ?bool $paid = null,

        Status|string $status = Status::UNKNOWN,
        Currency|string|null $currency = null,
        Channels|string|null $channel = null,

        mixed $plan = null,
        mixed $customer = null,
        mixed $authorization = null,
        ...$args
    ) {
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

        // TODO: Implement constructor logic
        dd($args, $this);

        //     "metadata" => array:3 [▶]
        //     "log" => array:8 [▶]
        //     "subaccount" => []
        //     "split" => []

        //     "fees" => 1
        //     "fees_split" => null

        //     "order_id" => null

        //     "pos_transaction_data" => null
        //     "source" => null
        //     "fees_breakdown" => null
        //     "connect" => null


        //     "paidAt" => "2024-12-01T23:35:46.000Z"
        //     "createdAt" => "2024-12-01T23:35:43.000Z"
        //    "paid_at" => "2024-12-01T23:35:46.000Z"
        //     "created_at" => "2024-12-01T23:35:43.000Z"



        // "subscription" => 713526
        // "integration" => 1333079
        // "invoice_code" => "INV_p5iry30ruyyq7up"
        // "transaction" => 4481723090

        // "paid" => true
        // "retries" => 0

        // "notification_flag" => null
        // "description" => null


        // "createdAt" => "2024-12-15T01:53:39.000Z"
        // "updatedAt" => "2024-12-15T01:53:39.000Z"
        // "period_start" => "2024-12-15T01:00:00.000Z"
        // "period_end" => "2024-12-16T01:52:59.000Z"
        // "paid_at" => "2024-12-15T01:53:39.000Z"
        // "next_notification" => "2024-12-16T01:52:59.000Z"



    }

    /**
     * Convert the authorization to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            //
        ];
    }
}
