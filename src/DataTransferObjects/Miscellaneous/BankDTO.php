<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Miscellaneous;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\RecipientType;
use Faridibin\Paystack\Traits\MapToArray;

class BankDTO implements DataTransferObject
{
    use MapToArray;

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
        $this->currency = $currency instanceof Currency ? $currency : Currency::from($currency);
        $this->type = $type instanceof RecipientType ? $type : RecipientType::from($type);

        $this->createdAt = $createdAt instanceof DateTime ? $createdAt : ($createdAt ? new DateTime($createdAt) : null);
        $this->updatedAt = $updatedAt instanceof DateTime ? $updatedAt : ($updatedAt ? new DateTime($updatedAt) : null);
    }
}
