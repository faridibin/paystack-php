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
     * List storefronts with pagination and optional filters.
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage, int $page, array $optional): Response;

    /**
     * Fetch details of a specific storefront by slug.
     *
     * @param string $slug
     * @return Response
     */
    public function fetch(string $slug): Response;
}
