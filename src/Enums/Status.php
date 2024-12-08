<?php

namespace Faridibin\Paystack\Enums;

enum Status: string
{
    case ACTIVE = 'active';
    case PAUSED = 'paused';
    case SUCCESS = 'success';
    case COMPLETE = 'complete';
    case FAILED = 'failed';
    case PENDING = 'pending';
    case ONGOING = 'ongoing';
    case PROCESSING = 'processing';
    case QUEUED = 'queued';
    case ABANDONED = 'abandoned';
    case TIMEOUT = 'timeout';
    case CANCELLED = 'cancelled';
    case REVERSED = 'reversed';
    case REFUNDED = 'refunded';
    case OTP = 'otp';
    case AWAITING_MERCHANT_FEEDBACK = 'awaiting-merchant-feedback';
    case AWAITING_BANK_FEEDBACK = 'awaiting-bank-feedback';
    case RESOLVED = 'resolved';
    case UNKNOWN = 'unknown';

    /**
     * Get the list of the enum.
     *
     * @return array
     */
    public static function getList(): array
    {
        return array_map(
            fn(self $case) => $case->value,
            self::cases()
        );
    }

    /**
     * Get the mapping of the enum.
     *
     * @return array
     */
    public static function getMapping(): array
    {
        return array_combine(
            array_map(fn(self $case) => $case->name, self::cases()),
            array_map(fn(self $case) => $case->value, self::cases())
        );
    }

    /**
     * Get the status.
     *
     * @param string|array|Status|null $status
     * @return array|null
     */
    public static function getStatus(string|array|Status|null $status = null): ?array
    {
        if (is_null($status)) {
            return null;
        }

        if (is_array($status)) {
            return array_map(
                fn($stat) => $stat instanceof Status ? $stat->value : $stat,
                $status
            );
        }

        return [$status instanceof Status ? $status->value : $status];
    }
}
