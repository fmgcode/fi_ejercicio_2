<?php

declare(strict_types=1);

namespace App\Customers\Domain\Query;

use App\Shared\Domain\Bus\Query\Query;

class SearchAllCustomerQuery implements Query
{
    public function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }
}