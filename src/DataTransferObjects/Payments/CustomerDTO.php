<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Traits\{HasMetadata, MapToArray};
use Faridibin\Paystack\DataTransferObjects\{Collection, Recurring\SubscriptionDTO};

class CustomerDTO implements DataTransferObject
{
    use HasMetadata, MapToArray;

    /**
     * The authorizations property
     */
    public readonly Collection $authorizations;

    /**
     * The subscriptions property
     */
    public readonly Collection $subscriptions;

    /**
     * The createdAt property
     */
    public readonly DateTime $createdAt;

    /**
     * The updatedAt property
     */
    public readonly DateTime $updatedAt;

    /**
     * The Customer DTO constructor.
     * 
     * @param int $id
     * @param int $integration
     * @param string $domain
     * @param string $customer_code
     * @param string $email
     * @param mixed $first_name
     * @param mixed $last_name
     * @param mixed $phone
     * @param array $metadata
     * @param string $risk_action
     * @param array $transactions
     * @param array $authorizations
     * @param array $subscriptions
     * @param array $total_transaction_value
     * @param mixed $total_transactions
     * @param bool $identified
     * @param mixed $identifications
     * @param mixed $dedicated_account
     * @param array $dedicated_accounts
     * @param \DateTime|string $createdAt
     * @param \DateTime|string $updatedAt
     * @param \DateTime|string|null $created_at
     * @param \DateTime|string|null $updated_at
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $integration = null,
        public readonly ?string $domain = null,
        public readonly ?string $customer_code = null,
        public readonly ?string $email = null,
        public readonly ?string $first_name = null,
        public readonly ?string $last_name = null,
        public readonly ?string $phone = null,
        public readonly ?string $international_format_phone = null,
        public readonly ?string $risk_action = null,
        public readonly ?int $total_transactions = null,
        public readonly ?bool $identified = null,
        public readonly mixed $identifications = null,
        public readonly mixed $dedicated_account = null,
        public readonly array $total_transaction_value = [],
        public readonly array $transactions = [],
        public readonly array $dedicated_accounts = [],
        array $authorizations = [],
        array $subscriptions = [],
        array|string|null $metadata = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updated_at = null,

        ...$args // TODO: Remove this
    ) {
        $this->authorizations = new Collection($authorizations, AuthorizationDTO::class);
        $this->subscriptions = new Collection($subscriptions, SubscriptionDTO::class);

        $createdAt = $createdAt ?? $created_at;
        $updatedAt = $updatedAt ?? $updated_at;

        if ($createdAt) {
            $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
        }

        if ($updatedAt) {
            $this->updatedAt = $updatedAt instanceof DateTime ? $updatedAt : new DateTime($updatedAt);
        }

        $this->resolveMetadata($metadata);

        // dump([
        //     'customer_args' => $args, // TODO: Remove this
        // ]);
    }
}
