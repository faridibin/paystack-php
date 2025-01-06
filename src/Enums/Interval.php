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
     * Get the time unit for the interval
     *
     * @return string
     */
    public function getTimeUnit(): string
    {
        return match ($this) {
            self::HOURLY => 'hour',
            self::DAILY => 'day',
            self::WEEKLY => 'week',
            self::MONTHLY => 'month',
            self::QUARTERLY => 'quarter',
            self::BI_ANNUALLY, self::ANNUALLY => 'year',
        };
    }

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
