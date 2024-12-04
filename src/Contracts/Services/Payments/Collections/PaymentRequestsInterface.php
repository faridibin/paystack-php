<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments\Collections;

interface PaymentRequestsInterface
{
    /**
     * Create a payment request.
     * Create a payment request for a transaction on your integration
     *
     * @param string $customer Customer id or code
     * @param int $amount
     * @param array $optional
     * @return mixed
     */
    public function createPaymentRequest(string $customer, int $amount, array $optional): mixed;

    public function listPaymentRequests(string $customer, int $perPage = 50, int $page = 1, array $optional = []): mixed;
}
