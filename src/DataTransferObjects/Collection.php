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

    public function __construct(array $items = [], ?string $dtoClass = null)
    {
        if ($dtoClass && class_exists($dtoClass, true)) {
            $this->items = array_map(
                fn($item) => new $dtoClass(...$item),
                $items
            );
        } else {
            $this->items = $items;
        }
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
