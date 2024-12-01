<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DTOs\Response;

interface ChargeInterface
{
    /**
     * Create a charge.
     *
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createCharge(array $data = []): Response;
}