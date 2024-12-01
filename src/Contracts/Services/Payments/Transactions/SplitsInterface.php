<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments\Transactions;

use Faridibin\Paystack\DTOs\Response;
use Faridibin\Paystack\Enums\Bearer;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\SplitType;

interface SplitsInterface
{
    /**
     * Create Split.
     * Create a split payment on your integration
     *
     * @param string $name
     * @param \Faridibin\Paystack\Enums\SplitType|string $type
     * @param \Faridibin\Paystack\Enums\Currency|string $currency
     * @param array $subaccounts
     * @param \Faridibin\Paystack\Enums\Bearer|string $bearer
     * @param string $bearerSubaccount
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function createSplit(string $name, SplitType|string $type, Currency|string $currency, array $subaccounts, Bearer|string $bearer, string $bearerSubaccount): Response;

    /**
     * List Splits.
     * List the transaction splits available on your integration
     *
     * @param string $name
     * @param bool $active
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listSplit(string $name, bool $active, int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Split.
     * Get details of a split on your integration
     *
     * @param string $id
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function fetchSplit(string $id): Response;

    /**
     * Update Split.
     * Update a transaction split details on your integration
     *
     * @param string $id
     * @param string $name
     * @param bool $active
     * @param array $optional
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function updateSplit(string $id, string $name, bool $active, array $optional = []): Response;

    /**
     * Add Subaccount Split.
     * Add a Subaccount to a Transaction Split, or update the share of an existing Subaccount in a Transaction Split
     *
     * @param string $id
     * @param string $subaccount
     * @param int $share
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function addSubaccountSplit(string $id, string $subaccount, int $share): Response;

    /**
     * Remove Subaccount Split.
     * Remove a Subaccount from a Transaction Split
     *
     * @param string $id
     * @param string $subaccount
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function removeSubaccountSplit(string $id, string $subaccount): Response;
}
