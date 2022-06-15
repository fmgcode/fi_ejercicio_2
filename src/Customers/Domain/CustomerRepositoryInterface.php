<?php

declare(strict_types=1);

namespace App\Customers\Domain;

use App\Entity\Customer;

interface CustomerRepositoryInterface
{
    public function all(): array;
    public function filterBy(array $params): array;
    public function searchById(int $customerId): array;
    public function findById(int $customerId): ?Customer;
    public function save(Customer $customer): void;
}