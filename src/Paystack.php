<?php

declare(strict_types=1);

namespace Faridibin\Paystack;

use Faridibin\Paystack\Contracts\{PaystackInterface, Services\ServiceInterface};
use Faridibin\Paystack\Exceptions\PaystackException;

/**
 * The main Paystack SDK entry point.
 *
 * Provides access to all Paystack API services via dynamic method calls.
 * Services are lazily resolved and cached on first access.
 *
 * @see \Faridibin\Paystack\Contracts\PaystackInterface
 */
final class Paystack implements PaystackInterface
{
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
        'health' => [Health::class, Contracts\HealthInterface::class],
    ];

    /**
     * Paystack constructor.
     *
     * @param string $secretKey
     * @param Contracts\ClientInterface|null $client
     */
    public function __construct(?string $secretKey = null, private ?Contracts\ClientInterface $client = null)
    {
        if (is_null($secretKey)) {
            throw new PaystackException('Secret key is required.');
        }

        $this->client = $client ?? new Client($secretKey);
    }

    /**
     * Dynamically handle service calls.
     *
     * @param string $name
     * @param array $arguments
     * @return ServiceInterface
     * @throws \RuntimeException
     */
    public function __call(string $name, array $arguments): ServiceInterface
    {
        if (isset($this->serviceMap[$name])) {
            [$serviceClass, $interfaceClass] = $this->serviceMap[$name];

            return $this->resolveService($serviceClass, $interfaceClass, $arguments);
        }

        throw new PaystackException("Service [$name] not found.");
    }

    /**
     * Register a new service.
     *
     * @param string $name The service alias (e.g. 'transactions')
     * @param string $serviceClass The fully-qualified service class name
     * @param string $interfaceClass The fully-qualified interface class name
     * @return static
     */
    public function registerService(string $name, string $serviceClass, string $interfaceClass): static
    {
        $this->serviceMap[$name] = [$serviceClass, $interfaceClass];

        return $this;
    }

    /**
     * Register multiple services at once.
     *
     * @param array<string, array{0: string, 1: string}> $services Map of alias => [serviceClass, interfaceClass]
     * @return static
     */
    public function registerServices(array $services): static
    {
        foreach ($services as $name => [$serviceClass, $interfaceClass]) {
            $this->registerService($name, $serviceClass, $interfaceClass);
        }

        return $this;
    }

    /**
     * Resolve a service instance.
     *
     * @param string $class
     * @param string $interface
     * @param array $arguments
     * @return ServiceInterface
     */
    private function resolveService(string $class, string $interface, array $arguments): ServiceInterface
    {
        if (!isset($this->services[$class])) {
            $this->services[$class] = new $class(
                client: $this->client
            );
        }

        return $this->services[$class];
    }
}
