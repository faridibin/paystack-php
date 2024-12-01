<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DTOs;

class Response
{
    public bool $status;
    public string $message;
    public mixed $data;

    public function __construct(array $response, string $dtoClass = null, bool $isCollection = false)
    {
        dd($response, $dtoClass, $isCollection);
        // $this->status = $response['status'] ?? false;
        // $this->message = $response['message'] ?? '';

        // if ($dtoClass && isset($response['data'])) {
        //     if ($isCollection) {
        //         $this->data = array_map(
        //             fn ($item) => new $dtoClass($item),
        //             $response['data']
        //         );
        //     } else {
        //         $this->data = new $dtoClass($response['data']);
        //     }
        // } else {
        //     $this->data = $response['data'] ?? null;
        // }
    }
}
