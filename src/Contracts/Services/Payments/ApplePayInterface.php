<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments;

use Faridibin\Paystack\DataTransferObjects\Response;

interface ApplePayInterface extends PaymentsInterface
{
    /**
     * Register Domain
     * Register a top-level domain or subdomain for your Apple Pay integration.
     *
     * @param string $domain
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function registerDomain(string $domain): Response;

    /**
     * List Domains
     * List all the domains you have registered for your Apple Pay integration.
     *
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function listDomains(bool $useCursor = false, string $next = '', string $previous = ''): Response;

    /**
     * Unregister Domain
     * Unregister a top-level domain or subdomain previously used for your Apple Pay integration.
     *
     * @param string $domain
     * @return \Faridibin\Paystack\DataTransferObjects\Response
     */
    public function unregisterDomain(string $domain): Response;
}
