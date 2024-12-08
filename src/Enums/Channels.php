<?php

namespace Faridibin\Paystack\Enums;

enum Channels: string
{
    case BANK = 'bank';
    case CARD = 'card';
    case USSD = 'ussd';
    case QR = 'qr';
    case MOBILE_MONEY = 'mobile_money';
    case BANK_TRANSFER = 'bank_transfer';
    case EFT = 'eft';

    /**
     * Get the list of the enum.
     *
     * @return array
     */
    public static function getList(): array
    {
        return array_map(
            fn(self $case) => $case->value,
            self::cases()
        );
    }

    /**
     * Get the mapping of the enum.
     *
     * @return array
     */
    public static function getMapping(): array
    {
        return array_combine(
            array_map(fn(self $case) => $case->name, self::cases()),
            array_map(fn(self $case) => $case->value, self::cases())
        );
    }

    /**
     * Get the channels.
     *
     * @param string|array|Channels|null $channels
     * @return array|null
     */
    public static function getChannels(string|array|Channels|null $channels = null): ?array
    {
        if (is_null($channels)) {
            return null;
        }

        if (is_array($channels)) {
            return array_map(
                fn($channel) => $channel instanceof Channels ? $channel->value : $channel,
                $channels
            );
        }

        return [$channels instanceof Channels ? $channels->value : $channels];
    }
}
