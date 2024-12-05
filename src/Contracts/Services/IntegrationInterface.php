<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DTOs\Response;

interface IntegrationInterface extends ServiceInterface
{
    /**
     * Fetch Timeout
     * Fetch the payment session timeout on your integration
     *
     * @return Response
     */
    public function fetchTimeout(): Response;

    /**
     * Update Timeout
     * Update the payment session timeout on your integration
     *
     * @param int $timeout
     * @return Response
     */
    public function updateTimeout(int $timeout): Response;
}
