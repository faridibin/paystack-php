<?php

namespace Faridibin\Paystack\Services\Commerce;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Commerce\PaymentPagesInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

class PaymentPages implements PaymentPagesInterface
{
    /**
     * The Terminal service constructor.
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
     * Create a payment page.
     * Create a payment page on your integration
     *
     * @param string $name
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function createPaymentPage(string $name, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/page', [
            'json' => [
                'name' => $name,
                ...$optional
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * List Payment Pages.
     * List payment pages available on your integration.
     *
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listPaymentPages(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/page', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Fetch Payment Page
     * Get details of a payment page on your integration
     *
     * @param string $identifier
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchPaymentPage(string $identifier): Response
    {
        $response = $this->client->send('GET', "/page/{$identifier}");

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Update a payment page.
     * Update a payment page's details on your integration
     *
     * @param string $identifier
     * @param array $data
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function updatePaymentPage(string $identifier, array $data): Response
    {
        $response = $this->client->send('PUT', "/page/{$identifier}", [
            'json' => $data
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Check slug availability.
     * Check if a slug is available for use on your integration
     *
     * @param string $slug
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function checkSlugAvailability(string $slug): Response
    {
        $response = $this->client->send('GET', "/page/check_slug_availability/{$slug}");

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Add Products
     * Add products to a payment page
     *
     * @param string|int $id
     * @param array<int, int> $products
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function addProduct(string|int $id, array $products): Response
    {
        $response = $this->client->send('POST', "/page/{$id}/product", [
            'json' => [
                'products' => $products
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }
}
