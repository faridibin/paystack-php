<?php

namespace Faridibin\Paystack\Enums;

enum RecipientType: string
{
    case GHIPSS = 'ghipss';
    case MOBILE_MONEY = 'mobile_money';
    case KEPSS = 'kepss';
    case NUBAN = 'nuban';
    case BASA = 'basa';
    case AUTHORIZATION = 'authorization';

    /**
     * Get the description of the recipient type.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return match ($this) {
            self::GHIPSS => 'Ghana Interbank Payment and Settlement Systems',
            self::MOBILE_MONEY => 'Mobile Money or MoMo is an account tied to a mobile number',
            self::KEPSS => 'Kenya Electronic Payment and Settlement System',
            self::NUBAN => 'Nigerian Uniform Bank Account Number',
            self::BASA => 'Banking Association South Africa',
            self::AUTHORIZATION => 'Authorization code',
        };
    }

    /**
     * Get the currencies supported by the recipient type.
     *
     * @return array
     */
    public function getCurrencies(): array
    {
        return match ($this) {
            self::GHIPSS => ['GHS'],
            self::MOBILE_MONEY => ['GHS', 'KES'],
            self::KEPSS => ['KES'],
            self::NUBAN => ['NGN'],
            self::BASA => ['ZAR'],
            self::AUTHORIZATION => ['NGN', 'USD', 'GHS', 'ZAR', 'KES'],
        };
    }
}
