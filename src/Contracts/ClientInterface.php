<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts;

/**
 * Defines the contract for the Paystack HTTP client.
 */
interface ClientInterface
{
    /**
     * Send a request to the Paystack API
     *
     * @param string $method The HTTP method
     * @param string $endpoint The API endpoint
     * @param array $options Request options
     * 
     * @return mixed
     */
    public function send(string $method, string $endpoint, array $options = []): mixed;

    /**
     * Get the secret key used for API authentication
     *
     * @return string
     */
    public function getSecretKey(): string;
}
