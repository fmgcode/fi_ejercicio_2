<?php

declare(strict_types=1);

namespace App\Customers\Domain\UseCase;

trait CreateCustomer
{
    public static function createCustomer(string $identifier, string $name, string $firstLastname): self
    {
        return new self($identifier, $name, $firstLastname);
    }
}