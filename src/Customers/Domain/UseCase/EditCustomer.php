<?php

declare(strict_types=1);

namespace App\Customers\Domain\UseCase;

trait EditCustomer
{
    public function editCustomer(string $name, string $firstLastname): self
    {
        $this->setName($name);
        $this->setFirstLastname($firstLastname);
        return $this;
    }
}