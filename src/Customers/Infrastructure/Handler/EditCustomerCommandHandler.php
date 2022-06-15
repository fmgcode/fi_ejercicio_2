<?php

namespace App\Customers\Infrastructure\Handler;

use App\Customers\Application\CustomerServiceInterface;
use App\Customers\Domain\Command\EditCustomerCommand;
use App\Shared\Infrastructure\Bus\MessageHandlerInterface;

class EditCustomerCommandHandler implements MessageHandlerInterface
{
    private CustomerServiceInterface $service;

    public function __construct(CustomerServiceInterface $service)
    {
        $this->service = $service;
    }

    public function __invoke(EditCustomerCommand $command): void
    {
        $this->service->edit(
            [
                'id' => $command->id(),
                'name' => $command->name(),
                'firstLastname' => $command->firstLastname(),
            ]
        );
    }
}