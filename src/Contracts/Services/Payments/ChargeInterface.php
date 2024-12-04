<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DTOs\Response;

interface ChargeInterface extends PaymentsInterface
{
    /**
     * Create a charge.
     *
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createCharge(array $data = []): Response;
}
