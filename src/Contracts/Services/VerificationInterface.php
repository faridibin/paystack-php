<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DataTransferObjects\Response;

interface VerificationInterface extends ServiceInterface
{
    /**
     * Resolve an account number
     * Confirm an account belongs to the right customer
     *
     * @param string $accountNumber
     * @param string $bankCode
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function resolveAccount(string $accountNumber, string $bankCode): Response;

    /**
     * Validate an account
     * Confirm the authenticity of a customer's account number before sending money
     *
     * @param array $account
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function validateAccount(array $account): Response;

    /**
     * Resolve a card bin
     * Get more information about a customer's card
     *
     * @param string $bin
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function resolveCardBin(string $bin): Response;
}
