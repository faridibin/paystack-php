<?php

namespace Faridibin\Paystack\Services\Commerce;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Commerce\ProductsInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;

class Products implements ProductsInterface
{
    /**
     * The Products service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        ?string $secretKey = null,
        private ?ClientInterface $client = null
    ) {
        $this->client = $client ?? new Client($secretKey);
    }

    /**
     * Create a product.
     * Create a product on your integration
     *
     * @param string $name
     * @param string $description
     * @param int $price
     * @param Currency|string $currency
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function createProduct(string $name, string $description, int $price, Currency|string $currency, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/product', [
            'json' => [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'currency' => $currency,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Product
     * Get details of a product on your integration
     *
     * @param string $id
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchProduct(string $id): Response
    {
        $response = $this->client->send('GET', "/product/{$id}");

        return new Response($response);
    }

    /**
     * Update a product.
     * Update a product's details on your integration
     *
     * @param string $id
     * @param array $data
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function updateProduct(string $id, array $data): Response
    {
        $response = $this->client->send('PUT', "/product/{$id}", [
            'json' => $data
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * List Products.
     * List products available on your integration.
     *
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listProducts(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/product', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }
}
