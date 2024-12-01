<?php

declare(strict_types=1);

namespace Faridibin\Paystack;

use Faridibin\Paystack\Contracts\{
    PaystackInterface,
    ClientInterface,
    Services\PaymentsInterface,
    Services\TerminalInterface,
    Services\TransfersInterface,
    Services\IdentityVerificationInterface,
};
use Faridibin\Paystack\Services\{
    Payments,
    Terminal,
    Transfers,
    IdentityVerification
};

class Paystack implements PaystackInterface
{
    /**
     * The HTTP client instance.
     *
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * The services container.
     *
     * @var array
     */
    private array $services = [];

    /**
     * Paystack constructor.
     *
     * @param string $secretKey
     * @param ClientInterface|null $client
     */
    public function __construct(string $secretKey, ?ClientInterface $client = null)
    {
        $this->client = $client ?? new Client($secretKey);
    }

    /**
     * Get the payment service
     */
    public function payments(): PaymentsInterface
    {
        return $this->services[Payments::class] ??= new Payments($this->client);
    }

    /**
     * Get the terminal service
     */
    public function terminal(): TerminalInterface
    {
        return $this->services[Terminal::class] ??= new Terminal($this->client);
    }

    /**
     * Get the transfers service
     */
    public function transfers(): TransfersInterface
    {
        return $this->services[Transfers::class] ??= new Transfers($this->client);
    }

    /**
     * Get the identity verification service
     */
    public function identity(): IdentityVerificationInterface
    {
        return $this->services[IdentityVerification::class] ??= new IdentityVerification($this->client);
    }
}
