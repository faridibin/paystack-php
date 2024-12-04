<?php

namespace Faridibin\Paystack\Services\Payments;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Payments\ApplePayInterface;
use Faridibin\Paystack\DTOs\Response;

class ApplePay implements ApplePayInterface
{
    /**
     * The ApplePay service constructor.
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
     * Register Domain
     * Register a top-level domain or subdomain for your Apple Pay integration.
     *
     * @param string $domain
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function registerDomain(string $domain): Response
    {
        $response = $this->client->send('POST', '/apple-pay/domain', [
            'json' => [
                'domainName' => $domain
            ]
        ]);

        return new Response($response);
    }

    /**
     * List Domains
     * List all the domains you have registered for your Apple Pay integration.
     *
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function listDomains(bool $useCursor = false, string $next = '', string $previous = ''): Response
    {
        $response = $this->client->send('GET', '/apple-pay/domain', [
            'query' => [
                'name' => $useCursor,
                'next' => $next,
                'previous' => $previous,
            ]
        ]);

        return new Response($response);
    }

    /**
     * Unregister Domain
     * Unregister a top-level domain or subdomain previously used for your Apple Pay integration.
     *
     * @param string $domain
     * @return \Faridibin\Paystack\DTOs\Response
     */
    public function unregisterDomain(string $domain): Response
    {
        $response = $this->client->send('DELETE', '/apple-pay/domain', [
            'json' => [
                'domainName' => $domain
            ]
        ]);

        return new Response($response);
    }
}
