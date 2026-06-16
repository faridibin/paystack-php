<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services\Recurring;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Recurring\PlansInterface;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\PlanInterval;

/**
 * Service for creating and managing subscription plans.
 */
class Plans implements PlansInterface
{
    /**
     * The Plans service constructor.
     *
     * @param string|null $secretKey The Paystack secret key (used if no client is injected)
     * @param \Faridibin\Paystack\Contracts\ClientInterface|null $client The HTTP client instance
     * @throws \Faridibin\Paystack\Exceptions\PaystackException
     */
    public function __construct(
        ?string $secretKey = null,
        private ?ClientInterface $client = null
    ) {
        $this->client = $client ?? new Client($secretKey);
    }

    /**
     * Create a plan.
     *
     * @param string $name
     * @param int $amount
     * @param PlanInterval|string $interval
     * @param array $optional
     * @return Response
     */
    public function create(string $name, int $amount, PlanInterval|string $interval, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/plan', [
            'json' => [
                'name' => $name,
                'amount' => $amount,
                'interval' => $interval,
                ...$optional
            ]
        ]);

        return new Response($response, PlanDTO::class);
    }

    /**
     * List plans.
     * List plans available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/plan', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response, PlanDTO::class, true);
    }

    /**
     * Fetch Plan
     * Get details of a plan on your integration
     *
     * @param string $identifier The plan ID or code you want to fetch
     * @return Response
     */
    public function fetch(string $identifier): Response
    {
        $response = $this->client->send('GET', "/plan/{$identifier}");

        return new Response($response, PlanDTO::class);
    }

    /**
     * Update Plan
     * Update a plan details on your integration
     *
     * @param string $identifier The plan ID or code you want to update
     * @param array $data
     * @return Response
     */
    public function update(string $identifier, array $data): Response
    {
        $response = $this->client->send('PUT', "/plan/{$identifier}", [
            'json' => $data
        ]);

        return new Response($response);
    }
}
