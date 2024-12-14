<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Channels;
use Faridibin\Paystack\Enums\Month;

class AuthorizationDTO implements DataTransferObject
{
    /**
     * The channel of the authorization
     *
     * @var Channels $channel
     */
    public readonly Channels $channel;

    /**
     * The expiry month of the authorization
     *
     * @var Month $exp_month
     */
    public readonly Month $exp_month;

    /**
     * The reusable status of the authorization
     *
     * @var bool $reusable
     */
    public readonly ?bool $reusable;

    /**
     * The Authorization DTO constructor.
     *
     * @param string|null $account_name
     * @param string|null $signature
     * @param string|null $bin
     * @param string|null $card_type
     * @param string|null $brand
     * @param string|null $authorization_code
     * @param string|null $bank
     * @param string|null $description
     * @param string|null $last4
     * @param string|null $country_name
     * @param string|null $country_code
     * @param string|null $exp_year
     * @param bool|int|null $reusable
     * @param Month|string|int|null $exp_month
     * @param Channels|string|null $channel
     */
    public function __construct(
        public readonly ?string $account_name = null,
        public readonly ?string $signature = null,
        public readonly ?string $bin = null,
        public readonly ?string $card_type = null,
        public readonly ?string $brand = null,
        public readonly ?string $authorization_code = null,
        public readonly ?string $bank = null,
        public readonly ?string $description = null,
        public readonly ?string $last4 = null,
        public readonly ?string $country_name = null,
        public readonly ?string $country_code = null,
        public readonly ?string $exp_year = null,
        bool|int|null $reusable = null,
        Month|string|int|null $exp_month = null,
        Channels|string $channel = null
    ) {
        if ($channel && !($channel instanceof Channels)) {
            $this->channel = Channels::from($channel);
        }

        if ($exp_month && !($exp_month instanceof Month)) {
            $this->exp_month = Month::fromValue($exp_month);
        }

        if (!is_null($reusable)) {
            $this->reusable = (bool) $reusable;
        }
    }

    /**
     * Convert the authorization to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'authorization_code' => $this->authorization_code,
            'card_type' => $this->card_type,
            'brand' => $this->brand,
            'bank' => $this->bank,
            'description' => $this->description,
            'last4' => $this->last4,
            'country' => $this->country_name,
            'channel' => $this->channel?->value,
        ];
    }
}
