<?php

declare(strict_types=1);

namespace App\Customers\Domain\Command;

use App\Shared\Domain\Bus\Command\Command;

class EditCustomerCommand implements Command
{
    private int $id;
    private string $name;
    private string $firstLastname;

    public function __construct(int $id, string $name, string $firstLastname)
    {
        $this->id = $id;
        $this->name = $name;
        $this->firstLastname = $firstLastname;
    }

    /**
     * @param array $params
     * @return static
     */
    public static function create(array $params): self
    {
        return new self(
            $params['id'],
            $params['name'],
            $params['firstLastname'],
        );
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function firstLastname(): string
    {
        return $this->firstLastname;
    }
}