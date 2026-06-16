<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Transfers;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\RecipientType;
use Faridibin\Paystack\Traits\HasMetadata;
use Faridibin\Paystack\Traits\MapToArray;

/**
 * Data Transfer Object representing a Paystack transfer recipient.
 */
class RecipientDTO implements DataTransferObject
{
    use HasMetadata, MapToArray;

    /**
     * The createdAt property
     */
    public readonly DateTime $createdAt;

    /**
     * The updatedAt property
     */
    public readonly DateTime $updatedAt;

    /**
     * The type of the recipient
     *
     * @var RecipientType $type
     */
    public readonly RecipientType $type;

    /**
     * The currency of the recipient
     *
     * @var Currency $currency
     */
    public readonly Currency $currency;

    /**
     * The Recipient DTO constructor.
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $integration = null,
        public readonly ?string $domain = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $recipient_code = null,
        public readonly ?bool $active = null,
        public readonly ?string $recipient_account = null,
        public readonly ?string $institution_code = null,
        public readonly ?string $email = null,
        public readonly ?bool $isDeleted = null,
        public readonly array $details = [],
        RecipientType|string|null $type = null,
        Currency|string|null $currency = null,
        array|string|null $metadata = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updated_at = null,
        ...$args
    ) {
        if ($type !== null) {
            $this->type = $type instanceof RecipientType ? $type : RecipientType::from($type);
        }

        if ($currency !== null) {
            $this->currency = $currency instanceof Currency ? $currency : Currency::from($currency);
        }

        $createdAt ??= $created_at;
        $updatedAt ??= $updated_at;

        if ($createdAt) {
            $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
        }

        if ($updatedAt) {
            $this->updatedAt = $updatedAt instanceof DateTime ? $updatedAt : new DateTime($updatedAt);
        }

        $this->resolveMetadata($metadata);
    }
}
