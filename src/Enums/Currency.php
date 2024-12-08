<?php

namespace Faridibin\Paystack\Enums;

enum Currency: string
{
    case NGN = 'NGN';
    case USD = 'USD';
    case GHS = 'GHS';
    case ZAR = 'ZAR';
    case KES = 'KES';

    /**
     * Get the base unit of the currency.
     *
     * @return string
     */
    public function getBaseUnit(): string
    {
        return match ($this) {
            self::NGN => 'Kobo',
            self::USD => 'Cent',
            self::GHS => 'Pesewa',
            self::ZAR => 'Cent',
            self::KES => 'Cent',
        };
    }

    /**
     * Get the description of the currency.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return match ($this) {
            self::NGN => 'Nigerian Naira',
            self::USD => 'United States Dollar',
            self::GHS => 'Ghanaian Cedi',
            self::ZAR => 'South African Rand',
            self::KES => 'Kenyan Shilling',
        };
    }
}
