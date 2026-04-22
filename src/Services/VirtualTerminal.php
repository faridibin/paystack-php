<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\VirtualTerminalInterface;
use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Service for managing Paystack virtual terminals.
 */
class VirtualTerminal implements VirtualTerminalInterface
{
    /**
     * The VirtualTerminal service constructor.
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
     * Create Virtual Terminal
     * Create a Virtual Terminal on your integration
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response
    {
        $response = $this->client->send('POST', '/virtual_terminal', [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * List Virtual Terminals
     * List the Virtual Terminals available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/virtual_terminal', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response);
    }

    /**
     * Fetch Virtual Terminal
     * Get the details of a Virtual Terminal
     *
     * @param string $code The Virtual Terminal code
     * @return Response
     */
    public function fetch(string $code): Response
    {
        $response = $this->client->send('GET', "/virtual_terminal/{$code}");

        return new Response($response);
    }

    /**
     * Update Virtual Terminal
     * Update the details of a Virtual Terminal
     *
     * @param string $code The Virtual Terminal code
     * @param array $data
     * @return Response
     */
    public function update(string $code, array $data): Response
    {
        $response = $this->client->send('PUT', "/virtual_terminal/{$code}", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Deactivate Virtual Terminal
     * Deactivate a Virtual Terminal on your integration
     *
     * @param string $code The Virtual Terminal code
     * @return Response
     */
    public function deactivate(string $code): Response
    {
        $response = $this->client->send('PUT', "/virtual_terminal/{$code}/deactivate");

        return new Response($response);
    }

    /**
     * Assign Destination
     * Add a destination (e.g. WhatsApp) to a Virtual Terminal
     *
     * @param string $code The Virtual Terminal code
     * @param array $data
     * @return Response
     */
    public function assignDestination(string $code, array $data): Response
    {
        $response = $this->client->send('POST', "/virtual_terminal/{$code}/destination/assign", [
            'json' => $data
        ]);

        return new Response($response);
    }

    /**
     * Unassign Destination
     * Remove a destination from a Virtual Terminal
     *
     * @param string $code The Virtual Terminal code
     * @return Response
     */
    public function unassignDestination(string $code): Response
    {
        $response = $this->client->send('POST', "/virtual_terminal/{$code}/destination/unassign");

        return new Response($response);
    }

    /**
     * Add Split Code
     * Add a split code to a Virtual Terminal
     *
     * @param string $code The Virtual Terminal code
     * @param string $splitCode The split code to add
     * @return Response
     */
    public function addSplitCode(string $code, string $splitCode): Response
    {
        $response = $this->client->send('PUT', "/virtual_terminal/{$code}/split_code", [
            'json' => [
                'split_code' => $splitCode
            ]
        ]);

        return new Response($response);
    }

    /**
     * Remove Split Code
     * Remove a split code from a Virtual Terminal
     *
     * @param string $code The Virtual Terminal code
     * @return Response
     */
    public function removeSplitCode(string $code): Response
    {
        $response = $this->client->send('DELETE', "/virtual_terminal/{$code}/split_code");

        return new Response($response);
    }
}
