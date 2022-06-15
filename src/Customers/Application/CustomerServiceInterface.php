<?php

declare(strict_types=1);

namespace App\Customers\Application;

use App\Entity\Customer;

interface CustomerServiceInterface
{
    public function all(): array;
    public function filterBy(array $params): array;
    public function searchById(int $customerId): array;
    public function findById(int $customerId): ?Customer;
    public function create(array $params): void;
    public function edit(array $params): void;
}