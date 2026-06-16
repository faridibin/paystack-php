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
     * Create Storefront
     * Create a storefront on your integration
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response
    {
        $response = $this->client->send('POST', '/storefront', [
            'json' => $data
        ]);

        return new Response($response);
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
     * @param string $id The storefront ID
     * @return Response
     */
    public function fetch(string $id): Response
    {
        $response = $this->client->send('GET', "/storefront/{$id}");

        return new Response($response);
    }

    /**
     * Update Storefront
     * Update an existing storefront on your integration
     *
     * @param string $id The storefront ID
     * @param array $data
     * @return Response
     */
    public function update(string $id, array $data): Response
    {
        $response = $this->client->send('PUT', "/storefront/{$id}", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Delete Storefront
     * Delete a storefront on your integration
     *
     * @param string $id The storefront ID
     * @return Response
     */
    public function delete(string $id): Response
    {
        $response = $this->client->send('DELETE', "/storefront/{$id}");

        return new Response($response);
    }

    /**
     * Verify Storefront Slug
     * Verify the availability of a storefront slug
     *
     * @param string $slug The slug to verify
     * @return Response
     */
    public function verifySlug(string $slug): Response
    {
        $response = $this->client->send('GET', "/storefront/verify/{$slug}");

        return new Response($response);
    }

    /**
     * Duplicate Storefront
     * Duplicate an existing storefront on your integration
     *
     * @param string $id The storefront ID
     * @return Response
     */
    public function duplicate(string $id): Response
    {
        $response = $this->client->send('POST', "/storefront/{$id}/duplicate");

        return new Response($response);
    }

    /**
     * Publish Storefront
     * Publish a storefront on your integration
     *
     * @param string $id The storefront ID
     * @return Response
     */
    public function publish(string $id): Response
    {
        $response = $this->client->send('POST', "/storefront/{$id}/publish");

        return new Response($response);
    }

    /**
     * Fetch Storefront Orders
     * List the orders for a storefront
     *
     * @param string $id The storefront ID
     * @return Response
     */
    public function fetchOrders(string $id): Response
    {
        $response = $this->client->send('GET', "/storefront/{$id}/order");

        return new Response($response);
    }

    /**
     * List Storefront Products
     * List the products attached to a storefront
     *
     * @param string $id The storefront ID
     * @return Response
     */
    public function listProducts(string $id): Response
    {
        $response = $this->client->send('GET', "/storefront/{$id}/product");

        return new Response($response);
    }

    /**
     * Add Products to Storefront
     * Add one or more products to a storefront
     *
     * @param string $id The storefront ID
     * @param array $data
     * @return Response
     */
    public function addProducts(string $id, array $data): Response
    {
        $response = $this->client->send('POST', "/storefront/{$id}/product", [
            'json' => $data
        ]);

        return new Response($response);
    }
}
