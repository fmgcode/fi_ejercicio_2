<?php

declare(strict_types=1);

namespace App\Customers\Domain\Command;

use App\Shared\Domain\Bus\Command\Command;

class CreateCustomerCommand implements Command
{
    private string $identifier;
    private string $name;
    private string $firstLastname;
    
    public function __construct(string $identifier,string $name,string $firstLastname)
    {
        $this->identifier = $identifier;
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
            $params['identifier'],
            $params['name'],
            $params['firstLastname'],
        );
    }

    /**
     * @return string
     */
    public function identifier(): string
    {
        return $this->identifier;
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