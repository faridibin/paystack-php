<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts;

use Faridibin\Paystack\Contracts\Services\{
    IdentityVerificationInterface,
    PaymentsInterface,
    TerminalInterface,
    TransfersInterface
};

interface PaystackInterface
{
    /**
     * Get the payment service
     */
    public function payments(): PaymentsInterface;

    /**
     * Get the terminal service
     */
    public function terminal(): TerminalInterface;

    /**
     * Get the transfers service
     */
    public function transfers(): TransfersInterface;

    /**
     * Get the identity verification service
     */
    public function identity(): IdentityVerificationInterface;
}
