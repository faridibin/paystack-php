<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DataTransferObjects\Response;

/**
 * Defines the contract for Direct Debit mandate operations.
 */
interface DirectDebitInterface extends ServiceInterface
{
    /**
     * Trigger activation charge for a direct debit mandate.
     *
     * @param array $data
     * @return Response
     */
    public function triggerActivationCharge(array $data): Response;

    /**
     * List direct debit mandate authorizations.
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function listMandateAuthorizations(int $perPage, int $page, array $optional): Response;
}
