<?php

declare(strict_types=1);

namespace App\Customers\Domain\Query;

use App\Shared\Domain\Bus\Query\Query;

class GetCustomerByIdQuery implements Query
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public static function create(int $id): self
    {
        return new self(
            $id
        );
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }
}