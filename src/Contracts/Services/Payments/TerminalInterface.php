<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Defines the contract for POS terminal management operations.
 */
interface TerminalInterface extends PaymentsInterface
{
    /**
     * Send Event.
     * Send an event from your application to the Paystack Terminal.
     *
     * @param string $terminalId The ID of the Terminal the event should be sent to
     * @param string $type The type of event to send (e.g. invoice, transaction)
     * @param string $action The action the Terminal needs to take (e.g. process, view, print)
     * @param array $data The payload data sent with the event
     * @return Response
     */
    public function sendEvent(string $terminalId, string $type, string $action, array $data): Response;

    /**
     * Fetch Event Status.
     * Check the status of an event sent to the Terminal.
     *
     * @param string $terminalId The ID of the Terminal
     * @param string $eventId The ID of the event that was sent to the Terminal
     * @return Response
     */
    public function fetchEventStatus(string $terminalId, string $eventId): Response;

    /**
     * Fetch Terminal Status.
     * Check the availability of a Terminal before sending an event to it.
     *
     * @param string $terminalId The ID of the Terminal
     * @return Response
     */
    public function fetchTerminalStatus(string $terminalId): Response;

    /**
     * List Terminals.
     * List the Terminals available on your integration.
     *
     * @param int $perPage Number of records per page
     * @param int $page Page number to retrieve
     * @param array $optional Additional optional filters (e.g. next, previous)
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Terminal.
     * Get the details of a Terminal.
     *
     * @param string $terminalId The ID of the Terminal
     * @return Response
     */
    public function fetch(string $terminalId): Response;

    /**
     * Update Terminal.
     * Update the details of a Terminal.
     *
     * @param string $terminalId The ID of the Terminal
     * @param array $data The fields to update (e.g. name, address)
     * @return Response
     */
    public function update(string $terminalId, array $data): Response;

    /**
     * Commission Terminal.
     * Activate your debug device by linking it to your integration.
     *
     * @param string $serialNumber The serial number of the device to commission
     * @return Response
     */
    public function commission(string $serialNumber): Response;

    /**
     * Decommission Terminal.
     * Unlink your debug device from your integration.
     *
     * @param string $serialNumber The serial number of the device to decommission
     * @return Response
     */
    public function decommission(string $serialNumber): Response;
}
