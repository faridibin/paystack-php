<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Commerce;

use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Currency;

interface ProductsInterface extends CommerceInterface
{
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
    public function createProduct(string $name, string $description, int $price, Currency|string $currency, array $optional = []): Response;

    /**
     * Fetch Product
     * Get details of a product on your integration
     *
     * @param string $id
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchProduct(string $id): Response;

    /**
     * Update a product.
     * Update a product's details on your integration
     *
     * @param string $id
     * @param array $data
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function updateProduct(string $id, array $data): Response;

    /**
     * List Products.
     * List products available on your integration.
     *
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listProducts(int $perPage = 50, int $page = 1, array $optional = []): Response;
}
