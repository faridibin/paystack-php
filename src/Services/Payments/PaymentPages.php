<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\PaymentPagesInterface;
use Faridibin\Paystack\DTOs\Response;

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
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createPaymentPage(string $name, array $optional): Response
    {
        //
    }

    /**
     * List Payment Pages.
     * List payment pages available on your integration.
     *
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listPaymentPages(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        //
    }

    /**
     * Fetch Payment Page
     * Get details of a payment page on your integration
     *
     * @param string $identifier
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchPaymentPage(string $identifier): Response
    {
        //
    }

    /**
     * Update a payment page.
     * Update a payment page's details on your integration
     *
     * @param string $identifier
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function updatePaymentPage(string $identifier, array $data): Response
    {
        //
    }

    /**
     * Check slug availability.
     * Check if a slug is available for use on your integration
     *
     * @param string $slug
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function checkSlugAvailability(string $slug): Response
    {
        //
    }

    /**
     * Add Products
     * Add products to a payment page
     *
     * @param string|int $id
     * @param array<int, int> $products
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function addProduct(string|int $id, array $products): Response
    {
        //
    }
}
