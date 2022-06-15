<?php

declare(strict_types=1);

namespace App\Entity;

use App\Customers\Domain\UseCase\CreateCustomer;
use App\Customers\Domain\UseCase\EditCustomer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="customer")
 * @ORM\Entity
 */
class Customer extends AggregateRoot
{
    use CreateCustomer;
    use EditCustomer;

    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(name="identifier", type="string", length=255, nullable=false)
     */
    private string $identifier;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column(name="first_lastname", type="string", length=255, nullable=false)
     */
    private string $firstLastname;

    /**
     * @param string $identifier
     * @param string $name
     * @param string $firstLastname
     */
    public function __construct(string $identifier, string $name, string $firstLastname)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->firstLastname = $firstLastname;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFirstLastname(): string
    {
        return $this->firstLastname;
    }

    /**
     * @param string $firstLastname
     */
    public function setFirstLastname(string $firstLastname): void
    {
        $this->firstLastname = $firstLastname;
    }
}