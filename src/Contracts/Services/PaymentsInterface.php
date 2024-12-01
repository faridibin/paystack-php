<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DTOs\Response;

interface PaymentsInterface
{
    /**
     * Initialize a payment transaction.
     *
     * @param array $data
     * @return Response
     */
    public function initializeTransaction(array $data = []): Response;

    /**
     * Verify a payment transaction.
     *
     * @param string $reference
     * @return Response
     */
    public function verifyTransaction(string $reference): Response;

    /**
     * Create a charge.
     *
     * @param array $data
     * @return Response
     */
    public function createCharge(array $data = []): Response;
}
