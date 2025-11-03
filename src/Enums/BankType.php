<?php

namespace Faridibin\Paystack\Enums;

enum BankType: string
{
    case GHIPSS = 'ghipss';
    case MOBILE_MONEY = 'mobile_money';
    case KEPSS = 'kepss';
    case MOBILE_MONEY_BUSINESS = 'mobile_money_business';
    case NUBAN = 'nuban';
    case BASA = 'basa';

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
            self::MOBILE_MONEY_BUSINESS => 'Mobile Money Business is an account tied to a mobile number for business purposes',
            self::NUBAN => 'Nigerian Uniform Bank Account Number',
            self::BASA => 'Banking Association South Africa',
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
            self::MOBILE_MONEY_BUSINESS => ['GHS', 'KES'],
            self::NUBAN => ['NGN'],
            self::BASA => ['ZAR'],
        };
    }
}
