<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts;

interface ClientInterface
{
    /**
     * Send a request to the Paystack API
     *
     * @param string $method The HTTP method
     * @param string $endpoint The API endpoint
     * @param array $options Request options
     * @return array The response data
     *
     * @throws \Faridibin\Paystack\Exceptions\AuthenticationException;
     * @throws \Faridibin\Paystack\Exceptions\ApiException;
     * @throws \Faridibin\Paystack\Exceptions\PaystackException;
     * @throws \Faridibin\Paystack\Exceptions\RateLimitException;
     * @throws \GuzzleHttp\Exception\ClientException;
     * @throws \GuzzleHttp\Exception\ServerException;
     * @throws \GuzzleHttp\Exception\GuzzleException;
     */
    public function send(string $method, string $endpoint, array $options = []): array;

    /**
     * Get the secret key used for API authentication
     */
    public function getSecretKey(): string;
}
