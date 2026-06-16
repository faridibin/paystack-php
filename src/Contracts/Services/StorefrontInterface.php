<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Defines the contract for storefront management operations.
 */
interface StorefrontInterface extends ServiceInterface
{
    /**
     * Create a new storefront.
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response;

    /**
     * List storefronts with pagination and optional filters.
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage, int $page, array $optional): Response;

    /**
     * Fetch details of a specific storefront by ID.
     *
     * @param string $id
     * @return Response
     */
    public function fetch(string $id): Response;

    /**
     * Update an existing storefront by ID.
     *
     * @param string $id
     * @param array $data
     * @return Response
     */
    public function update(string $id, array $data): Response;

    /**
     * Delete a storefront by ID.
     *
     * @param string $id
     * @return Response
     */
    public function delete(string $id): Response;

    /**
     * Verify the availability of a storefront slug.
     *
     * @param string $slug
     * @return Response
     */
    public function verifySlug(string $slug): Response;

    /**
     * Duplicate a storefront by ID.
     *
     * @param string $id
     * @return Response
     */
    public function duplicate(string $id): Response;

    /**
     * Publish a storefront by ID.
     *
     * @param string $id
     * @return Response
     */
    public function publish(string $id): Response;

    /**
     * Fetch the orders attached to a storefront.
     *
     * @param string $id
     * @return Response
     */
    public function fetchOrders(string $id): Response;

    /**
     * List the products attached to a storefront.
     *
     * @param string $id
     * @return Response
     */
    public function listProducts(string $id): Response;

    /**
     * Add products to a storefront.
     *
     * @param string $id
     * @param array $data
     * @return Response
     */
    public function addProducts(string $id, array $data): Response;
}
