<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\PaymentPageType;
use Faridibin\Paystack\Traits\HasMetadata;
use Faridibin\Paystack\Traits\MapToArray;

class PageDTO implements DataTransferObject
{
    use HasMetadata, MapToArray;

    /**
     * The type of the page
     *
     * @var PaymentPageType $interval
     */
    public readonly PaymentPageType $type;

    /**
     * The currency of the page
     *
     * @var Currency $currency
     */
    public readonly Currency $currency;

    /**
     * The Page creation date
     *
     * @var DateTime $createdAt
     */
    public readonly ?DateTime $createdAt;

    /**
     * The page updated date
     *
     * @var DateTime $updatedAt
     */
    public readonly ?DateTime $updatedAt;

    /**
     * The Subscription DTO constructor.
     *
     * @param int|null $id
     * @param int|null $integration
     * @param string|null $domain
     * @param string|null $name
     * @param string|null $description
     * @param int|null $amount
     * @param string|null $slug
     * @param string|null $custom_fields
     * @param bool|null $collect_phone
     * @param int|null $plan
     * @param string|null $redirect_url
     * @param string|null $success_message
     * @param bool|null $active
     * @param bool|null $published
     * @param bool|null $migrate
     * @param string|null $notification_email
     * @param string|null $split_code
     * @param array|string|null $metadata
     * @param PaymentPageType|string|null $type
     * @param Currency|string|null $currency
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $updatedAt 
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $integration = null,
        public readonly ?string $domain = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?int $amount = null,
        public readonly ?string $slug = null,
        public readonly ?string $custom_fields = null,
        public readonly ?bool $collect_phone = null,
        public readonly ?int $plan = null,
        public readonly ?string $redirect_url = null,
        public readonly ?string $success_message = null,
        public readonly ?bool $active = null,
        public readonly ?bool $published = null,
        public readonly ?bool $migrate = null,
        public readonly ?string $notification_email = null,
        public readonly ?string $split_code = null,
        array|string|null $metadata = null,
        PaymentPageType|string|null $type = null,
        Currency|string|null $currency = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,

        ...$args // TODO: Remove this line
    ) {
        if ($type && !($type instanceof PaymentPageType)) {
            $this->type = PaymentPageType::from($type);
        }

        if ($currency && !($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        if ($createdAt) {
            $this->createdAt = $createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt);
        }

        if ($updatedAt) {
            $this->updatedAt = $updatedAt instanceof DateTime ? $updatedAt : new DateTime($updatedAt);
        }

        $this->resolveMetadata($metadata);

        if (!empty($args)) {
            dump([
                'page_args' => $args, // TODO: Remove this line
            ]);
        }
    }
}
