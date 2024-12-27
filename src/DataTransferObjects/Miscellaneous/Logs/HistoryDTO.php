<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Miscellaneous\Logs;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Traits\MapToArray;

class HistoryDTO implements DataTransferObject
{
    use MapToArray;

    /**
     * The History type constants.
     * 
     * @var string TYPE_ACTION
     * @var string TYPE_SUCCESS
     * @var string TYPE_AUTH
     */
    public const TYPE_ACTION = 'action';
    public const TYPE_SUCCESS = 'success';
    public const TYPE_AUTH = 'auth';

    /**
     * The History DTO constructor.
     *
     * @param string $type
     * @param string $message
     * @param int $time
     */
    public function __construct(
        public readonly string $type,
        public readonly string $message,
        public readonly int $time,
    ) {
        // 
    }

    /**
     * Check if the history entry is an action type
     *
     * @return bool
     */
    public function isAction(): bool
    {
        return $this->type === self::TYPE_ACTION;
    }

    /**
     * Check if the history entry is a success type
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->type === self::TYPE_SUCCESS;
    }

    /**
     * Check if the history entry is an authentication type
     *
     * @return bool
     */
    public function isAuth(): bool
    {
        return $this->type === self::TYPE_AUTH;
    }
}
