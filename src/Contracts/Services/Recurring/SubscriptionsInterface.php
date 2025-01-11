<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Contracts\Services\Recurring;

use Faridibin\Paystack\DataTransferObjects\Response;

interface SubscriptionsInterface extends RecurringInterface
{
    /**
     * Create a new subscription.
     *
     * @param string $customer
     * @param string $plan
     * @param array $optional
     * @return Response
     */
    public function create(string $customer, string $plan, array $optional = []): Response;

    /**
     * List subscriptions.
     * List subscriptions available on your integration
     * 
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function list(int $perPage = 50, int $page = 1, array $optional = []): Response;

    /**
     * Fetch Subscription
     * Get details of a subscription on your integration
     * 
     * @param string $identifier The subscription ID or code you want to fetch
     * @return Response
     */
    public function fetch(string $identifier): Response;

    /**
     * Toggle Subscription
     * Toggle a subscription's state on your integration
     *
     * @param string $code The subscription code
     * @param string $token The token sent to the customer's email
     * @param bool $active Whether to enable or disable the subscription
     * @return Response
     */
    public function toggle(string $code, string $token, bool $active = true): Response;

    /**
     * Generate Updated Subscription Link
     * Generate a link for updating the card on a subscription
     *
     * @param string $code The subscription code
     * @return Response
     */
    public function generateUpdateSubscriptionLink(string $code): Response;

    /**
     * Send Updated Subscription Link
     * Send a link for updating the card on a subscription
     *
     * @param string $code The subscription code
     * @return Response
     */
    public function sendUpdateSubscriptionLink(string $code): Response;
}
