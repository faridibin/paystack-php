<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\TerminalInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Service for managing Paystack POS terminal operations.
 */
class Terminal implements TerminalInterface
{
    /**
     * The Terminal service constructor.
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
     * Send Event
     * Send an event from your application to the Paystack Terminal
     *
     * @param string $terminalId The ID of the Terminal the event should be sent to
     * @param string $type The type of event to send (invoice, transaction)
     * @param string $action The action the Terminal needs to take (process, view, print)
     * @param array $data The data sent with the event
     * @return Response
     */
    public function sendEvent(string $terminalId, string $type, string $action, array $data): Response
    {
        $response = $this->client->send('POST', "/terminal/{$terminalId}/event", [
            'json' => [
                'type' => $type,
                'action' => $action,
                'data' => $data
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Event Status
     * Check the status of an event sent to the Terminal
     *
     * @param string $terminalId The ID of the Terminal
     * @param string $eventId The ID of the event that was sent to the Terminal
     * @return Response
     */
    public function fetchEventStatus(string $terminalId, string $eventId): Response
    {
        $response = $this->client->send('GET', "/terminal/{$terminalId}/event/{$eventId}");

        return new Response($response);
    }

    /**
     * Fetch Terminal Status
     * Check the availability of a Terminal before sending an event to it
     *
     * @param string $terminalId The ID of the Terminal
     * @return Response
     */
    public function fetchTerminalStatus(string $terminalId): Response
    {
        $response = $this->client->send('GET', "/terminal/{$terminalId}/presence");

        return new Response($response);
    }

    /**
     * List Terminals
     * List the Terminals available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/terminal', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Terminal
     * Get the details of a Terminal
     *
     * @param string $terminalId The ID of the Terminal
     * @return Response
     */
    public function fetch(string $terminalId): Response
    {
        $response = $this->client->send('GET', "/terminal/{$terminalId}");

        return new Response($response);
    }

    /**
     * Update Terminal
     * Update the details of a Terminal
     *
     * @param string $terminalId The ID of the Terminal
     * @param array $data
     * @return Response
     */
    public function update(string $terminalId, array $data): Response
    {
        $response = $this->client->send('PUT', "/terminal/{$terminalId}", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Commission Terminal
     * Activate your debug device by linking it to your integration
     *
     * @param string $serialNumber The serial number of the device to commission
     * @return Response
     */
    public function commission(string $serialNumber): Response
    {
        $response = $this->client->send('POST', '/terminal/commission_device', [
            'json' => [
                'serial_number' => $serialNumber
            ]
        ]);

        return new Response($response);
    }

    /**
     * Decommission Terminal
     * Unlink your debug device from your integration
     *
     * @param string $serialNumber The serial number of the device to decommission
     * @return Response
     */
    public function decommission(string $serialNumber): Response
    {
        $response = $this->client->send('POST', '/terminal/decommission_device', [
            'json' => [
                'serial_number' => $serialNumber
            ]
        ]);

        return new Response($response);
    }
}
