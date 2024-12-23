<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Traits;

use DateTime;
use BackedEnum;
use ReflectionClass;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

trait MapToArray
{
    /**
     * Convert the DTO to an array, excluding null values
     */
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();
        $array = [];

        foreach ($properties as $property) {
            if (!$property->isReadOnly()) {
                continue;
            }

            $name = $property->getName();
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
