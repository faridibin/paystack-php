# paystack-php

A modern, type-safe PHP SDK for [Paystack](https://paystack.com) payment processing.

## Requirements

- PHP 8.0+
- Guzzle 7.x

## Installation

```bash
composer require faridibin/paystack-php
```

## Getting Started

The `Paystack` client only registers the `health` service by default. Register the services you need before calling them.

```php
use Faridibin\Paystack\Paystack;
use Faridibin\Paystack\Services\Payments\Transactions\Transactions;
use Faridibin\Paystack\Services\Payments\Customers;
use Faridibin\Paystack\Contracts\Services\Payments\Transactions\TransactionsInterface;
use Faridibin\Paystack\Contracts\Services\Payments\CustomersInterface;

$paystack = new Paystack(secretKey: 'sk_live_...');

$paystack->registerServices([
    'transactions' => [Transactions::class, TransactionsInterface::class],
    'customers'    => [Customers::class, CustomersInterface::class],
]);

$paystack->transactions()->initialize(amount: 50000, email: 'customer@example.com');
$paystack->customers()->create(['email' => 'customer@example.com', 'first_name' => 'John', 'last_name' => 'Doe']);
```

The alias on the left of each entry is the dynamic method name you'll call on `$paystack`. Pick whatever names you like.

## Services

### Payments

| Suggested alias | Service class |
|---|---|
| `transactions()` | `Services\Payments\Transactions\Transactions` |
| `splits()` | `Services\Payments\Transactions\Splits` |
| `customers()` | `Services\Payments\Customers` |
| `charge()` | `Services\Payments\Charge` |
| `bulkCharges()` | `Services\Payments\BulkCharges` |
| `refunds()` | `Services\Payments\Refunds` |
| `subaccounts()` | `Services\Payments\Subaccounts` |
| `disputes()` | `Services\Payments\Disputes` |
| `settlements()` | `Services\Payments\Settlements` |
| `paymentRequests()` | `Services\Payments\PaymentRequests` |
| `dedicatedAccount()` | `Services\Payments\DedicatedAccount` |
| `terminal()` | `Services\Payments\Terminal` |
| `applePay()` | `Services\Payments\ApplePay` |

### Transfers

| Suggested alias | Service class |
|---|---|
| `transfers()` | `Services\Transfers\Transfers` |
| `recipients()` | `Services\Transfers\Recipients` |
| `control()` | `Services\Transfers\Control` |

### Recurring

| Suggested alias | Service class |
|---|---|
| `plans()` | `Services\Recurring\Plans` |
| `subscriptions()` | `Services\Recurring\Subscriptions` |

### Commerce

| Suggested alias | Service class |
|---|---|
| `products()` | `Services\Commerce\Products` |
| `paymentPages()` | `Services\Commerce\PaymentPages` |

### Other

| Suggested alias | Service class |
|---|---|
| `integration()` | `Services\Integration` |
| `verification()` | `Services\Verification` |
| `miscellaneous()` | `Services\Miscellaneous` |
| `balance()` | `Services\Balance` |
| `directDebit()` | `Services\DirectDebit` |
| `virtualTerminal()` | `Services\VirtualTerminal` |
| `storefront()` | `Services\Storefront` |
| `order()` | `Services\Order` |

## Examples

### Transactions

```php
// Initialize a transaction
$response = $paystack->transactions()->initialize(amount: 50000, email: 'customer@example.com');
$authUrl  = $response->getData()->authorization_url;

// Verify a transaction
$paystack->transactions()->verify('ref_abc123');

// List transactions
$paystack->transactions()->list(perPage: 20, page: 1);

// Fetch a transaction by id
$paystack->transactions()->fetch('123456789');

// Charge a saved authorization
$paystack->transactions()->chargeAuthorization('AUTH_xxx', amount: 10000, email: 'customer@example.com');

// Partial debit
$paystack->transactions()->partialDebit('AUTH_xxx', amount: 10000, currency: 'NGN', email: 'customer@example.com');
```

### Customers

```php
// Create a customer
$paystack->customers()->create([
    'email'      => 'john@example.com',
    'first_name' => 'John',
    'last_name'  => 'Doe',
    'phone'      => '+2348000000000',
]);

// Fetch a customer
$paystack->customers()->fetch('CUS_xxx');

// Update a customer
$paystack->customers()->update('CUS_xxx', ['first_name' => 'Jane']);

// Validate a customer's identity (e.g. BVN check)
$paystack->customers()->validate('CUS_xxx', [
    'first_name'      => 'John',
    'last_name'       => 'Doe',
    'type'            => 'bank_account',
    'value'           => '0123456789',
    'country'         => 'NG',
    'bvn'             => '12345678901',
    'bank_code'       => '058',
    'account_number'  => '0123456789',
]);

// Whitelist or blacklist a customer
$paystack->customers()->setRiskStatus('CUS_xxx', 'allow');
```

### Transfers

```php
use Faridibin\Paystack\Enums\Currency;

// Initiate a transfer (reference must be unique per request — required for idempotency)
$paystack->transfers()->initiateTransfer(
    amount:    10000,
    recipient: 'RCP_xxx',
    reference: 'pay_invoice_42_2026_04',
    optional:  ['reason' => 'Payment for services'],
);

// Finalize a transfer (when OTP is required)
$paystack->transfers()->finalizeTransfer('TRF_xxx', '123456');

// Bulk transfers
$paystack->transfers()->initiateBulkTransfer(Currency::NGN, [
    ['amount' => 5000, 'recipient' => 'RCP_aaa', 'reference' => 'inv_1', 'reason' => 'Invoice 1'],
    ['amount' => 7500, 'recipient' => 'RCP_bbb', 'reference' => 'inv_2', 'reason' => 'Invoice 2'],
]);

// Verify and fetch
$paystack->transfers()->verifyTransfer('ref_abc123');
$paystack->transfers()->fetchTransfer('TRF_xxx');
```

### Recipients

```php
use Faridibin\Paystack\Enums\RecipientType;

// Create a single recipient
$paystack->recipients()->createRecipient(
    type:          RecipientType::NUBAN,
    name:          'John Doe',
    accountNumber: '0123456789',
    bankCode:      '058',
);

// Bulk recipients
$paystack->recipients()->createBulkRecipients([
    ['type' => 'nuban', 'name' => 'John Doe',  'account_number' => '0123456789', 'bank_code' => '058'],
    ['type' => 'nuban', 'name' => 'Jane Smith','account_number' => '0987654321', 'bank_code' => '058'],
]);
```

### Plans & Subscriptions

```php
use Faridibin\Paystack\Enums\PlanInterval;

// Create a plan
$paystack->plans()->create('Pro Monthly', amount: 500000, interval: PlanInterval::MONTHLY);

// Subscribe a customer
$paystack->subscriptions()->create('CUS_xxx', 'PLN_xxx');

// Enable / disable a subscription (token is the email_token from the subscription object)
$paystack->subscriptions()->toggle('SUB_xxx', 'tok_xxx', active: true);
$paystack->subscriptions()->toggle('SUB_xxx', 'tok_xxx', active: false);

// Generate or email a card-update link for the subscription
$paystack->subscriptions()->generateUpdateSubscriptionLink('SUB_xxx');
$paystack->subscriptions()->sendUpdateSubscriptionLink('SUB_xxx');
```

### Splits

```php
use Faridibin\Paystack\Enums\SplitType;
use Faridibin\Paystack\Enums\Bearer;
use Faridibin\Paystack\Enums\Currency;

$paystack->splits()->createSplit(
    name:             'Halfsies',
    type:             SplitType::PERCENTAGE,
    currency:         Currency::NGN,
    subaccounts:      [['subaccount' => 'ACCT_xxx', 'share' => 50]],
    bearer:           Bearer::SUB_ACCOUNT,
    bearerSubaccount: 'ACCT_xxx',
);
```

### Storefront

```php
$paystack->storefront()->create([
    'name'        => 'My Store',
    'slug'        => 'my-store',
    'description' => 'Curated goods',
    'currency'    => 'NGN',
]);

$paystack->storefront()->verifySlug('my-store');
$paystack->storefront()->fetch('1');
$paystack->storefront()->update('1', ['name' => 'My New Store']);
$paystack->storefront()->addProducts('1', ['products' => [10, 20]]);
$paystack->storefront()->publish('1');
$paystack->storefront()->duplicate('1');
$paystack->storefront()->fetchOrders('1');
$paystack->storefront()->listProducts('1');
$paystack->storefront()->delete('1');
```

### Orders

```php
$paystack->order()->create([
    'amount'   => 50000,
    'currency' => 'NGN',
    'items'    => [['product' => 1, 'quantity' => 2]],
]);

$paystack->order()->list(perPage: 20, page: 1);
$paystack->order()->fetch('ORD_xxx');
$paystack->order()->fetchByProduct('123');
$paystack->order()->validate('ORD_xxx');
```

### Miscellaneous

```php
$paystack->miscellaneous()->listCountries();
$paystack->miscellaneous()->listStates('CA');
$paystack->miscellaneous()->listBanks('nigeria');
```

## Webhook Verification

Use `Webhook::validateSignature()` and `Webhook::isIpWhitelisted()` to authenticate incoming Paystack webhooks:

```php
use Faridibin\Paystack\Webhook;
use Faridibin\Paystack\Exceptions\PaystackException;

$payload   = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] ?? '';
$ip        = $_SERVER['REMOTE_ADDR'] ?? '';

try {
    Webhook::isIpWhitelisted($ip);
    Webhook::validateSignature($payload, $signature, 'sk_live_...');

    $event = json_decode($payload, true);

    match ($event['event']) {
        'charge.success'   => handleChargeSuccess($event['data']),
        'transfer.success' => handleTransferSuccess($event['data']),
        default            => null,
    };

    http_response_code(200);
} catch (PaystackException $e) {
    http_response_code(403);
}
```

Paystack sends webhooks only from these IP addresses:

- `52.31.139.75`
- `52.49.173.169`
- `52.214.14.220`

## Testing

```bash
composer test
```

## License

MIT
