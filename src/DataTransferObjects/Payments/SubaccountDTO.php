<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Traits\MapToArray;

class SubaccountDTO implements DataTransferObject
{
    use MapToArray;

    /**
     * The active status of the subaccount
     *
     * @var bool $active
     */
    public readonly bool $active;

    /**
     * The currency of the subaccount
     *
     * @var Currency $currency
     */
    public readonly Currency $currency;

    /**
     * The Subaccount creation date
     *
     * @var DateTime $createdAt
     */
    public readonly ?DateTime $createdAt;

    /**
     * The Subaccount updated date
     *
     * @var DateTime $updatedAt
     */
    public readonly ?DateTime $updatedAt;

    /**
     * The Subaccount DTO constructor.
     *
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $subaccount_code = null,
        // public readonly ?string $business_name = null,
        // public readonly ?string $description = null,
        // public readonly ?string $primary_contact_name = null,
        // public readonly ?string $primary_contact_email = null,
        // public readonly ?string $primary_contact_phone = null,
        // public readonly ?array $metadata = null,
        // public readonly ?int $percentage_charge = null,
        // public readonly ?string $settlement_bank = null,
        // public readonly ?int $bank_id = null,
        // public readonly ?string $account_number = null,
        // 
        // 
        // public readonly ?bool $is_verified = null,
        // public readonly ?int $integration = null,
        // public readonly ?int $managed_by_integration = null,
        // public readonly ?string $domain = null,
        // public readonly ?string $settlement_schedule = null,
        public readonly ?bool $migrate = null,
        public readonly ?string $account_name = null,
        public readonly ?string $product = null,
        bool|int|null $active = null,
        Currency|string|null $currency = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updated_at = null,

        ...$args // TODO: Remove this line
    ) {
        //

        // Handle active flag which can be bool or int
        $this->active = is_int($active) ? (bool)$active : $active;

        if ($currency && !($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        $createdAt = $createdAt ?? $created_at;
        $updatedAt = $updatedAt ?? $updated_at;

        if ($createdAt) {
            $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
        }

        if ($updatedAt) {
            $this->updatedAt = $updatedAt instanceof DateTime ? $updatedAt : new DateTime($updatedAt);
        }

        if (!empty($args)) {
            dump([
                'subaccount_args' => $args, // TODO: Remove this line
            ]);
        }
    }
}
