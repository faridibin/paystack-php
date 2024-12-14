<?php

namespace Faridibin\Paystack\Services\Recurring;

use Faridibin\Paystack\Client;
use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\Recurring\SubscriptionsInterface;
use Faridibin\Paystack\DataTransferObjects\Recurring\SubscriptionDTO;
use Faridibin\Paystack\DataTransferObjects\Response;

class Subscriptions implements SubscriptionsInterface
{
    /**
     * The Subscriptions service constructor.
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
     * Create a new subscription.
     *
     * @param string $customer
     * @param string $plan
     * @param array $optional
     * @return Response
     */
    public function createSubscription(string $customer, string $plan, array $optional = []): Response
    {
        $response = $this->client->send('POST', '/subscription', [
            'json' => [
                'customer' => $customer,
                'plan' => $plan,
                ...$optional
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * List subscriptions.
     * List subscriptions available on your integration
     *
     * @param int $perPage
     * @param int $page
     * @param array $optional
     * @return Response
     */
    public function listSubscriptions(int $perPage = 50, int $page = 1, array $optional = []): Response
    {
        $response = $this->client->send('GET', '/subscription', [
            'query' => [
                'perPage' => $perPage,
                'page' => $page,
                ...$optional
            ]
        ]);

        return new Response($response, SubscriptionDTO::class, true);
    }

    /**
     * Fetch Subscription
     * Get details of a subscription on your integration
     *
     * @param string $identifier The subscription ID or code you want to fetch
     * @return Response
     */
    public function fetchSubscription(string $identifier): Response
    {
        $response = $this->client->send('GET', "/subscription/{$identifier}");

        return new Response($response, SubscriptionDTO::class);
    }

    /**
     * Toggle Subscription
     * Toggle a subscription's state on your integration
     *
     * @param string $code The subscription code
     * @param string $token The token sent to the customer's email
     * @param bool $active Whether to enable or disable the subscription
     * @return Response
     */
    public function toggleSubscription(string $code, string $token, bool $active = true): Response
    {
        $endpoint = sprintf('/subscription/%s', $active ? 'enable' : 'disable');

        $response = $this->client->send('POST', $endpoint, [
            'json' => [
                'code' => $code,
                'token' => $token
            ]
        ]);

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }

    /**
     * Generate Updated Subscription Link
     * Generate a link for updating the card on a subscription
     *
     * @param string $code The subscription code
     * @return Response
     */
    public function generateUpdateSubscriptionLink(string $code): Response
    {
        $response = $this->client->send('GET', "/subscription/{$code}/manage/link");

        return new Response($response);
    }

    /**
     * Send Updated Subscription Link
     * Send a link for updating the card on a subscription
     *
     * @param string $code The subscription code
     * @return Response
     */
    public function sendUpdateSubscriptionLink(string $code): Response
    {
        $response = $this->client->send('POST', "/subscription/{$code}/manage/email");

        return new Response(
            $response,
            // CountriesDTO::class,
            // true
        );
    }
}
