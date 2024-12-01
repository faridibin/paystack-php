<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services;

use Faridibin\Paystack\DTOs\Response;

interface MiscellaneousInterface
{
    /**
     * List Countries
     * Gets a list of countries that Paystack currently supports
     *
     * @return Response
     */
    public function listCountries(): Response;

    /**
     * List States (AVS)
     * Get a list of states for a country for address verification
     *
     * @param string $country
     * @return Response
     */
    public function listStates(string $country): Response;

    /**
     * List Banks
     * Get a list of all supported banks and their properties
     *
     * @param string $country
     * @param bool $use_cursor
     * @param int $perPage
     * @param array $options
     * @return Response
     */
    public function listBanks(string $country, bool $use_cursor = false, int $perPage = 50, array $options = []): Response;
}
