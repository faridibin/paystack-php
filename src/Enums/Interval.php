<?php

namespace Faridibin\Paystack\Enums;

use Carbon\Carbon;

enum Interval: string
{
    case HOURLY = 'hourly';
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case BI_ANNUALLY = 'biannually';
    case ANNUALLY = 'annually';

    /**
     * Calculate the next date based on the interval
     *
     * @param Carbon $date
     * @return Carbon
     */
    public function calculateNextDate(Carbon $date): Carbon
    {
        return match ($this) {
            self::HOURLY => $date->copy()->addHour(),
            self::DAILY => $date->copy()->addDay(),
            self::WEEKLY => $date->copy()->addWeek(),
            self::MONTHLY => $date->copy()->addMonth(),
            self::QUARTERLY => $date->copy()->addMonths(3),
            self::BI_ANNUALLY => $date->copy()->addMonths(6),
            self::ANNUALLY => $date->copy()->addYear(),
        };
    }
}
