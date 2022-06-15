<?php

namespace App\Customers\Infrastructure\Handler;

use App\Customers\Application\CustomerServiceInterface;
use App\Customers\Domain\Command\CreateCustomerCommand;
use App\Shared\Infrastructure\Bus\MessageHandlerInterface;

class CreateCustomerCommandHandler implements MessageHandlerInterface
{
    private CustomerServiceInterface $service;

    public function __construct(CustomerServiceInterface $service)
    {
        $this->service = $service;
    }

    public function __invoke(CreateCustomerCommand $command): void
    {
        $this->service->create(
            [
                'identifier' => $command->identifier(),
                'name' => $command->name(),
                'firstLastname' => $command->firstLastname(),
            ]
        );
    }
}