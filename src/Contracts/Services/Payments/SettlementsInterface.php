<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DataTransferObjects\Response;

interface SettlementsInterface extends PaymentsInterface
{
    /**
     * List Settlements
     * List settlements made to your settlement accounts
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listSettlements(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * List Settlement Transactions
     * Get the transactions that make up a particular settlement
     *
     * @param string $identifier The settlement ID in which you want to fetch its transactions
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listSettlementTransactions(string $identifier, int $perPage = 50, int $page = 1, array $optional = []): Response;
}
