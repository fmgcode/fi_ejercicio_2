<?php

declare(strict_types=1);

namespace App\Customers\Infrastructure\Handler;

use App\Customers\Application\CustomerServiceInterface;
use App\Customers\Domain\Query\SearchCustomerByIdQuery;
use App\Shared\Infrastructure\Bus\MessageHandlerInterface;

class SearchCustomerByIdQueryHandler implements MessageHandlerInterface
{
    private CustomerServiceInterface $service;

    public function __construct(CustomerServiceInterface $service)
    {
        $this->service = $service;
    }

    public function __invoke(SearchCustomerByIdQuery $command): array
    {
        return $this->service->searchById(
            $command->id()
        );
    }
}