<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments\Transactions;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Payments\AuthorizationDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\CustomerDTO;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\Enums\Channels;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Status;
use Faridibin\Paystack\Traits\MapToArray;

class TransactionDTO implements DataTransferObject
{
    use MapToArray;

    // /**
    //  * The metadata of the customer
    //  *
    //  * @var array $metadata
    //  */
    // public readonly array $metadata;

    // /**
    //  * The currency of the transaction
    //  *
    //  * @var Currency $currency
    //  */
    // public readonly Currency $currency;

    // /**
    //  * The status of the transaction
    //  *
    //  * @var Status $status
    //  */
    // public readonly Status $status;

    // /**
    //  * The channel of the transaction
    //  *
    //  * @var Channels $channel
    //  */
    // public readonly Channels $channel;

    // /**
    //  * The Transaction creation date
    //  *
    //  * @var DateTime $createdAt
    //  */
    // public readonly ?DateTime $createdAt;

    // /**
    //  * The Transaction updated date
    //  *
    //  * @var DateTime $updatedAt
    //  */
    // public readonly ?DateTime $updatedAt;

    // /**
    //  * The Transaction paid date
    //  *
    //  * @var DateTime $paidAt
    //  */
    // public readonly ?DateTime $paidAt;

    // /**
    //  * The Transaction transaction date
    //  *
    //  * @var DateTime $transactionDate
    //  */
    // public readonly ?DateTime $transactionDate;

    // /**
    //  * The authorization of the transaction
    //  *
    //  * @var AuthorizationDTO|string|int|null $authorization
    //  */
    // public readonly AuthorizationDTO|string|int|null $authorization;

    // /**
    //  * The customer of the transaction
    //  *
    //  * @var CustomerDTO|string|int|null $customer
    //  */
    // public readonly CustomerDTO|string|int|null $customer;

    // /**
    //  * The plan of the transaction
    //  *
    //  * @var PlanDTO|string|null $plan
    //  */
    // public readonly PlanDTO|string|null $plan;

    /**
     * The Transaction DTO constructor.
     *
    //  * @param int|null $id
    //  * @param string|null $domain
    //  * @param string|null $reference
    //  * @param string|null $receipt_number
    //  * @param string|null $message
    //  * @param string|null $gateway_response
    //  * @param string|null $ip_address
    //  * @param string|null $helpdesk_link
    //  * @param int|null $amount
    //  * @param int|null $requested_amount
    //  * @param int|null $fees
    //  * @param array|string|null $metadata
    //  * @param Currency|string|null $currency
    //  * @param Status|string $status
    //  * @param Channels|string|null $channel
    //  * @param DateTime|string|null $createdAt
    //  * @param DateTime|string|null $created_at
    //  * @param DateTime|string|null $updatedAt
    //  * @param DateTime|string|null $updated_at
    //  * @param DateTime|string|null $paid_at
    //  * @param DateTime|string|null $paidAt
    //  * @param DateTime|string|null $transaction_date
    //  * @param DateTime|string|null $transactionDate
    //  * @param mixed $authorization
    //  * @param mixed $customer
    //  * @param mixed $plan
    //  * @param mixed $plan_object
     */
    public function __construct(
        // public readonly ?int $id = null,
        // public readonly ?string $domain = null,
        // public readonly ?string $reference = null,
        // public readonly ?string $receipt_number = null,
        // public readonly ?string $message = null,
        // public readonly ?string $gateway_response = null,
        // public readonly ?string $ip_address = null,
        // public readonly ?string $helpdesk_link = null,
        // public readonly ?int $amount = null,
        // public readonly ?int $requested_amount = null,
        // public readonly ?int $fees = null,
        // array|string|null $metadata = null,
        // Currency|string|null $currency = null,
        // Status|string $status = Status::UNKNOWN,
        // Channels|string $channel = null,
        // DateTime|string|null $createdAt = null,
        // DateTime|string|null $created_at = null,
        // DateTime|string|null $updatedAt = null,
        // DateTime|string|null $updated_at = null,
        // DateTime|string|null $paid_at = null,
        // DateTime|string|null $paidAt = null,
        // DateTime|string|null $transaction_date = null,
        // DateTime|string|null $transactionDate = null,
        // mixed $authorization = null,
        // mixed $customer = null,
        // mixed $plan = null,
        // mixed $plan_object = null,
        ...$args // TODO: Remove this line
    ) {
        // TODO: Implement remaining properties

        // if ($currency && !($currency instanceof Currency)) {
        //     $this->currency = Currency::from($currency);
        // }

        // if ($status && !($status instanceof Status)) {
        //     $this->status = Status::from($status);
        // }

        // if ($channel && !($channel instanceof Channels)) {
        //     $this->channel = Channels::from($channel);
        // }

        // if ($metadata) {
        //     if (is_string($metadata)) {
        //         $metadata = json_decode($metadata, true);

        //         if (json_last_error() === JSON_ERROR_NONE) {
        //             $this->metadata = $metadata;
        //         }
        //     } else {
        //         $this->metadata = $metadata;
        //     }
        // }

        // if ($createdAt || $created_at) {
        //     $createdAt = $createdAt ?? $created_at;

        //     $this->createdAt = !($createdAt instanceof DateTime) ? new DateTime($createdAt) : $createdAt;
        // }

        // if ($updatedAt || $updated_at) {
        //     $updatedAt = $updatedAt ?? $updated_at;

        //     $this->updatedAt = !($updatedAt instanceof DateTime) ? new DateTime($updatedAt) : $updatedAt;
        // }

        // if ($paidAt || $paid_at) {
        //     $paidAt = $paidAt ?? $paid_at;

        //     $this->paidAt = !($paidAt instanceof DateTime) ? new DateTime($paidAt) : $paidAt;
        // }

        // if ($transactionDate || $transaction_date) {
        //     $transactionDate = $transactionDate ?? $transaction_date;

        //     $this->transactionDate = !($transactionDate instanceof DateTime) ? new DateTime($transactionDate) : $transactionDate;
        // }

        // if ($authorization) {
        //     $this->authorization = is_array($authorization) ? new AuthorizationDTO(...$authorization) : $authorization;
        // }

        // if ($customer) {
        //     $this->customer = is_array($customer) ? new CustomerDTO(...$customer) : $customer;
        // }

        // if ($plan || $plan_object) {
        //     $plan = $plan_object ?? $plan;

        //     $this->plan = is_array($plan) ? new PlanDTO(...$plan) : $plan;
        // }

        dump([
            'transaction_args' => $args, // TODO: Remove this line
        ]);
    }
}
