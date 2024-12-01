<?php

declare(strict_types=1);

namespace Faridibin\Paystack;

use Faridibin\Paystack\Contracts;
use Faridibin\Paystack\Exceptions\PaystackException;

class Paystack implements Contracts\PaystackInterface
{
    /**
     * The HTTP client instance.
     *
     * @var Contracts\ClientInterface
     */
    private Contracts\ClientInterface $client;

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
    private array $serviceMap = [];

    /**
     * Paystack constructor.
     *
     * @param string $secretKey
     * @param Contracts\ClientInterface|null $client
     */
    public function __construct(string $secretKey, ?Contracts\ClientInterface $client = null)
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

            return $this->resolveService($serviceClass, $interfaceClass, $arguments);
        }

        throw new PaystackException("Service [$name] not found.");
    }

    /**
     * Resolve a service instance.
     *
     * @param string $class
     * @param string $interface
     * @param array $arguments
     * @return mixed
     */
    private function resolveService(string $class, string $interface, array $arguments)
    {
        if (!isset($this->services[$class])) {
            $this->services[$class] = new $class($this->client, ...$arguments);
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
