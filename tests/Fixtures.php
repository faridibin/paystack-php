<?php

/**
 * Realistic Paystack API response fixtures.
 *
 * Shapes are taken from the official Paystack API documentation.
 * Each fixture is a raw decoded-JSON array as returned by the Paystack API.
 */
final class Fixtures
{
    // -------------------------------------------------------------------------
    // Transactions
    // -------------------------------------------------------------------------

    public static function transactionInitialize(): array
    {
        return [
            'status'  => true,
            'message' => 'Authorization URL created',
            'data'    => [
                'authorization_url' => 'https://checkout.paystack.com/0peioxfhpn',
                'access_code'       => '0peioxfhpn',
                'reference'         => '7PVGX8MEk85tgeEpVDtD',
            ],
        ];
    }

    public static function transaction(): array
    {
        return [
            'status'  => true,
            'message' => 'Verification successful',
            'data'    => [
                'id'               => 292584142,
                'domain'           => 'test',
                'status'           => 'success',
                'reference'        => '7PVGX8MEk85tgeEpVDtD',
                'receipt_number'   => null,
                'amount'           => 10000,
                'message'          => null,
                'gateway_response' => 'Successful',
                'paid_at'          => '2019-10-09T13:03:28.000Z',
                'created_at'       => '2019-10-09T13:00:08.000Z',
                'channel'          => 'card',
                'currency'         => 'NGN',
                'ip_address'       => '1.2.3.4',
                'fees'             => 150,
                'requested_amount' => 10000,
                'authorization'    => [
                    'authorization_code' => 'AUTH_8dfhjjdt',
                    'bin'                => '408408',
                    'last4'              => '4081',
                    'exp_month'          => '12',
                    'exp_year'           => '2030',
                    'channel'            => 'card',
                    'card_type'          => 'visa DEBIT',
                    'bank'               => 'Test Bank',
                    'country_code'       => 'NG',
                    'brand'              => 'visa',
                    'reusable'           => true,
                    'signature'          => 'SIG_JrPHkDKCkJXKFWhf',
                    'account_name'       => null,
                ],
                'customer'  => [
                    'id'            => 84312219,
                    'first_name'    => 'John',
                    'last_name'     => 'Doe',
                    'email'         => 'john@example.com',
                    'customer_code' => 'CUS_xnxdt6s1zxo8hec',
                    'phone'         => null,
                    'risk_action'   => 'default',
                ],
                'plan'       => null,
                'split'      => [],
                'subaccount' => [],
            ],
        ];
    }

