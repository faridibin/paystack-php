<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Defines the contract for virtual terminal management operations.
 */
interface VirtualTerminalInterface extends ServiceInterface
{
    /**
     * Create a new virtual terminal transaction.
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response;

    /**
     * List virtual terminal transactions with pagination and optional filters.
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage, int $page, array $optional): Response;

    /**
     * Fetch details of a specific virtual terminal transaction by code.
     *
     * @param string $code
     * @return Response
     */
    public function fetch(string $code): Response;

    /**
     * Update an existing virtual terminal transaction by code.
     *
     * @param string $code
     * @param array $data
     * @return Response
     */
    public function update(string $code, array $data): Response;

    /**
     * Deactivate a virtual terminal transaction by code.
     *
     * @param string $code
     * @return Response
     */
    public function deactivate(string $code): Response;

    /**
     * Assign a destination to a virtual terminal transaction by code.
     *
     * @param string $code
     * @param array $data
     * @return Response
     */
    public function assignDestination(string $code, array $data): Response;

    /**
     * Unassign a destination from a virtual terminal transaction by code.
     *
     * @param string $code
     * @return Response
     */
    public function unassignDestination(string $code): Response;

    /**
     * Add a split code to a virtual terminal transaction by code.
     *
     * @param string $code
     * @param string $splitCode
     * @return Response
     */
    public function addSplitCode(string $code, string $splitCode): Response;

    /**
     * Remove a split code from a virtual terminal transaction by code.
     *
     * @param string $code
     * @return Response
     */
    public function removeSplitCode(string $code): Response;
}
