<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DTOs\Response;

interface IdentityVerificationInterface
{
    /**
     * Resolve an account number
     *
     * @param string $accountNumber
     * @param string $bankCode
     * @return Response
     */
    public function resolveAccountNumber(string $accountNumber, string $bankCode): Response;

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

    /**
     * Validate a customer's bank account
     *
     * @param array $data
     * @return Response
     */
    public function validateCustomerBankAccount(array $data): Response;
}
