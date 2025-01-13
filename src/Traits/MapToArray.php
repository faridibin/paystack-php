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

    /**
     * Convert the response to an object
     *
     * @return \stdClass
     */
    public function asObject(): \stdClass
    {
        return $this->arrayToObject(
            $this->toArray()
        );
    }

    /**
     * Recursively convert an array to an object
     *
     * @param array $array
     * @return \stdClass|array
     */
    private function arrayToObject(array $array): \stdClass|array
    {
        $object = new \stdClass();

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                // If it's a sequential array, keep it as array
                if (array_keys($value) === range(0, count($value) - 1)) {
                    $object->$key = array_map(function ($item) {
                        return is_array($item) ? $this->arrayToObject($item) : $item;
                    }, $value);
                } else {
                    // If associative array, convert to object
                    $object->$key = $this->arrayToObject($value);
                }
            } else {
                $object->$key = $value;
            }
        }

        return $object;
    }
}
