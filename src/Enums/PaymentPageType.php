<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Represents the types of Paystack payment pages.
 */
enum PaymentPageType: string
{
    case PAYMENT = 'payment';
    case SUBSCRIPTION = 'subscription';
    case PRODUCT = 'product';
    case PLAN = 'plan';
}
