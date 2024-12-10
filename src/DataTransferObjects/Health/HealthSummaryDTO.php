<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class HealthSummaryDTO implements DataTransferObject
{
    /**
     * The Health DTO constructor.
     *
     * @param string $id
     * @param string $name
     * @param string $status
     * @param string $updated_at
     * @param string|null $description
     * @param string|null $group_id
     * @param bool $group
     */
    public function __construct(
        // public readonly string $id,
        // public readonly string $name,
        // public readonly string $status,
        // public readonly string $updated_at,
        // public readonly ?string $description = null,
        // public readonly ?string $group_id = null,
        // public readonly bool $group = false,

        ...$args
    ) {
        //

        dd($args);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'description' => $this->description,
            'group_id' => $this->group_id,
            'group' => $this->group,
        ];
    }
}
