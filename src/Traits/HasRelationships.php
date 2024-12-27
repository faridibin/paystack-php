<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Traits;

use Faridibin\Paystack\DataTransferObjects\Relationships;

trait HasRelationships
{
    /**
     * The Relationships for the country
     *
     * @var Relationships $relationships
     */
    public readonly Relationships $relationships;

    /**
     * Resolve the relationships for the DTO
     *
     * @param array $relationships
     */
    public function resolveRelationships(array $relationships = []): void
    {
        $this->relationships = new Relationships($relationships);
    }

    /**
     * Get the relationships for the DTO
     *
     * @return Relationships
     */

    public function getRelationships(): Relationships
    {
        return $this->relationships;
    }
}
