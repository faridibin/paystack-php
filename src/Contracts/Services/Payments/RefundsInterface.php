<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\Currency;

interface RefundsInterface extends PaymentsInterface
{
    /**
     * Create a refund.
     * Initiate a refund on your integration
     *
     * @param string $identifier
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createRefund(string $identifier, array $optional): Response;

    /**
     * List refunds.
     * List refunds available on your integration
     *
     * @param string $transactionId
     * @param Currency|string $currency
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listRefunds(string $transactionId, Currency|string $currency, array $optional = []): Response;

    /**
     * Fetch a refund.
     * Get details of a refund on your integration
     *
     * @param string $id
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchRefund(string $id): Response;
}
