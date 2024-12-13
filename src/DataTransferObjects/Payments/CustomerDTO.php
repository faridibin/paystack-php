<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects\Payments;

use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;
use Faridibin\Paystack\Enums\RiskAction;

class CustomerDTO implements DataTransferObject
{
    /**
     * The metadata of the customer
     *
     * @var array $metadata
     */
    public readonly array $metadata;

    /**
     * The risk action of the customer
     *
     * @var RiskAction $risk_action
     */
    public readonly RiskAction $risk_action;

    /**
     * The Customer DTO constructor.
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $customer_code
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $first_name = null,
        public readonly ?string $last_name = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $international_format_phone = null,
        public readonly ?string $customer_code = null,
        ?string $metadata = null,
        RiskAction|string|null $risk_action = null
    ) {
        if (is_string($metadata)) {
            $decoded = json_decode($metadata, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->metadata = $decoded;
            }
        }

        if (!($risk_action instanceof RiskAction)) {
            $this->risk_action = RiskAction::from($risk_action);
        }
    }

    /**
     * Convert the customer to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'customer_code' => $this->customer_code,
        ];
    }
}
