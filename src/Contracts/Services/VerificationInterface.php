<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DTOs\Response;

interface VerificationInterface
{
    /**
     * Resolve an account number
     *
     * @param string $accountNumber
     * @param string $bankCode
     * @return Response
     */
    public function resolveAccount(string $accountNumber, string $bankCode): Response;

    /**
     * Validate an account
     *
     * @param array $account
     * @return Response
     */
    public function validateAccount(array $account): Response;

    /**
     * Resolve a card bin
     *
     * @param string $bin
     * @return Response
     */
    public function resolveCardBin(string $bin): Response;
}
