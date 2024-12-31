<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Traits\HasMetadata;
use Faridibin\Paystack\Traits\MapToArray;

class SubaccountDTO implements DataTransferObject
{
    use HasMetadata, MapToArray;

    /**
     * The active status of the subaccount
     *
     * @var bool $active
     */
    public readonly bool|null $active;

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
     * @param int|null $id
     * @param int|null $integration
     * @param int|null $managed_by_integration
     * @param int|null $bank
     * @param int|null $bank_id
     * @param string|null $subaccount_code
     * @param string|null $business_name
     * @param string|null $description
     * @param string|null $primary_contact_name
     * @param string|null $primary_contact_email
     * @param string|null $primary_contact_phone
     * @param string|null $domain
     * @param int|null $percentage_charge
     * @param string|null $settlement_bank
     * @param string|null $account_number
     * @param string|null $settlement_schedule
     * @param string|null $account_name
     * @param string|null $product
     * @param bool|null $migrate
     * @param bool|null $is_verified
     * @param bool|int|null $active
     * @param mixed $metadata
     * @param Currency|string|null $currency
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $updatedAt
     * @param DateTime|string|null $created_at
     * @param DateTime|string|null $updated_at
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $integration = null,
        public readonly ?int $managed_by_integration = null,
        public readonly ?int $bank = null,
        public readonly ?int $bank_id = null,
        public readonly ?string $subaccount_code = null,
        public readonly ?string $business_name = null,
        public readonly ?string $description = null,
        public readonly ?string $primary_contact_name = null,
        public readonly ?string $primary_contact_email = null,
        public readonly ?string $primary_contact_phone = null,
        public readonly ?string $domain = null,
        public readonly ?int $percentage_charge = null,
        public readonly ?string $settlement_bank = null,
        public readonly ?string $account_number = null,
        public readonly ?string $settlement_schedule = null,
        public readonly ?string $account_name = null,
        public readonly ?string $product = null,
        public readonly ?bool $migrate = null,
        public readonly ?bool $is_verified = null,
        bool|int|null $active = null,
        mixed $metadata = null,
        Currency|string|null $currency = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updated_at = null,

        ...$args // TODO: Remove this line
    ) {
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

        $this->resolveMetadata($metadata);

        if (!empty($args)) {
            dump([
                'subaccount_args' => $args, // TODO: Remove this line
            ]);
        }
    }
}
