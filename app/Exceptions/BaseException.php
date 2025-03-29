<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

abstract class BaseException extends Exception
{
    /**
     * @var array<string, mixed>
     */
    protected array $context = [];

    /**
     * BaseException constructor.
     *
     * @param string $message
     * @param int $code
     * @param array<string, mixed> $context
     */
    public function __construct(string $message = '', int $code = 0, array $context = [])
    {
        parent::__construct($message, $code);
        $this->context = $context;
    }

    /**
     * Get the context data.
     *
     * @return array<string, mixed>
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * Get the HTTP status code for this exception.
     *
     * @return int
     */
    abstract public function getStatusCode(): int;
}
