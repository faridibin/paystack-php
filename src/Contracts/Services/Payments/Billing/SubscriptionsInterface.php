<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Payments\Billing;

use Faridibin\Paystack\DTOs\Response;

interface SubscriptionsInterface
{
    /**
     * Create a new subscription.
     *
     * @param string $customer
     * @param string $plan
     * @param array $optional
     * @return Response
     */
    public function createSubscription(string $customer, string $plan, array $optional = []): Response;

    /**
     * List subscriptions.
     * List subscriptions available on your integration
     * 
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function listSubscriptions(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Subscription
     * Get details of a subscription on your integration
     * 
     * @param string $identifier The subscription ID or code you want to fetch
     * @return Response
     */
    public function fetchSubscription(string $identifier): Response;

    /**
     * Enable Subscription
     * Enable a subscription on your integration
     * 
     * @param string $code The subscription code you want to enable
     * @param string $token The token sent to the customer's email
     * @return Response
     */
    public function enableSubscription(string $code, string $token): Response;
}
