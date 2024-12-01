<?php

namespace Faridibin\Paystack\Enums;

enum  PlanInterval: string
{
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case BI_ANNUALLY = 'biannually';
    case ANNUALLY = 'annually';
}
