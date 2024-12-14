<?php

namespace Faridibin\Paystack\Enums;

enum Month: string
{
    case JANUARY = '01';
    case FEBRUARY = '02';
    case MARCH = '03';
    case APRIL = '04';
    case MAY = '05';
    case JUNE = '06';
    case JULY = '07';
    case AUGUST = '08';
    case SEPTEMBER = '09';
    case OCTOBER = '10';
    case NOVEMBER = '11';
    case DECEMBER = '12';

    /**
     * Get the month name
     *
     * @return string
     */
    public function getName(): string
    {
        return ucfirst(strtolower($this->name));
    }

    /**
     * Check if a month is valid
     *
     * @param string $month
     * @return bool
     */
    public static function isValidMonth(mixed $month): bool
    {
        return in_array($month, array_merge(
            array_column(self::cases(), 'value'),
            array_map('strtoupper', array_column(self::cases(), 'name'))
        ));
    }

    /**
     * Create a month instance from a string or integer value
     *
     * @param int|string $value
     * @return static
     * @throws \ValueError
     */
    public static function fromValue(int|string $value): static
    {
        if (is_numeric($value)) {
            $value = str_pad((string) $value, 2, '0', STR_PAD_LEFT);
            return self::from($value);
        }

        $normalized = strtoupper(trim($value));

        foreach (self::cases() as $case) {
            if ($case->name === $normalized) {
                return $case;
            }
        }

        throw new \ValueError("\"$value\" is not a valid month");
    }

    /**
     * Convert month to string
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->getName();
    }

    /**
     * Get numeric value of month
     *
     * @return int
     */
    public function toNumber(): int
    {
        return (int) $this->value;
    }
}
