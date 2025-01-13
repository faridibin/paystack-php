<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Traits;

use DateTime;
use BackedEnum;
use ReflectionClass;
use ReflectionProperty;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

trait MapToArray
{
    /**
     * Convert the DTO to an array, excluding null values
     */
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_READONLY);
        $array = [];

        foreach ($properties as $property) {
            $name = $property->getName();

            if (!$property->isInitialized($this)) {
                continue;
            }

            $value = $property->getValue($this);

            if ($value === null) {
                continue;
            }

            $array[$name] = match (true) {
                $value instanceof DateTime => $value->format('Y-m-d H:i:s'),
                $value instanceof BackedEnum => $value->value,
                $value instanceof DataTransferObject => $value->toArray(),
                default => $value
            };
        }

        return $array;
    }
}
