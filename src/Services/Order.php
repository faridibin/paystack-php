<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\OrderInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Service for managing Paystack order operations.
 */
class Order implements OrderInterface
{
    /**
     * The Order service constructor.
     *
     * @param string|null $secretKey The Paystack secret key (used if no client is injected)
     * @param ClientInterface|null $client The HTTP client instance
     * @throws \Faridibin\Paystack\Exceptions\PaystackException
     */
    public function __construct(
        ?string $secretKey = null,
        private ?ClientInterface $client = null
    ) {
        $this->client = $client ?? new Client($secretKey);
    }

    /**
     * Create Order
     * Create an order on your integration
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response
    {
        $response = $this->client->send('POST', '/order', [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * List Orders
     * List the orders available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/order', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Order
     * Get details of an order on your integration
     *
     * @param string $id The order ID
     * @return Response
     */
    public function fetch(string $id): Response
    {
        $response = $this->client->send('GET', "/order/{$id}");

        return new Response($response);
    }

    /**
     * Fetch Product Orders
     * Fetch all orders for a particular product
     *
     * @param string $productId The product ID
     * @return Response
     */
    public function fetchByProduct(string $productId): Response
    {
        $response = $this->client->send('GET', "/order/product/{$productId}");

        return new Response($response);
    }

    /**
     * Validate Order
     * Validate a pay for me order
     *
     * @param string $code The order code
     * @return Response
     */
    public function validate(string $code): Response
    {
        $response = $this->client->send('GET', "/order/{$code}/validate");

        return new Response($response);
    }
}
