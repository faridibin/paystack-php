<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\Channels;
use Faridibin\Paystack\Enums\Month;
use Faridibin\Paystack\Traits\MapToArray;

class AuthorizationDTO implements DataTransferObject
{
    use MapToArray;

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
     * @param string $authorization_code
     * @param string $bin
     * @param string $last4
     * @param string $exp_year
     * @param string $card_type
     * @param string $bank
     * @param string $country_code
     * @param string $brand
     * @param string $signature
     * @param string|null $account_name
     * @param bool|int|null $reusable
     * @param Month|string|int|null $exp_month
     * @param Channels|string|null $channel
     */
    public function __construct(
        public readonly ?string $authorization_code = null,
        public readonly ?string $bin = null,
        public readonly ?string $last4 = null,
        public readonly ?string $exp_year = null,
        public readonly ?string $card_type = null,
        public readonly ?string $bank = null,
        public readonly ?string $country_code = null,
        public readonly ?string $country_name = null,
        public readonly ?string $brand = null,
        public readonly ?string $signature = null,
        public readonly ?string $account_name = null,
        public readonly ?string $description = null,
        public readonly ?string $receiver_bank = null,
        public readonly ?string $receiver_bank_account_number = null,
        bool|int|null $reusable = null,
        Month|string|int|null $exp_month = null,
        Channels|string|null $channel = null,
        ...$args // TODO: Remove this line  
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

        // dump([
        //     'authorization_args' => $args, // TODO: Remove this line
        // ]);
    }
}
