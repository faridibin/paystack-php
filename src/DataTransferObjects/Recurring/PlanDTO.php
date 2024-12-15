<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Recurring;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Collection;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Interval;

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
     * The currency of the plan
     *
     * @var Currency $currency
     */
    public readonly Currency $currency;

    /**
     * The interval of the plan
     *
     * @var Interval $interval
     */
    public readonly Interval $interval;

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
     * @param int $id
     * @param int $integration
     * @param string $plan_code
     * @param string $name
     * @param string|null $description
     * @param string|null $domain
     * @param string|null $hosted_page_url
     * @param string|null $hosted_page_summary
     * @param int|null $amount
     * @param int|null $invoice_limit
     * @param bool $migrate
     * @param bool $is_deleted
     * @param bool $is_archived
     * @param bool $send_invoices
     * @param bool $send_sms
     * @param bool $hosted_page
     * @param Interval|string $interval
     * @param Currency|string $currency
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $updatedAt
     * @param int|null $pages_count
     * @param int|null $subscribers_count
     * @param int|null $subscriptions_count
     * @param int|null $active_subscriptions_count
     * @param int|null $total_revenue
     * @param int|null $total_subscriptions
     * @param int|null $active_subscriptions
     * @param int|null $total_subscriptions_revenue
     * @param array $pages
     * @param array $subscriptions
     * @param array $subscribers
     */
    public function __construct(
        public readonly ?int $integration = null,
        public readonly ?string $plan_code = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $domain = null,
        public readonly ?int $amount = null,
        public readonly ?bool $send_invoices = null,
        public readonly ?bool $send_sms = null,
        Interval|string|null $interval = null,
        Currency|string|null $currency = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        public readonly ?int $id = null,
        public readonly ?int $pages_count = null,
        public readonly ?int $invoice_limit = null,
        public readonly ?int $subscribers_count = null,
        public readonly ?int $subscriptions_count = null,
        public readonly ?int $active_subscriptions_count = null,
        public readonly ?int $total_revenue = null,
        public readonly ?int $total_subscriptions = null,
        public readonly ?int $active_subscriptions = null,
        public readonly ?int $total_subscriptions_revenue = null,
        public readonly ?string $hosted_page_url = null,
        public readonly ?string $hosted_page_summary = null,
        public readonly bool $is_deleted = false,
        public readonly bool $is_archived = false,
        public readonly ?bool $migrate = null,
        public readonly ?bool $hosted_page = null,
        array $pages = [],
        array $subscriptions = [],
        array $subscribers = [],
    ) {
        if ($currency && !($currency instanceof Currency)) {
            $this->currency = Currency::from($currency);
        }

        if ($interval && !($interval instanceof Interval)) {
            $this->interval = Interval::from($interval);
        }

        if ($createdAt) {
            $this->createdAt = !($createdAt instanceof DateTime) ? new DateTime($createdAt) : $createdAt;
        }

        if ($updatedAt) {
            $this->updatedAt = !($updatedAt instanceof DateTime) ? new DateTime($updatedAt) : $updatedAt;
        }

        $this->pages = new Collection($pages);
        $this->subscriptions = new Collection($subscriptions, SubscriptionDTO::class);
        $this->subscribers = new Collection($subscribers, SubscriberDTO::class);
    }

    /**
     * Convert the plan to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'integration' => $this->integration,
            'plan_code' => $this->plan_code,
            'name' => $this->name,
            'description' => $this->description,
            'domain' => $this->domain,
            'hosted_page_url' => $this->hosted_page_url,
            'hosted_page_summary' => $this->hosted_page_summary,
            'amount' => $this->amount,
            'invoice_limit' => $this->invoice_limit,
            'migrate' => $this->migrate,
            'is_deleted' => $this->is_deleted,
            'is_archived' => $this->is_archived,
            'send_invoices' => $this->send_invoices,
            'send_sms' => $this->send_sms,
            'hosted_page' => $this->hosted_page,
            'interval' => $this->interval?->value,
            'currency' => $this->currency?->value,
            'createdAt' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'pages_count' => $this->pages_count,
            'subscribers_count' => $this->subscribers_count,
            'subscriptions_count' => $this->subscriptions_count,
            'active_subscriptions_count' => $this->active_subscriptions_count,
            'total_revenue' => $this->total_revenue,
            'total_subscriptions' => $this->total_subscriptions,
            'active_subscriptions' => $this->active_subscriptions,
            'total_subscriptions_revenue' => $this->total_subscriptions_revenue,
            'pages' => $this->pages->toArray(),
            'subscriptions' => $this->subscriptions->toArray(),
            'subscribers' => $this->subscribers->toArray(),
        ];
    }
}
