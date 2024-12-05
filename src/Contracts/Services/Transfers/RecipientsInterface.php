<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Transfers;

use Faridibin\Paystack\DTOs\Response;

interface RecipientsInterface extends TransferInterface
{
    /**
     * Create Recipient
     * Creates a new recipient. A duplicate account number will lead to the retrieval of the existing record.
     *
     * @param string $type
     * @param string $name
     * @param string $accountNumber
     * @param string $bankCode
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createRecipient(string $type, string $name, string $accountNumber, string $bankCode, array $optional = []): Response;

    /**
     * Create Bulk Recipients
     * Create multiple transfer recipients in batches. A duplicate account number will lead to the retrieval of the existing record.
     *
     * @param array $recipients
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createBulkRecipients(array $recipients): Response;

    /**
     * List Recipients
     * List transfer recipients available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listRecipients(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Recipient
     * Fetch the details of a transfer recipient
     *
     * @param string $identifier An ID or code for the recipient whose details you want to receive.
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchRecipient(string $identifier): Response;

    /**
     * Update Recipient
     * Update transfer recipients available on your integration
     *
     * @param string $identifier Transfer Recipient's ID or code
     * @param array $data
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function updateRecipient(string $identifier, array $data): Response;

    /**
     * Delete Recipient
     * Delete a transfer recipient (sets the transfer recipient to inactive)
     *
     * @param string $identifier An ID or code for the recipient who you want to delete.
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function deleteRecipient(string $identifier): Response;
}
