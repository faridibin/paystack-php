<?php

namespace Faridibin\Paystack\Enums;

enum RiskAction: string
{
    case ALLOW = 'allow';
    case DENY = 'deny';
    case DEFAULT = 'default';
}
