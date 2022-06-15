<?php

declare(strict_types=1);

namespace App\Customers\Application;

use App\Customers\Domain\CustomerRepositoryInterface;
use App\Entity\Customer;

class CustomerService implements CustomerServiceInterface
{
    private CustomerRepositoryInterface $customerRepository;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->customerRepository->all();
    }

    /**
     * @param array $params
     * @return array
     */
    public function filterBy(array $params): array
    {
        return $this->customerRepository->filterBy($params);
    }

    /**
     * @param int $customerId
     * @return array
     */
    public function searchById(int $customerId): array
    {
        return $this->customerRepository->searchById($customerId);
    }

    /**
     * @param int $customerId
     * @return ?Customer|null
     */
    public function findById(int $customerId): ?Customer
    {
        return $this->customerRepository->findById($customerId);
    }

    /**
     * @param array $params
     * @return void
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(array $params): void
    {
        $customer = Customer::createCustomer(
            $params['identifier'],
            $params['name'],
            $params['firstLastname'],
        );

        $this->customerRepository->save($customer);
    }

    /**
     * @param array $params
     * @return void
     * @throws \Exception
     */
    public function edit(array $params): void
    {
        $customer = $this->findById($params['id']);

        $customer->editCustomer(
            $params['name'],
            $params['firstLastname'],
        );

        $this->customerRepository->save($customer);
    }
}