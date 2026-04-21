<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts;

/**
 * Defines the contract for the main Paystack SDK entry point.
 */
interface PaystackInterface
{
    /**
     * Register a new service with the SDK.
     *
     * @param string $name The service alias (e.g. 'transactions')
     * @param string $serviceClass The fully-qualified service class name
     * @param string $interfaceClass The fully-qualified interface class name
     * @return static
     */
    public function registerService(string $name, string $serviceClass, string $interfaceClass): static;

    /**
     * Register multiple services at once.
     *
     * @param array<string, array{0: string, 1: string}> $services Map of alias => [serviceClass, interfaceClass]
     * @return static
     */
    public function registerServices(array $services): static;
}
