<?php

namespace Faridibin\Paystack\Enums;

enum PaymentPageType: string
{
    case PAYMENT = 'payment';
    case SUBSCRIPTION = 'subscription';
    case PRODUCT = 'product';
    case PLAN = 'plan';
}
