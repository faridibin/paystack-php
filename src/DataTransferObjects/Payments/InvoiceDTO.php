<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
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
     * The Authorization DTO constructor.
     *
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $reference = null,
        public readonly ?string $domain = null,

        public readonly ?int $amount = null,

        Status|string $status = Status::UNKNOWN,
        Currency|string|null $currency = null,
        ...$args
    ) {
        if ($status && !($status instanceof Status)) {
            $this->status = Status::from($status);
        }

        if ($currency && !($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        // TODO: Implement constructor logic
        dd($args);

        // "receipt_number" => null
        // "message" => null
        // "gateway_response" => "Successful"
        // "paid_at" => "2024-12-01T23:35:46.000Z"
        // "created_at" => "2024-12-01T23:35:43.000Z"
        // "channel" => "card"
        // "currency" => "GHS"
        // "ip_address" => "70.27.218.246"
        // "metadata" => array:3 [▶]
        // "log" => array:8 [▶]
        // "fees" => 1
        // "fees_split" => null
        // "authorization" => array:2 [▶]
        // "customer" => array:1 [▶]
        // "plan" => []
        // "subaccount" => []
        // "split" => []
        // "order_id" => null
        // "paidAt" => "2024-12-01T23:35:46.000Z"
        // "createdAt" => "2024-12-01T23:35:43.000Z"
        // "requested_amount" => 50
        // "pos_transaction_data" => null
        // "source" => null
        // "fees_breakdown" => null
        // "connect" => null
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
