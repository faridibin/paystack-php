<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Defines the contract for order management operations.
 */
interface OrderInterface extends ServiceInterface
{
    /**
     * Create a new order.
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response;

    /**
     * List orders with pagination and optional filters.
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage, int $page, array $optional): Response;

    /**
     * Fetch details of a specific order by ID.
     *
     * @param string $id
     * @return Response
     */
    public function fetch(string $id): Response;

    /**
     * Update an existing order by ID.
     *
     * @param string $id
     * @param array $data
     * @return Response
     */
    public function update(string $id, array $data): Response;
}
