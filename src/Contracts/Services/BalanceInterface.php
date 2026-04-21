<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Defines the contract for balance-related API operations.
 */
interface BalanceInterface extends ServiceInterface
{
    /**
     * Fetch balance details.
     *
     * @return Response
     */
    public function fetch(): Response;
}