    public static function transactionList(): array
    {
        return [
            'status'  => true,
            'message' => 'Transactions retrieved',
            'data'    => [self::transaction()['data']],
            'meta'    => [
                'total'     => 1,
                'skipped'   => 0,
                'perPage'   => 50,
                'page'      => 1,
                'pageCount' => 1,
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Customers
    // -------------------------------------------------------------------------

    public static function customer(): array
    {
        return [
            'status'  => true,
            'message' => 'Customer created',
            'data'    => [
                'id'            => 84312219,
                'integration'   => 100032,
                'domain'        => 'test',
                'customer_code' => 'CUS_xnxdt6s1zxo8hec',
                'email'         => 'john@example.com',
                'first_name'    => 'John',
                'last_name'     => 'Doe',
                'phone'         => null,
                'identified'    => false,
                'identifications' => null,
                'risk_action'   => 'default',
                'createdAt'     => '2016-03-29T20:03:09.000Z',
                'updatedAt'     => '2016-03-29T20:03:09.000Z',
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Plans
    // -------------------------------------------------------------------------

    public static function plan(): array
    {
        return [
            'status'  => true,
            'message' => 'Plan created',
            'data'    => [
                'id'            => 28,
                'integration'   => 100032,
                'domain'        => 'test',
                'name'          => 'Monthly Retainer',
                'plan_code'     => 'PLN_gx2wn373dvkern4',
                'description'   => null,
                'amount'        => 50000,
                'interval'      => 'monthly',
                'invoice_limit' => 0,
                'send_invoices' => true,
                'send_sms'      => true,
                'currency'      => 'NGN',
                'hosted_page'   => false,
                'migrate'       => false,
                'is_archived'   => false,
                'createdAt'     => '2016-03-29T22:42:50.000Z',
                'updatedAt'     => '2016-03-29T22:42:50.000Z',
            ],
        ];
    }

    public static function planList(): array
    {
        return [
            'status'  => true,
            'message' => 'Plans retrieved',
            'data'    => [self::plan()['data']],
            'meta'    => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Subscriptions
    // -------------------------------------------------------------------------

    public static function subscription(): array
    {
        return [
            'status'  => true,
            'message' => 'Subscription successfully created',
            'data'    => [
                'id'                => 9,
                'domain'            => 'test',
                'integration'       => 100032,
                'subscription_code' => 'SUB_vsyqdmlillxqlm8',
                'email_token'       => 'd7gofp6yppn3qz7',
                'amount'            => 50000,
                'quantity'          => 1,
                'status'            => 'active',
                'start'             => 1459296064,
                'cron_expression'   => '0 0 28 * *',
                'next_payment_date' => '2016-04-28T07:00:00.000Z',
                'createdAt'         => '2016-03-29T22:01:04.000Z',
                'updatedAt'         => '2016-03-29T22:01:04.000Z',
                'customer'          => 23,
                'plan'              => 28,
                'authorization'     => [],
            ],
        ];
    }

    public static function subscriptionList(): array
    {
        return [
            'status'  => true,
            'message' => 'Subscriptions retrieved',
            'data'    => [self::subscription()['data']],
            'meta'    => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Transfer Recipients
    // -------------------------------------------------------------------------

    public static function recipient(): array
    {
        return [
            'status'  => true,
            'message' => 'Transfer recipient created successfully',
            'data'    => [
                'id'             => 55,
                'integration'    => 100073,
                'domain'         => 'test',
                'type'           => 'nuban',
                'name'           => 'John Doe',
                'recipient_code' => 'RCP_t0ya41mp35flk40',
                'active'         => true,
                'currency'       => 'NGN',
                'is_deleted'     => false,
                'details'        => [
                    'account_number' => '0100000010',
                    'account_name'   => 'John Doe',
                    'bank_code'      => '044',
                    'bank_name'      => 'Access Bank',
                ],
                'createdAt' => '2016-10-01T10:59:52.000Z',
                'updatedAt' => '2016-10-01T10:59:52.000Z',
            ],
        ];
    }

    public static function recipientList(): array
    {
        return [
            'status'  => true,
            'message' => 'Transfer recipients retrieved',
            'data'    => [self::recipient()['data']],
            'meta'    => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Transfers
    // -------------------------------------------------------------------------

    public static function transfer(): array
    {
        return [
            'status'  => true,
            'message' => 'Transfer requires OTP to continue',
            'data'    => [
                'id'            => 14,
                'integration'   => 100073,
                'domain'        => 'test',
                'amount'        => 5000,
                'currency'      => 'NGN',
                'source'        => 'balance',
                'reason'        => 'Salary payment',
                'recipient'     => 55,
                'status'        => 'otp',
                'transfer_code' => 'TRF_1ptvuv321ahaa7q',
                'createdAt'     => '2017-02-02T19:39:04.000Z',
                'updatedAt'     => '2017-02-02T19:39:04.000Z',
            ],
        ];
    }

    public static function transferList(): array
    {
        return [
            'status'  => true,
            'message' => 'Transfers retrieved',
            'data'    => [self::transfer()['data']],
            'meta'    => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Balance
    // -------------------------------------------------------------------------

    public static function balance(): array
    {
        return [
            'status'  => true,
            'message' => 'Balances retrieved',
            'data'    => [
                ['currency' => 'NGN', 'balance' => 150700],
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Banks
    // -------------------------------------------------------------------------

    public static function bankList(): array
    {
        return [
            'status'  => true,
            'message' => 'Banks retrieved',
            'data'    => [
                [
                    'id'                       => 1,
                    'name'                     => 'Access Bank',
                    'slug'                     => 'access-bank',
                    'code'                     => '044',
                    'longcode'                 => '044150149',
                    'gateway'                  => null,
                    'pay_with_bank'            => false,
                    'supports_transfer'        => true,
                    'available_for_direct_debit' => false,
                    'active'                   => true,
                    'is_deleted'               => false,
                    'country'                  => 'Nigeria',
                    'currency'                 => 'NGN',
                    'type'                     => 'nuban',
                    'createdAt'                => '2016-07-14T10:04:29.000Z',
                    'updatedAt'                => '2020-02-18T08:06:44.000Z',
                ],
            ],
            'meta' => ['next' => null, 'previous' => null, 'perPage' => 50],
        ];
    }

    // -------------------------------------------------------------------------
    // Countries
    // -------------------------------------------------------------------------

    public static function countryList(): array
    {
        return [
            'status'  => true,
            'message' => 'Countries retrieved',
            'data'    => [
                [
                    'id'                            => 1,
                    'name'                          => 'Nigeria',
                    'iso_code'                      => 'NG',
                    'default_currency_code'         => 'NGN',
                    'calling_code'                  => '+234',
                    'pilot_mode'                    => false,
                    'can_go_live_automatically'     => true,
                    'active_for_dashboard_onboarding' => true,
                    'integration_defaults'          => [],
                    'relationships'                 => [
                        'currency'  => ['type' => 'currency', 'data' => ['NGN']],
                        'integration_feature' => ['type' => 'integration_feature', 'data' => []],
                        'integration_type' => ['type' => 'integration_type', 'data' => ['ITYPE_payment_processing']],
                        'payment_method' => ['type' => 'payment_method', 'data' => ['card']],
                    ],
                ],
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Dedicated Account
    // -------------------------------------------------------------------------

    public static function dedicatedAccount(): array
    {
        return [
            'status'  => true,
            'message' => 'NUBAN successfully created',
            'data'    => [
                'id'             => 253,
                'integration'    => 100073,
                'domain'         => 'test',
                'account_name'   => 'PAYSTACK-JOHN DOE',
                'account_number' => '9930020212',
                'assigned'       => true,
                'currency'       => 'NGN',
                'active'         => true,
                'bank'           => [
                    'name' => 'Wema Bank',
                    'id'   => 20,
                    'slug' => 'wema-bank',
                ],
                'assignment' => [
                    'id'           => 1,
                    'integration'  => 100073,
                    'domain'       => 'test',
                    'account_id'   => 253,
                    'assigned_at'  => '2019-12-12T12:39:04.000Z',
                    'expired'      => false,
                    'account_type' => 'PAY-WITH-TRANSFER-RECURRING',
                    'customer'     => [
                        'id'            => 1530104,
                        'first_name'    => 'John',
                        'last_name'     => 'Doe',
                        'email'         => 'john@example.com',
                        'customer_code' => 'CUS_xnxdt6s1zxo8hec',
                        'phone'         => null,
                        'risk_action'   => 'default',
                    ],
                ],
                'split_config' => [],
                'created_at'   => '2019-12-12T12:39:04.000Z',
                'updated_at'   => '2019-12-12T12:39:04.000Z',
            ],
        ];
    }

    public static function dedicatedAccountList(): array
    {
        return [
            'status'  => true,
            'message' => 'Dedicated accounts retrieved',
            'data'    => [self::dedicatedAccount()['data']],
            'meta'    => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Subaccounts
    // -------------------------------------------------------------------------

    public static function subaccount(): array
    {
        return [
            'status'  => true,
            'message' => 'Subaccount created',
            'data'    => [
                'id'                   => 55,
                'integration'          => 100973,
                'domain'               => 'test',
                'subaccount_code'      => 'ACCT_4hl4xenwpjy5wb2',
                'business_name'        => 'Sunshine Studios',
                'description'          => null,
                'primary_contact_name' => null,
                'primary_contact_email' => null,
                'primary_contact_phone' => null,
                'percentage_charge'    => 18,
                'settlement_bank'      => 'Access Bank',
                'account_number'       => '0193274682',
                'settlement_schedule'  => 'AUTO',
                'currency'             => 'NGN',
                'active'               => true,
                'is_verified'          => false,
                'migrate'              => false,
                'createdAt'            => '2016-10-05T13:22:04.000Z',
                'updatedAt'            => '2016-10-21T02:19:47.000Z',
            ],
        ];
    }

    public static function subaccountList(): array
    {
        return [
            'status'  => true,
            'message' => 'Subaccounts retrieved',
            'data'    => [self::subaccount()['data']],
            'meta'    => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Settlements
    // -------------------------------------------------------------------------

    public static function settlementList(): array
    {
        return [
            'status'  => true,
            'message' => 'Settlements retrieved',
            'data'    => [
                [
                    'id'                      => 1,
                    'domain'                  => 'live',
                    'status'                  => 'success',
                    'currency'                => 'NGN',
                    'integration'             => 100073,
                    'total_amount'            => 1000000,
                    'effective_amount'        => 1000000,
                    'total_fees'              => 0,
                    'total_manual_adjustments' => 0,
                    'settled_by'              => null,
                    'settled_at'              => '2020-01-20T00:00:00.000Z',
                    'created_at'              => '2020-01-19T00:00:00.000Z',
                    'updated_at'              => '2020-01-20T00:00:00.000Z',
                ],
            ],
            'meta' => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Disputes
    // -------------------------------------------------------------------------

    public static function disputeList(): array
    {
        return [
            'status'  => true,
            'message' => 'Disputes retrieved',
            'data'    => [
                [
                    'id'          => 1,
                    'domain'      => 'test',
                    'currency'    => 'NGN',
                    'status'      => 'awaiting-bank-feedback',
                    'resolution'  => null,
                    'refund_amount' => null,
                    'transaction' => [
                        'id'               => 5991491,
                        'domain'           => 'test',
                        'status'           => 'success',
                        'reference'        => 'T685312322670591',
                        'amount'           => 10000,
                        'currency'         => 'NGN',
                        'gateway_response' => 'Approved',
                        'paid_at'          => '2019-07-11T16:00:10.000Z',
                        'created_at'       => '2019-07-11T15:59:57.000Z',
                        'channel'          => 'card',
                    ],
                    'customer' => [
                        'id'            => 1530104,
                        'first_name'    => 'John',
                        'last_name'     => 'Doe',
                        'email'         => 'john@example.com',
                        'customer_code' => 'CUS_xnxdt6s1zxo8hec',
                    ],
                    'created_at' => '2019-07-31T06:49:52.000Z',
                    'updated_at' => '2019-07-31T07:10:26.000Z',
                ],
            ],
            'meta' => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Refunds
    // -------------------------------------------------------------------------

    public static function refund(): array
    {
        return [
            'status'  => true,
            'message' => 'Refund created',
            'data'    => [
                'id'              => 3018572,
                'integration'     => 100073,
                'domain'          => 'live',
                'transaction'     => 1004723697,
                'currency'        => 'NGN',
                'amount'          => 10000,
                'deducted_amount' => 0,
                'status'          => 'pending',
                'refunded_by'     => 'john@example.com',
                'merchant_note'   => 'Refund for T685312322670591',
                'customer_note'   => 'Refund for T685312322670591',
                'expected_at'     => '2020-10-27T15:47:38.000Z',
                'createdAt'       => '2020-10-20T15:47:38.000Z',
                'updatedAt'       => '2020-10-20T15:47:38.000Z',
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Payment Requests
    // -------------------------------------------------------------------------

    public static function paymentRequest(): array
    {
        return [
            'status'  => true,
            'message' => 'Payment request created',
            'data'    => [
                'id'              => 3136406,
                'domain'          => 'test',
                'integration'     => 100032,
                'amount'          => 42000,
                'currency'        => 'NGN',
                'due_date'        => null,
                'has_invoice'     => true,
                'invoice_number'  => 1,
                'description'     => 'A test invoice',
                'pdf_url'         => null,
                'line_items'      => [],
                'tax'             => [],
                'request_code'    => 'PRQ_1weqqsn2wwzgft4',
                'status'          => 'pending',
                'paid'            => false,
                'paid_at'         => null,
                'metadata'        => null,
                'notifications'   => [],
                'offline_reference' => '4286263136406',
                'customer' => [
                    'id'            => 25833615,
                    'first_name'    => 'John',
                    'last_name'     => 'Doe',
                    'email'         => 'john@example.com',
                    'customer_code' => 'CUS_xnxdt6s1zxo8hec',
                    'phone'         => null,
                ],
                'created_at' => '2020-06-29T16:10:01.000Z',
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Products
    // -------------------------------------------------------------------------

    public static function product(): array
    {
        return [
            'status'  => true,
            'message' => 'Product successfully created',
            'data'    => [
                'id'              => 526,
                'integration'     => 343288,
                'domain'          => 'test',
                'name'            => 'T-shirt',
                'description'     => 'A nice shirt',
                'product_code'    => 'PROD_hb8o42zl4vzahze',
                'slug'            => 'tshirt-y4a4e9',
                'currency'        => 'NGN',
                'price'           => 2500,
                'quantity'        => 100,
                'quantity_sold'   => null,
                'is_shippable'    => false,
                'unlimited'       => false,
                'active'          => true,
                'in_stock'        => true,
                'has_variants'    => false,
                'createdAt'       => '2019-06-29T16:10:01.000Z',
                'updatedAt'       => '2019-06-29T16:10:01.000Z',
            ],
        ];
    }

    public static function productList(): array
    {
        return [
            'status'  => true,
            'message' => 'Products retrieved',
            'data'    => [self::product()['data']],
            'meta'    => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Payment Pages
    // -------------------------------------------------------------------------

    public static function paymentPage(): array
    {
        return [
            'status'  => true,
            'message' => 'Page created',
            'data'    => [
                'id'                 => 12,
                'integration'        => 100032,
                'domain'             => 'test',
                'name'               => 'My Payment Page',
                'slug'               => '5nApBwZkvY',
                'description'        => null,
                'currency'           => 'NGN',
                'type'               => 'payment',
                'collect_phone'      => false,
                'active'             => true,
                'published'          => true,
                'migrate'            => null,
                'split_code'         => null,
                'notification_email' => null,
                'metadata'           => '{}',
                'createdAt'          => '2016-09-09T19:18:37.000Z',
                'updatedAt'          => '2016-09-09T19:18:37.000Z',
            ],
        ];
    }

    public static function paymentPageList(): array
    {
        return [
            'status'  => true,
            'message' => 'Pages retrieved',
            'data'    => [self::paymentPage()['data']],
            'meta'    => ['total' => 1, 'skipped' => 0, 'perPage' => 50, 'page' => 1, 'pageCount' => 1],
        ];
    }

    // -------------------------------------------------------------------------
    // Charge
    // -------------------------------------------------------------------------

    public static function charge(): array
    {
        return [
            'status'  => true,
            'message' => 'Charge attempted',
            'data'    => [
                'reference'        => 'ref_abc123',
                'status'           => 'send_pin',
                'display_text'     => 'Please enter your card PIN.',
                'amount'           => 10000,
                'currency'         => 'NGN',
                'transaction'      => 292584142,
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Bulk Charges
    // -------------------------------------------------------------------------

    public static function bulkChargeBatch(): array
    {
        return [
            'status'  => true,
            'message' => 'Charges have been queued',
            'data'    => [
                'id'         => 1,
                'domain'     => 'test',
                'batch_code' => 'BCH_180tl7oq7cayggh',
                'status'     => 'active',
                'total_charges'   => 2,
                'pending_charges' => 2,
                'createdAt'  => '2018-08-23T10:34:08.000Z',
                'updatedAt'  => '2018-08-23T10:34:08.000Z',
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Integration
    // -------------------------------------------------------------------------

    public static function timeout(): array
    {
        return [
            'status'  => true,
            'message' => 'Payment session timeout retrieved',
            'data'    => [
                'payment_session_timeout' => 30,
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Verification
    // -------------------------------------------------------------------------

    public static function resolvedAccount(): array
    {
        return [
            'status'  => true,
            'message' => 'Account number resolved',
            'data'    => [
                'account_number' => '0123456789',
                'account_name'   => 'John Doe',
                'bank_id'        => 9,
            ],
        ];
    }

    public static function resolvedCardBin(): array
    {
        return [
            'status'  => true,
            'message' => 'Bin resolved',
            'data'    => [
                'bin'          => '539983',
                'brand'        => 'Mastercard',
                'sub_brand'    => '',
                'country_code' => 'NG',
                'country_name' => 'Nigeria',
                'card_type'    => 'DEBIT',
                'bank'         => 'Guaranty Trust Bank',
                'linked_bank_id' => 9,
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Generic success (used where the endpoint returns no meaningful data body)
    // -------------------------------------------------------------------------

    public static function success(string $message = 'Request successful'): array
    {
        return [
            'status'  => true,
            'message' => $message,
            'data'    => true,
        ];
    }
}
