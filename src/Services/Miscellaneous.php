<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\MiscellaneousInterface;
use Faridibin\Paystack\DTOs\Miscellaneous\CountriesDTO;
use Faridibin\Paystack\DTOs\Miscellaneous\StatesDTO;
use Faridibin\Paystack\DTOs\Response;

class Miscellaneous implements MiscellaneousInterface
{
    /**
     * The Transfers service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
    }

    /**
     * List Countries
     * Gets a list of countries that Paystack currently supports
     *
     * @return Response
     */
    public function listCountries(): Response
    {
        $response = $this->client->send('GET', '/country');

        return new Response($response, CountriesDTO::class, true);
    }

    /**
     * List States (AVS)
     * Get a list of states for a country for address verification
     *
     * @param string $country
     * @return Response
     */
    public function listStates(string $country): Response
    {
        $response = $this->client->send("GET", '/address_verification/states', [
            'query' => [
                'country' => $country
            ]
        ]);

        return new Response($response, StatesDTO::class, true);
    }

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
    public function listBanks(string $country, bool $useCursor = false, int $perPage = 50, array $options = []): Response
    {
        $response = $this->client->send("GET", '/bank', [
            'query' => [
                'country' => $country,
                'use_cursor' => $useCursor,
                'perPage' => $perPage,
                ...$options
            ]
        ]);

        return new Response($response, StatesDTO::class, true);
    }
}
