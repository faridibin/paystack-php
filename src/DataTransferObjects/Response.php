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
     * The meta property of the response
     *
     * @var ?Generic $meta
     */
    protected ?Generic $meta = null;

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
     * Get an item from the collection by key.
     *
     * @param string $key
     * @param mixed $default
     * 
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if (!($this->data instanceof DataTransferObject)) {
            return $default;
        }

        $data = $this->data->toArray();

        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return $default instanceof \Closure ? $default(...$data) : $default;
    }

    /**
     * Get the meta data
     * 
     * @return mixed
     */
    public function getMeta(): mixed
    {
        return $this->meta;
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
     * @return string
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
        $response = [
            'status' => $this->getStatus(),
            'message' => $this->getMessage(),
            'data' => $this->data instanceof DataTransferObject ? $this->data->toArray() : $this->data,
        ];

        if ($this->meta) {
            $response['meta'] = $this->meta->toArray();
        }

        return $response;
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
        $this->status = $response['status'] ?? false;
        $this->message = $response['message'] ?? '';
        $this->statusCode = $response['code'] ?? 200;

        if (isset($response['data'])) {
            $this->data = $this->transformData($response['data'], $dtoClass);
        }

        if (isset($response['meta'])) {
            $this->meta = new Generic($response['meta']);
        }
    }

    /**
     * Handle exception
     *
     * @param \Exception $exception
     * @return void
     */
    private function handleException(Exception $exception): void
    {
        $this->status = false;
        $this->statusCode = $exception->getCode() ?: 500;
        $this->message = $exception->getMessage();

        $this->data = new Generic([
            'error' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ]);
    }

    /**
     * Transform response data based on DTO class and collection status
     * 
     * @param array $data
     * @param string|null $dtoClass
     * @return mixed
     */
    private function transformData(array $data, ?string $dtoClass): mixed
    {
        if (!$dtoClass || !class_exists($dtoClass)) {
            return $this->isCollection
                ? new Collection($data, Generic::class)
                : new Generic($data);
        }

        return $this->isCollection
            ? new Collection($data, $dtoClass)
            : new $dtoClass(...$data);
    }
}
