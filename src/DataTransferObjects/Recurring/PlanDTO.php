<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Recurring;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Collection;
use Faridibin\Paystack\DataTransferObjects\Payments\PageDTO;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Enums\Interval;
use Faridibin\Paystack\Traits\MapToArray;

/**
 * Data Transfer Object representing a Paystack subscription plan.
 *
 * Includes plan details, subscribers, subscriptions, and payment pages.
 */
class PlanDTO implements DataTransferObject
{
    use MapToArray;

    /**
     * The send invoices status
     * 
     * @var bool $send_invoices
     */
    public readonly bool|null $send_invoices;

    /**
     * The send sms status
     * 
     * @var bool $send_sms
     */
    public readonly bool|null $send_sms;

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
    public readonly ?Currency $currency;

    /**
     * The interval of the plan
     *
     * @var Interval $interval
     */
    public readonly ?Interval $interval;

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
     * @param int|null $id
     * @param int|null $integration
     * @param string|null $domain
     * @param string|null $name
     * @param string|null $plan_code
     * @param string|null $description
     * @param int|null $amount
     * @param int|null $invoice_limit
     * @param bool|null $send_invoices
     * @param bool|null $send_sms
     * @param bool|null $hosted_page
     * @param string|null $hosted_page_url
     * @param string|null $hosted_page_summary
     * @param bool|null $migrate
     * @param bool|null $is_deleted
     * @param bool|null $is_archived
     * @param int|null $pages_count
     * @param int|null $subscribers_count
     * @param int|null $subscriptions_count
     * @param int|null $active_subscriptions_count
     * @param int|null $total_revenue
     * @param array $subscriptions
     * @param array $pages
     * @param array $subscribers
     * @param Interval|string|null $interval
     * @param Currency|string|null $currency
     * @param DateTime|string|null $createdAt
     * @param DateTime|string|null $updatedAt
     * @param DateTime|string|null $created_at
     * @param DateTime|string|null $updated_at
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $integration = null,
        public readonly ?string $domain = null,
        public readonly ?string $name = null,
        public readonly ?string $plan_code = null,
        public readonly ?string $description = null,
        public readonly ?int $amount = null,
        public readonly ?int $invoice_limit = null,
        public readonly ?bool $hosted_page = null,
        public readonly ?string $hosted_page_url = null,
        public readonly ?string $hosted_page_summary = null,
        public readonly ?bool $migrate = null,
        public readonly ?bool $is_deleted = null,
        public readonly ?bool $is_archived = null,
        public readonly ?int $pages_count = null,
        public readonly ?int $subscribers_count = null,
        public readonly ?int $subscriptions_count = null,
        public readonly ?int $active_subscriptions_count = null,
        public readonly ?int $total_revenue = null,
        public readonly ?int $total_subscriptions = null,
        public readonly ?int $active_subscriptions = null,
        public readonly ?int $total_subscriptions_revenue = null,
        bool|int|null $send_invoices = null,
        bool|int|null $send_sms = null,
        array $subscriptions = [],
        array $pages = [],
        array $subscribers = [],
        Interval|string|null $interval = null,
        Currency|string|null $currency = null,
        DateTime|string|null $createdAt = null,
        DateTime|string|null $updatedAt = null,
        DateTime|string|null $created_at = null,
        DateTime|string|null $updated_at = null,


        ...$args
    ) {
        $this->send_invoices = \is_int($send_invoices) ? (bool)$send_invoices : $send_invoices;
        $this->send_sms = \is_int($send_sms) ? (bool)$send_sms : $send_sms;

        $this->pages = new Collection($pages, PageDTO::class);
        $this->subscriptions = new Collection($subscriptions, SubscriptionDTO::class);
        $this->subscribers = new Collection($subscribers, SubscriberDTO::class);

        $this->currency = $currency instanceof Currency
            ? $currency
            : (is_string($currency) && $currency !== '' ? Currency::from($currency) : null);

        $this->interval = $interval instanceof Interval
            ? $interval
            : (is_string($interval) && $interval !== '' ? Interval::from($interval) : null);

        $createdAt ??= $created_at;
        $updatedAt ??= $updated_at;

        $this->createdAt = $createdAt ? ($createdAt instanceof DateTime ? $createdAt : new DateTime($createdAt)) : null;
        $this->updatedAt = $updatedAt ? ($updatedAt instanceof DateTime ? $updatedAt : new DateTime($updatedAt)) : null;
    }
}
