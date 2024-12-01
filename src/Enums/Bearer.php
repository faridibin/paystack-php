<?php

namespace Faridibin\Paystack\Enums;

enum Bearer: string
{
    case ACCOUNT = 'account';
    case SUB_ACCOUNT = 'subaccount';
    case ALL_PROPORTIONAL = 'all-proportional';
    case ALL_ACCOUNTS = 'all-accounts';
}
