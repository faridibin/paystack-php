<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Channels;

class AuthorizationDTO implements DataTransferObject
{
    /**
     * The channel of the authorization
     *
     * @var Channels $channel
     */
    public readonly Channels $channel;

    /**
     * The Authorization DTO constructor.
     *
     * @param string|null $authorization_code
     * @param string $card_type
     * @param string $brand
     * @param string|null $bank
     * @param string|null $description
     * @param string|null $last4
     * @param string|null $country_name
     * @param Channels|string $channel
     */
    public function __construct(
        public readonly ?string $card_type = null,
        public readonly ?string $brand = null,
        public readonly ?string $authorization_code = null,
        public readonly ?string $bank = null,
        public readonly ?string $description = null,
        public readonly ?string $last4 = null,
        public readonly ?string $country_name = null,
        Channels|string $channel = null,
        ...$args
    ) {
        if (!($channel instanceof Channels)) {
            $this->channel = Channels::from($channel);
        }

        // "bin" => "408408"
        // "exp_month" => "12"
        // "exp_year" => "2030"
        // "country_code" => "GH"
        // "reusable" => 1
        // "signature" => "SIG_KihGZUCCIUNnuFzneEOs"
        // "account_name" => null

        dd($args);
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
