<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts;

use Faridibin\Paystack\Contracts\Services\ServiceInterface;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Health;

interface HealthInterface extends ServiceInterface
{
    /**
     * Get status of all Paystack services.
     *
     * @return Response
     */
    public function status(): Response;

    /**
     * Get summary of Paystack services' status.
     *
     * @return Response
     */
    public function summary(): Response;

    /**
     * Get all Paystack services with their operational status.
     *
     * @return array<string, array{
     *    operational: bool,
     *    status: string,
     *    description: string|null,
     *    updated_at: string
     * }>
     */
    public function serviceStatuses(): array;

    /**
     * Get the health status of Paystack services.
     *
     * @return string
     */
    public function healthy(): Health;

    /**
     * Check if the Paystack service is a status.
     *
     * @param Health|string $status
     * @return bool
     */
    public function is(Health|string $status): bool;
}
