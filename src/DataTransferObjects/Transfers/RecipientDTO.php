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
    public readonly ?DateTime $createdAt;

    /**
     * The updatedAt property
     */
    public readonly ?DateTime $updatedAt;

    /**
     * The type of the recipient
     *
     * @var RecipientType $type
     */
    public readonly ?RecipientType $type;

    /**
     * The currency of the recipient
     *
     * @var Currency $currency
     */
    public readonly ?Currency $currency;

    /**
     * Whether the recipient has been deleted.
     * Paystack returns this as `isDeleted` or `is_deleted` depending on the endpoint.
     *
     * @var bool|null $isDeleted
     */
    public readonly ?bool $isDeleted;

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
        bool|null $isDeleted = null,
        bool|null $is_deleted = null,
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
        $this->isDeleted = $isDeleted ?? $is_deleted;

        $this->type = $type instanceof RecipientType
            ? $type
            : (is_string($type) && $type !== '' ? RecipientType::from($type) : null);

        $this->currency = $currency instanceof Currency
            ? $currency
            : (is_string($currency) && $currency !== '' ? Currency::from($currency) : null);

        $createdAt ??= $created_at;
        $updatedAt ??= $updated_at;

        $this->createdAt = $createdAt ? ($createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt)) : null;
        $this->updatedAt = $updatedAt ? ($updatedAt instanceof DateTime ? $updatedAt : new DateTime($updatedAt)) : null;

        $this->resolveMetadata($metadata);
    }
}
