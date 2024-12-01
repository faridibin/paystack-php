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
    Services\MiscellaneousInterface,
};
use Faridibin\Paystack\Services\{
    Payments,
    Terminal,
    Transfers,
    IdentityVerification,
    Miscellaneous
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
     * Get the miscellaneous service
     */
    public function misc(): MiscellaneousInterface
    {
        return $this->services[Miscellaneous::class] ??= new Miscellaneous($this->client);
    }
}
