<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\StorefrontInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Service for managing your Paystack storefront.
 */
class Storefront implements StorefrontInterface
{
    /**
     * The Storefront service constructor.
     *
     * @param string|null $secretKey The Paystack secret key (used if no client is injected)
     * @param \Faridibin\Paystack\Contracts\ClientInterface|null $client The HTTP client instance
     * @throws \Faridibin\Paystack\Exceptions\PaystackException
     */
    public function __construct(
        ?string $secretKey = null,
        private ?ClientInterface $client = null
    ) {
        $this->client = $client ?? new Client($secretKey);
    }

    /**
     * List Storefronts
     * List the storefronts on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/storefront', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Storefront
     * Get the details of a storefront on your integration
     *
     * @param string $slug The slug of the storefront
     * @return Response
     */
    public function fetch(string $slug): Response
    {
        $response = $this->client->send('GET', "/storefront/{$slug}");

        return new Response($response);
    }
}
