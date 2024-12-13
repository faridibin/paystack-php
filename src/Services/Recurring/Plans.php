<?php

namespace Faridibin\Paystack\Services\Recurring;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Recurring\PlansInterface;
use Faridibin\Paystack\DataTransferObjects\Recurring\PlanDTO;
use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\PlanInterval;

class Plans implements PlansInterface
{
    /**
     * The Plans service constructor.
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
     * Create a plan.
     *
     * @param string $name
     * @param int $amount
     * @param PlanInterval|string $interval
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function createPlan(string $name, int $amount, PlanInterval|string $interval, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/plan', [
            'json' => [
                'name' => $name,
                'amount' => $amount,
                'interval' => $interval,
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
     * List plans.
     * List plans available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listPlans(int $perPage = 50, int $page = 1, array $optional = []): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function fetchPlan(string $identifier): Response
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
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function updatePlan(string $identifier, array $data): Response
    {
        $response = $this->client->send('PUT', "/plan/{$identifier}", [
            'json' => $data
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }
}
