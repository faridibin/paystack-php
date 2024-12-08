<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DataTransferObjects\Response;
use Faridibin\Paystack\Enums\Status;

interface BulkChargesInterface extends PaymentsInterface
{
    /**
     * Initiate a bulk charge.
     *
     * @param array $data
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function initiateBulkCharge(array $data = []): Response;

    /**
     * List Bulk Charge Batches
     *This lists all bulk charge batches created by the integration. Statuses can be active, paused, or complete
     * 
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function listBulkChargeBatches(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Bulk Charge Batch
     * This fetches details of a bulk charge batch on your integration
     *
     * @param string $identifier
     * @return Response
     */
    public function fetchBulkChargeBatch(string $identifier): Response;

    /**
     * Fetch Charges In a Batch
     * This endpoint retrieves the charges associated with a specified batch code. 
     * Pagination parameters are available. You can also filter by status.
     *
     * @param string $identifier Batch code
     * @param Status|string $status One of:
     *                             Status::PENDING
     *                             Status::SUCCESS
     *                             Status::FAILED
     * @param int $perPage Number of records per page
     * @param int $page Page number
     * @param array $optional Additional optional parameters
     * @return Response
     */
    public function fetchChargesInBatch(string $identifier, Status|string $status, int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Pause Bulk Charge Batch
     * This pauses a bulk charge batch on your integration
     *
     * @param string $code
     * @return Response
     */
    public function pauseBulkChargeBatch(string $code): Response;

    /**
     * Resume Bulk Charge Batch
     * This resumes a paused bulk charge batch on your integration
     *
     * @param string $code
     * @return Response
     */
    public function resumeBulkChargeBatch(string $code): Response;
}
