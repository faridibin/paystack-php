<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Health;

use DateTime;
use DateTimeZone;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class HealthSummaryDTO implements DataTransferObject
{
    /**
     * The name property of the health summary
     * @var string
     */
    public readonly string $name;

    /**
     * The updated_at property of the health summary
     * @var DateTime
     */
    public readonly DateTime $updated_at;

    /**
     * The description property of the health summary
     * @var string|null
     */
    public readonly ?string $description;

    /**
     * The status property of the health summary
     * @var bool
     */
    public readonly bool $status;

    /**
     * The indicator property of the health summary
     * @var string
     */
    public readonly string $indicator;

    /**
     * The Health DTO constructor.
     *
     * @param array $page
     * @param array $status
     */
    public function __construct(
        array $page,
        array $status,
    ) {
        $this->name = $page['name'] ?? 'Paystack';
        $this->updated_at = new DateTime($page['updated_at'] ?? 'now', new DateTimeZone($page['time_zone'] ?? 'Africa/Lagos'));
        $this->status = $status['description'] === 'All Systems Operational';
        $this->indicator = $status['indicator'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'status' => $this->status,
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'description' => $this->description,
            'indicator' => $this->indicator,
        ];
    }
}
