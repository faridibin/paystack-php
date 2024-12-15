<?php

namespace Faridibin\Paystack\Enums;

enum Interval: string
{
    case HOURLY = 'hourly';
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case BI_ANNUALLY = 'biannually';
    case ANNUALLY = 'annually';
}
