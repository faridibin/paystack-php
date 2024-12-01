<?php

declare(strict_types=1);

namespace Faridibin\Paystack;

use Faridibin\Paystack\Contracts\{
    PaystackInterface,
    ClientInterface,
    Services\VerificationInterface,
    Services\MiscellaneousInterface,
};
use Faridibin\Paystack\Exceptions\PaystackException;
use Faridibin\Paystack\Services\{
    Verification,
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
     * Service mappings.
     *
     * @var array<string, array>
     */
    private array $serviceMap = [
        'verification' => [Verification::class, VerificationInterface::class],
        'misc' => [Miscellaneous::class, MiscellaneousInterface::class],
    ];

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
     * Dynamically handle service calls.
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws \RuntimeException
     */
    public function __call(string $name, array $arguments)
    {
        if (isset($this->serviceMap[$name])) {
            [$serviceClass, $interfaceClass] = $this->serviceMap[$name];

            return $this->resolveService($serviceClass, $interfaceClass);
        }

        throw new PaystackException("Service [$name] not found.");
    }

    /**
     * Resolve a service instance.
     *
     * @param string $class
     * @param string $interface
     * @return mixed
     */
    private function resolveService(string $class, string $interface)
    {
        if (!isset($this->services[$class])) {
            $this->services[$class] = new $class($this->client);
        }

        return $this->services[$class];
    }

    /**
     * Register a new service.
     *
     * @param string $name
     * @param string $serviceClass
     * @param string $interfaceClass
     * @return self
     */
    public function registerService(string $name, string $serviceClass, string $interfaceClass): self
    {
        $this->serviceMap[$name] = [$serviceClass, $interfaceClass];

        return $this;
    }
}
