<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Miscellaneous;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\DataTransferObjects\Relationship;

class CountryDTO implements DataTransferObject
{
    /**
     * The Relationships for the country
     *
     * @var Relationship $relationships
     */
    public readonly Relationship $relationships;

    /**
     * The Country DTO constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $iso_code
     * @param string $default_currency_code
     * @param string $calling_code
     * @param array $integration_defaults
     * @param array $relationships
     * @param bool $pilot_mode
     * @param bool $can_go_live_automatically
     * @param bool $active_for_dashboard_onboarding
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $iso_code,
        public readonly string $default_currency_code,
        public readonly string $calling_code,
        public readonly array $integration_defaults,
        array $relationships,
        public readonly bool $pilot_mode,
        public readonly bool $can_go_live_automatically,
        public readonly bool $active_for_dashboard_onboarding,
    ) {
        $this->relationships = new Relationship(
            // TODO: Implement Relationship DTO
        );
    }

    /**
     * Convert the country to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'iso_code' => $this->iso_code,
            'default_currency_code' => $this->default_currency_code,
            'calling_code' => $this->calling_code,
            'integration_defaults' => $this->integration_defaults,
            'relationships' => $this->relationships->toArray(),
            'pilot_mode' => $this->pilot_mode,
            'can_go_live_automatically' => $this->can_go_live_automatically,
            'active_for_dashboard_onboarding' => $this->active_for_dashboard_onboarding,
        ];
    }
}
