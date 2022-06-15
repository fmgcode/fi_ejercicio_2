<?php

declare(strict_types=1);

namespace App\Customers\Infrastructure\Handler;

use App\Customers\Application\CustomerServiceInterface;
use App\Customers\Domain\Query\GetCustomerByIdQuery;
use App\Entity\Customer;
use App\Shared\Infrastructure\Bus\MessageHandlerInterface;

class GetCustomerByIdQueryHandler implements MessageHandlerInterface
{
    private CustomerServiceInterface $service;

    public function __construct(CustomerServiceInterface $service)
    {
        $this->service = $service;
    }

    public function __invoke(GetCustomerByIdQuery $command): Customer
    {
        return $this->service->findById(
            $command->id()
        );
    }
}