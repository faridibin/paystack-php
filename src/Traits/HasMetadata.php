<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Traits;

trait HasMetadata
{
    /**
     * The metadata property
     * 
     * @var array|null $metadata
     */
    public readonly ?array $metadata;

    /**
     * Resolve the metadata
     *
     * @param mixed $metadata
     */
    private function resolveMetadata(mixed $metadata): void
    {
        if (is_null($metadata)) {
            $this->metadata = null;
            return;
        }

        if (is_string($metadata)) {
            $decoded = json_decode($metadata, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->metadata = $decoded;

                return;
            }
        }

        $this->metadata = is_array($metadata) ? $metadata : null;
    }

    /**
     * Get metadata
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }
}
