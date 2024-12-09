<?php

declare(strict_types=1);

namespace Faridibin\Paystack;

use Faridibin\Paystack\Contracts\{HealthInterface, PaystackInterface, Services\ServiceInterface};
use Faridibin\Paystack\Exceptions\PaystackException;

class Paystack implements PaystackInterface
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
    private array $serviceMap = [];

    /**
     * Paystack constructor.
     *
     * @param string $secretKey
     * @param Contracts\ClientInterface|null $client
     */
    public function __construct(string $secretKey, private ?Contracts\ClientInterface $client = null)
    {
        $this->client = $client ?? new Client($secretKey);

        $this->registerService('health', Health::class, HealthInterface::class);
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

    /**
     * Register multiple services.
     *
     * @param array<string, array> $services
     * @return self
     */
    public function registerServices(array $services): self
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
