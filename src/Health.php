<?php

declare(strict_types=1);

namespace Faridibin\Paystack;

use Faridibin\Paystack\Contracts\HealthInterface;
use Faridibin\Paystack\DataTransferObjects\{HealthStatusDTO, HealthSummaryDTO, Response};
use Faridibin\Paystack\Enums\Health as HealthEnum;
use Faridibin\Paystack\Exceptions\PaystackException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

class Health implements HealthInterface
{
    /**
     * The Response from the Paystack Status API.
     *
     * @var array<string, mixed>
     */
    protected readonly array $response;

    /**
     * Client constructor.
     *
     * @param string $secretKey
     * @param string $baseUrl
     */
    public function __construct(
        private readonly string $baseUrl = 'https://status.paystack.com/api/v2/',
        private $client = null
    ) {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'http_errors' => true,
            'verify' => true
        ]);

        $this->getPaystackStatus();
    }

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
    public function serviceStatuses(): array
    {
        return array_reduce($this->response['components'], function ($mapped, $service) {
            $mapped[$service['name']] = [
                'name' => $service['name'],
                'operational' => $service['status'] === 'operational',
                'status' => $service['status'],
                'description' => $service['description'],
                'updated_at' => $service['updated_at'],
            ];

            return $mapped;
        }, []);
    }

    /**
     * Get status of all Paystack services.
     *
     * @return Response
     */
    public function status(): Response
    {
        $services = $this->serviceStatuses();

        $allOperational = array_reduce(
            $services,
            fn($carry, $service) => $carry && $service['status'] === 'operational',
            true
        );

        return new Response([
            'status' => $allOperational,
            'message' => $allOperational ? 'All Systems Operational' : 'Some Systems Are Down',
            'data' => $services
        ], HealthStatusDTO::class, true);
    }

    /**
     * Get summary of Paystack services' status.
     *
     * @return Response
     */
    public function summary(): Response
    {
        $status = $this->response['status'] ?? [];
        $isOperational = $status['description'] === 'All Systems Operational';

        return new Response([
            'status' => $isOperational,
            'message' => $status['description'],
            'data' => [
                'page' => $this->response['page'] ?? [],
                'status' => $status,
            ]
        ], HealthSummaryDTO::class);
    }

    /**
     * Get the health status of Paystack services.
     *
     * @return HealthEnum
     */
    public function healthy(): HealthEnum
    {
        $services = $this->serviceStatuses();

        $operational = 0;
        $total = count($services);

        foreach ($services as $service) {
            if ($service['status'] === 'operational') {
                $operational++;
            }
        }

        $percentage = ($operational / $total) * 100;

        return match (true) {
            $percentage === 100 => HealthEnum::HEALTHY,
            $percentage >= 75 => HealthEnum::DEGRADED,
            $percentage >= 50 => HealthEnum::POOR,
            default => HealthEnum::CRITICAL
        };
    }

    /**
     * Check if the Paystack service is a status.
     *
     * @param Health|string $status
     * @return bool
     */
    public function is(HealthEnum|string $status): bool
    {
        if (is_string($status)) {
            $status = HealthEnum::from($status);
        }

        return $this->healthy() === $status;
    }

    /**
     * Get the Paystack status.
     * This fetches the summary from Paystack's Atlassian Statuspage.
     *
     * @return mixed
     */
    private function getPaystackStatus(): void
    {
        try {
            $response = $this->client->request('GET', 'summary.json');

            $this->response = json_decode($response->getBody()->getContents(), true);
        } catch (ServerException | GuzzleException $e) {
            // return match (true) {
            //     $e instanceof ServerException => new PaystackException('Paystack is currently unavailable', 500),
            //     default => new PaystackException($e->getMessage(), $e->getCode())
            // };

            dd($e);
        }
    }
}
