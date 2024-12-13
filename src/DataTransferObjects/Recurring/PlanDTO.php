<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Recurring;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Collection;

class PlanDTO implements DataTransferObject
{
    /**
     * The collection of pages
     *
     * @var Collection $pages
     */
    public readonly Collection $pages;

    /**
     * The collection of subscriptions
     *
     * @var Collection $subscriptions
     */
    public readonly Collection $subscriptions;

    /**
     * The collection of subscribers
     *
     * @var Collection $subscribers
     */
    public readonly Collection $subscribers;

    /**
     * The Plan creation date
     *
     * @var DateTime $createdAt
     */
    public readonly ?DateTime $createdAt;

    /**
     * The Plan updated date
     *
     * @var DateTime $updatedAt
     */
    public readonly ?DateTime $updatedAt;

    /**
     * The Plan DTO constructor.
     *
     *
     */
    public function __construct(
        public readonly int $id,
        public readonly int $integration,
        public readonly string $plan_code,
        public readonly string $name,
        public readonly ?string $description,
        public readonly ?string $domain,
        public readonly ?string $hosted_page_url,
        public readonly ?string $hosted_page_summary,

        public readonly bool $migrate,
        public readonly bool $is_deleted,
        public readonly bool $is_archived,
        public readonly bool $send_invoices,
        public readonly bool $send_sms,
        public readonly bool $hosted_page,
        DateTime|string|null $createdAt,
        DateTime|string|null $updatedAt,
        array $pages = [],
        array $subscriptions = [],
        array $subscribers = [],
        ...$args
    ) {
        // "interval" => "monthly"



        // "currency" => "GHS"



        if ($createdAt) {
            $this->createdAt = !($createdAt instanceof DateTime) ? new DateTime($createdAt) : $createdAt;
        }

        if ($updatedAt) {
            $this->updatedAt = !($updatedAt instanceof DateTime) ? new DateTime($updatedAt) : $updatedAt;
        }



        // "amount" => 20000
        // "invoice_limit" => 10
        // "pages_count" => 0
        // "subscribers_count" => 1
        // "subscriptions_count" => 3
        // "active_subscriptions_count" => 1
        // "total_revenue" => 0




        // dd($args);

        $this->pages = new Collection($pages);
        $this->subscriptions = new Collection($subscriptions, SubscriptionDTO::class);
        $this->subscribers = new Collection($subscribers, SubscriberDTO::class);


        dd($args, $this);
    }

    /**
     * Convert the plan to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            //
        ];
    }
}
