<?php

declare(strict_types=1);

namespace Faridibin\Paystack\DataTransferObjects;

use Exception;
use Faridibin\Paystack\Contracts\DataTransferObjects\DataTransferObject;

class Response implements DataTransferObject
{
    /**
     * The status property of the response
     *
     * @var bool $status
     */
    protected bool $status;

    /**
     * The statusCode property of the response
     *
     * @var int $statusCode
     */
    protected int $statusCode;

    /**
     * The message property of the response
     *
     * @var string $message
     */
    protected string $message;

    /**
     * The data property of the response
     *
     * @var mixed $data
     */
    protected mixed $data;

    /**
     * The Response DTO constructor.
     *
     * @param array|Exception $response
     * @param string|null $dtoClass
     * @param bool $isCollection
     */
    public function __construct(
        array|Exception $response,
        ?string $dtoClass = null,
        protected bool $isCollection = false
    ) {
        match (true) {
            $response instanceof Exception => $this->handleException($response),
            default => $this->handleResponse($response, $dtoClass),
        };
    }

    /**
     * Get the data property of the response
     *
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * Get the status code property of the response
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the status property of the response
     *
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * Get the message property of the response
     *
     * @return mixed
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    public function isCollection(): bool
    {
        return $this->isCollection;
    }

    /**
     * Convert the response to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'status' => $this->getStatus(),
            'message' => $this->getMessage(),
            'data' => $this->data->toArray(),
        ];
    }

    /**
     * Handle exception
     *
     * @param \Exception $exception
     * @return void
     */
    private function handleException(Exception $exception): void
    {
        // TODO: Handle exception
        $this->status = false;

        dd($exception, 'Exception');
        //
        // if ($response instanceof Exception || (!isset($response['status']) && !$response['status'])) {
        //     // TODO: Handle exception
        //     dd($response);

        //     $this->status = false;
        // }

        // $this->status = $response['status'];

        // dd(
        //     $response['message'],
        //     $response['data'],
        //     $response['status'],
        // );


        // if ($isCollection) {
        //     //
        //     dd($dtoClass, $response);
        // }

        // dd($response, $dtoClass, $isCollection);
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

    /**
     * Handle response
     *
     * @param array $response
     * @param string|null $dtoClass
     * @return void
     */
    private function handleResponse(array $response, string $dtoClass = null): void
    {
        $this->status = $response['status'];
        $this->message = $response['message'];

        if (isset($response['data'])) {
            if ($dtoClass && class_exists($dtoClass, true)) {
                $this->data = ($this->isCollection) ? new Collection($response['data'], $dtoClass) : new $dtoClass(...$response['data']);
            } else {
                $this->data = $response['data'];
            }
        }
    }
}
