<?php

declare(strict_types=1);

namespace Faridibin\Paystack;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Exceptions\{AuthenticationException, ApiException, PaystackException, RateLimitException};
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\{ClientException, ServerException, GuzzleException};

class Client implements ClientInterface
{
    /**
     * The Guzzle HTTP client
     *
     * @var GuzzleHttpClient
     */
    private GuzzleHttpClient $client;

    /**
     * Client constructor.
     *
     * @param string $secretKey
     * @param string $baseUrl
     */
    public function __construct(
        private readonly string $secretKey,
        private readonly string $baseUrl = 'https://api.paystack.co'
    ) {
        $this->client = new GuzzleHttpClient([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => "Bearer {$this->secretKey}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'http_errors' => true,
            'verify' => true
        ]);
    }

    /**
     * Get the secret key
     *
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * Send a request to the Paystack API
     *
     * @return array
     * @throws ClientException|ServerException|GuzzleException
     * @throws PaystackException|AuthenticationException|RateLimitException|ApiException
     */
    public function send(string $method, string $endpoint, array $options = []): array
    {
        try {
            $response = $this->client->request($method, $endpoint, $options);

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $body = json_decode($response->getBody()->getContents(), true);

            match ($response->getStatusCode()) {
                401 => throw new AuthenticationException(),
                429 => throw new RateLimitException(errorsBag: $body),
                default => throw new ApiException(
                    $body['message'] ?? $e->getMessage(),
                    $response->getStatusCode(),
                    $body
                )
            };
        } catch (ServerException $e) {
            throw new PaystackException('Paystack is currently unavailable', 500);
        } catch (GuzzleException $e) {
            throw new PaystackException($e->getMessage(), $e->getCode());
        }

        return [];
    }
}
