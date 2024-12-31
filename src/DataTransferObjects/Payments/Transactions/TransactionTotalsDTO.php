<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments\Transactions;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Collection;
use Faridibin\Paystack\Enums\Currency;
use Faridibin\Paystack\Traits\MapToArray;

class TransactionTotalsDTO implements DataTransferObject
{
    use MapToArray;

    /**
     * The collection of total volume by currency
     *
     * @var Collection $total_volume_by_currency
     */
    public readonly Collection $total_volume_by_currency;

    /**
     * The collection of pending transfers by currency
     *
     * @var Collection $pending_transfers_by_currency
     */
    public readonly Collection $pending_transfers_by_currency;

    /**
     * The Transaction Totals DTO constructor.
     *
     * @param int|null $total_transactions
     * @param int|null $total_volume
     * @param int|null $pending_transfers
     * @param array $total_volume_by_currency
     * @param array $pending_transfers_by_currency
     */
    public function __construct(
        public readonly ?int $total_transactions = null,
        public readonly ?int $total_volume = null,
        public readonly ?int $pending_transfers = null,
        ?array $total_volume_by_currency = null,
        ?array $pending_transfers_by_currency = null,

        ...$args // TODO: Remove this line
    ) {
        $this->total_volume_by_currency = new Collection(
            array_map(
                fn(array $item): array => [
                    'currency' => Currency::from($item['currency']),
                    'amount' => (int) $item['amount']
                ],
                $total_volume_by_currency ?? []
            )
        );

        $this->pending_transfers_by_currency = new Collection(
            array_map(
                fn(array $item): array => [
                    'currency' => Currency::from($item['currency']),
                    'amount' => (int) $item['amount']
                ],
                $pending_transfers_by_currency ?? []
            )
        );

        if (!empty($args)) {
            dump([
                'plan_args' => $args, // TODO: Remove this
            ]);
        }
    }
}
