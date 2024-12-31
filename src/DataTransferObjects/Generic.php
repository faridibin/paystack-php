<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Traits\MapToArray;

class Generic implements DataTransferObject
{
    use MapToArray;

    /**
     * Store dynamic attributes
     * 
     * @var array
     */
    private array $attributes = [];
    /**
     * The Generic DTO constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = is_array($value) ? new self($value) : $value;
        }
    }

    /**
     * Magic method to get dynamic attributes
     *
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * Magic method to check if attribute exists
     *
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->attributes[$name]);
    }

    /**
     * Get all attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Convert the object to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function ($value) {
            if ($value instanceof self) {
                return $value->toArray();
            }

            return $value;
        }, $this->attributes);
    }
}
