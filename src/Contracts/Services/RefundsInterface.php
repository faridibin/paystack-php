<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DTOs\Response;

interface RefundsInterface
{
    /**
     * Create a refund.
     *
     * @param array $data
     * @return Response
     */
    public function createRefund(array $data): Response;

    /**
     * List refunds.
     *
     * @param string $currency
     * @param array $options
     * @return Response
     */
    public function listRefunds(string $currency, array $options = []): Response;

    /**
     * Fetch a refund.
     *
     * @param string $id
     * @return Response
     */
    public function fetchRefund(string $id): Response;
}
