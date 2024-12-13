<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Recurring;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Payments\AuthorizationDTO;
use Faridibin\Paystack\DataTransferObjects\Payments\CustomerDTO;
use Faridibin\Paystack\Enums\Status;

class SubscriptionDTO implements DataTransferObject
{
    /**
     * The customer of the subscription
     *
     * @var CustomerDTO $customer
     */
    public readonly CustomerDTO $customer;

    /**
     * The authorization of the subscription
     *
     * @var AuthorizationDTO $authorization
     */
    public readonly AuthorizationDTO $authorization;

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
     * @param int $quantity
     * @param int $amount
     * @param int $successful_payments
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $next_payment_date
     * @param DateTime|string|null $start
     * @param DateTime|string|null $cancelledAt
     * @param Status|string $status
     * @param array $customer
     * @param array $authorization
     */
    public function __construct(
        public readonly int $integration,
        public readonly ?string $domain,
        public readonly ?string $email_token,
        public readonly ?string $subscription_code,
        public readonly ?string $open_invoice,
        public readonly ?string $split_code,
        public readonly int $quantity,
        public readonly int $amount,
        public readonly int $successful_payments,
        DateTime|string|null $createdAt,
        DateTime|string|null $next_payment_date,
        DateTime|string|null $start,
        DateTime|string|null $cancelledAt,
        Status|string $status,
        array $customer = [],
        array $authorization = [],
    ) {
        if ($createdAt) {
            $this->createdAt = !($createdAt instanceof DateTime) ? new DateTime($createdAt) : $createdAt;
        }

        if ($next_payment_date) {
            $this->next_payment_date = !($next_payment_date instanceof DateTime) ? new DateTime($next_payment_date) : $next_payment_date;
        }

        if ($start) {
            $this->start = !($start instanceof DateTime) ? new DateTime($start) : $start;
        }

        if ($cancelledAt) {
            $this->cancelledAt = !($cancelledAt instanceof DateTime) ? new DateTime($cancelledAt) : $cancelledAt;
        }

        if (!($status instanceof Status)) {
            $this->status = Status::from($status);
        }

        $this->customer = new CustomerDTO(...$customer);
        $this->authorization = new AuthorizationDTO(...$authorization);
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
            'successful_payments' => $this->successful_payments,
            'createdAt' => $this->createdAt,
            'next_payment_date' => $this->next_payment_date,
            'start' => $this->start,
            'cancelledAt' => $this->cancelledAt,
            'status' => $this->status,
            'customer' => $this->customer,
            'authorization' => $this->authorization,
        ];
    }
}
