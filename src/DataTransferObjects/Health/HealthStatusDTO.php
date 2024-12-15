<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Health;

use DateTime;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class HealthStatusDTO implements DataTransferObject
{
    /**
     * The updated_at property of the health status
     * @var DateTime
     */
    public readonly DateTime $updated_at;

    /**
     * The Health DTO constructor.
     *
     * @param bool $operational
     * @param string $status
     * @param DateTime|string $updated_at
     * @param string|null $description
     */
    public function __construct(
        public readonly bool $operational,
        public readonly string $status,
        DateTime|string $updated_at,
        public readonly ?string $description = null,
    ) {
        $this->updated_at = (is_string($updated_at)) ? new DateTime($updated_at) : $updated_at;
    }

    /**
     * Convert the health status to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'operational' => $this->operational,
            'status' => $this->status,
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'description' => $this->description,
        ];
    }
}
