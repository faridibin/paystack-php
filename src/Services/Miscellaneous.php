<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\MiscellaneousInterface;
use Faridibin\Paystack\DataTransferObjects\Generic\BankDTO;
use Faridibin\Paystack\DataTransferObjects\Generic\CountryDTO;
use Faridibin\Paystack\DataTransferObjects\Generic\StateDTO;
use Faridibin\Paystack\DataTransferObjects\Response;

class Miscellaneous implements MiscellaneousInterface
{
    /**
     * The Miscellaneous service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        ?string $secretKey = null,
        private ?ClientInterface $client = null
    ) {
        $this->client = $client ?? new Client($secretKey);
    }

    /**
     * List Countries
     * Gets a list of countries that Paystack currently supports
     *
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listCountries(): Response
    {
        $response = $this->client->send('GET', '/country');

        return new Response($response, CountryDTO::class, true);
    }

    /**
     * List States (AVS)
     * Get a list of states for a country for address verification
     *
     * @param string $country
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listStates(string $country): Response
    {
        $response = $this->client->send('GET', '/address_verification/states', [
            'query' => [
                'country' => $country
            ]
        ]);

        return new Response($response, StateDTO::class, true);
    }

    /**
     * List Banks
     * Get a list of all supported banks and their properties
     *
     * @param string $country
     * @param bool $useCursor
     * @param int $perPage
     * @param array $optional
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listBanks(string $country, bool $useCursor = false, int $perPage = 50, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/bank', [
            'query' => [
                'country' => $country,
                'use_cursor' => $useCursor,
                'perPage' => $perPage,
                ...$optional
            ]
        ]);

        return new Response($response, BankDTO::class, true);
    }
}
