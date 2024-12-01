<?php

namespace Faridibin\Paystack\Services;

use Faridibin\Paystack\Contracts\ClientInterface;
use Faridibin\Paystack\Contracts\Services\TerminalInterface;

class Terminal implements TerminalInterface
{
    /**
     * The Terminal service constructor.
     *
     * @param \Faridibin\Paystack\Contracts\ClientInterface $client
     */
    public function __construct(
        private ClientInterface $client
    ) {
        //
    }
}
