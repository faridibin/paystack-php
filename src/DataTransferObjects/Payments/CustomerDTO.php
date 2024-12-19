<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Collection;
use Faridibin\Paystack\DataTransferObjects\Recurring\SubscriptionDTO;
use Faridibin\Paystack\Enums\RiskAction;

class CustomerDTO implements DataTransferObject
{
    /**
     * The Customer creation date
     *
     * @var DateTime $createdAt
     */
    public readonly ?DateTime $createdAt;

    /**
     * The Customer updated date
     *
     * @var DateTime $updatedAt
     */
    public readonly ?DateTime $updatedAt;

    /**
     * The metadata of the customer
     *
     * @var array $metadata
     */
    public readonly array $metadata;

    /**
     * The risk action of the customer
     *
     * @var RiskAction $risk_action
     */
    public readonly RiskAction $risk_action;

    /**
     * The authorizations of the customer
     *
     * @var Collection $authorizations
     */
    public readonly Collection $authorizations;

    /**
     * The subscriptions of the customer
     *
     * @var Collection $subscriptions
     */
    public readonly Collection $subscriptions;

    /**
     * The Customer DTO constructor.
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $customer_code
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly string|int|null $integration = null,
        public readonly ?string $first_name = null,
        public readonly ?string $last_name = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $international_format_phone = null,
        public readonly ?string $customer_code = null,
        public readonly ?string $domain = null,
        public readonly ?int $total_transactions = null,
        public readonly ?bool $identified = null,
        array|string|null $metadata = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $updated_at = null,
        RiskAction|string|null $risk_action = null,
        mixed $authorizations = null,
        mixed $subscriptions = null,
        mixed $transactions = null, //TODO: Implement TransactionDTO
        mixed $total_transaction_value = null,
        mixed $dedicated_account = null,
        mixed $dedicated_accounts = null,
        mixed $identifications = null
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

        if ($metadata) {
            if (is_string($metadata)) {
                $decoded = json_decode($metadata, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    $this->metadata = $decoded;
                }
            } else {
                $this->metadata = $metadata;
            }
        }

        if ($risk_action && !($risk_action instanceof RiskAction)) {
            $this->risk_action = RiskAction::from($risk_action);
        }

        if ($subscriptions) {
            $this->subscriptions = is_array($subscriptions) ? new Collection($subscriptions, SubscriptionDTO::class) : $subscriptions;
        }

        if ($authorizations) {
            $this->authorizations = is_array($authorizations) ? new Collection($authorizations, AuthorizationDTO::class) : $authorizations;
        }
    }

    /**
     * Convert the customer to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'integration' => $this->integration,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'international_format_phone' => $this->international_format_phone,
            'customer_code' => $this->customer_code,
            'domain' => $this->domain,
            'total_transactions' => $this->total_transactions,
            'identified' => $this->identified,
            'metadata' => $this->metadata,
            'createdAt' => $this->createdAt?->format(DateTime::ATOM),
            'updatedAt' => $this->updatedAt?->format(DateTime::ATOM),
            'risk_action' => $this->risk_action?->value,
            'authorizations' => $this->authorizations?->toArray(),
            'subscriptions' => $this->subscriptions?->toArray(),
            // TODO: Implement remaining properties
        ];
    }
}
