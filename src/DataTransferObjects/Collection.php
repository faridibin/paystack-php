<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class Collection implements DataTransferObject
{
    /**
     * The items property of the collection
     *
     * @var array $items
     */
    public readonly array $items;

    /**
     * The Collection DTO constructor.
     *
     * @param array $items
     * @param string|null $dtoClass
     */
    public function __construct(array $items = [], ?string $dtoClass = null)
    {
        $this->items = ($dtoClass && class_exists($dtoClass, true)) ? array_map(
            fn($item) => new $dtoClass(...$item),
            $items ?? []
        ) : $items;
    }

    /**
     * Get the items property of the collection
     *
     * @return array
     */
    public function get(): array
    {
        return $this->items;
    }

    /**
     * Convert the collection to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(
            fn($item) => $item instanceof DataTransferObject ? $item->toArray() : $item,
            $this->items
        );
    }
}
