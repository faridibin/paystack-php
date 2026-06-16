<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Represents the source of funds for a transfer.
 */
enum TransferSource: string
{
    case BALANCE = 'balance';
}
