<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Recurring;

use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\PlanInterval;

interface PlansInterface extends RecurringInterface
{
    /**
     * Create a plan.
     *
     * @param string $name
     * @param int $amount
     * @param PlanInterval|string $interval
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createPlan(string $name, int $amount, PlanInterval|string $interval, array $optional = []): Response;

    /**
     * List plans.
     * List plans available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listPlans(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Plan
     * Get details of a plan on your integration
     *
     * @param string $identifier The plan ID or code you want to fetch
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchPlan(string $identifier): Response;

    /**
     * Update Plan
     * Update a plan details on your integration
     *
     * @param string $identifier The plan ID or code you want to update
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function updatePlan(string $identifier, array $data): Response;
}
