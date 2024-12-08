<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Generic;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\RecipientType;

class BankDTO implements DataTransferObject
{
    /**
     * The currency of the bank
     *
     * @var Currency $currency
     */
    public readonly Currency $currency;

    /**
     * The type of recipient
     *
     * @var RecipientType $recipientType
     */
    public readonly RecipientType $type;

    /**
     * The createdAt property of the bank
     *
     * @var DateTime $createdAt
     */
    public readonly ?DateTime $createdAt;

    /**
     * The updatedAt property of the bank
     *
     * @var DateTime $updatedAt
     */
    public readonly ?DateTime $updatedAt;

    /**
     * The Bank DTO constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $slug
     * @param string $code
     * @param string $longcode
     * @param string|null $gateway
     * @param string $country
     * @param Currency|string $currency
     * @param RecipientType|string $type
     * @param bool $pay_with_bank
     * @param bool $supports_transfer
     * @param bool $active
     * @param bool $is_deleted
     * @param DateTime|string $createdAt
     * @param DateTime|string $updatedAt
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $slug,
        public readonly string $code,
        public readonly string $longcode,
        public readonly ?string $gateway,
        public readonly string $country,
        Currency|string $currency,
        RecipientType|string $type,
        public readonly bool $pay_with_bank,
        public readonly bool $supports_transfer,
        public readonly bool $active,
        public readonly bool $is_deleted,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
    ) {
        if (!($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        if (!($type instanceof RecipientType)) {
            $this->type = RecipientType::from($type);
        }

        $this->createdAt = ($createdAt && !($createdAt instanceof DateTime)) ? new DateTime($createdAt) : null;

        $this->updatedAt = ($updatedAt && !($updatedAt instanceof DateTime)) ? new DateTime($updatedAt) : null;
    }

    /**
     * Convert the bank to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            'longcode' => $this->longcode,
            'gateway' => $this->gateway,
            'country' => $this->country,
            'currency' => $this->currency->value,
            'type' => $this->type->value,
            'pay_with_bank' => $this->pay_with_bank,
            'supports_transfer' => $this->supports_transfer,
            'active' => $this->active,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
        ];
    }
}
