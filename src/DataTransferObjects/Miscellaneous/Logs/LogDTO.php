<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Miscellaneous\Logs;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Collection;
use Faridibin\Paystack\Traits\MapToArray;

class LogDTO implements DataTransferObject
{
    use MapToArray;

    /**
     * The collection of history
     *
     * @var Collection $history
     */
    public readonly Collection|null $history;

    /**
     * The start time of the log
     *
     * @var DateTime $start_time
     */
    public readonly ?DateTime $start_time;

    /**
     * The Log DTO constructor.
     *
     * @param int|null $time_spent
     * @param int|null $attempts
     * @param string|null $authentication
     * @param int|null $errors
     * @param bool|null $success
     * @param bool|null $mobile
     * @param array $input
     * @param DateTime|string|int|null $start_time
     * @param mixed $history
     */
    public function __construct(

        public readonly ?int $time_spent = null,
        public readonly ?int $attempts = null,
        public readonly ?string $authentication = null,
        public readonly ?int $errors = null,
        public readonly ?bool $success = null,
        public readonly ?bool $mobile = null,
        public readonly ?array $input = [],
        DateTime|string|int|null $start_time = null,
        mixed $history = null
    ) {
        if ($start_time) {
            if (is_int($start_time)) {
                $start_time = date('Y-m-d H:i:s', $start_time);
            }

            $this->start_time = !($start_time instanceof DateTime) ? new DateTime($start_time) : $start_time;
        }

        $this->history = is_array($history) ? new Collection($history, HistoryDTO::class) : $history;
    }

    /**
     * Check if the transaction has any errors
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return $this->errors > 0;
    }

    /**
     * Get the end time of the transaction
     *
     * @return DateTime|null
     */
    public function getEndTime(): ?DateTime
    {
        if (!$this->start_time || !$this->time_spent) {
            return null;
        }

        return $this->start_time->modify("+{$this->time_spent} seconds");
    }

    /**
     * Check if authentication was required
     *
     * @return bool
     */
    public function requiresAuthentication(): bool
    {
        return !empty($this->authentication);
    }

    /**
     * Check if it's a 3DS authentication
     *
     * @return bool
     */
    public function is3DSAuthentication(): bool
    {
        return $this->authentication === '3DS';
    }

    /**
     * Check if this was a single attempt transaction
     *
     * @return bool
     */
    public function isSingleAttempt(): bool
    {
        return $this->attempts === 1;
    }
}
