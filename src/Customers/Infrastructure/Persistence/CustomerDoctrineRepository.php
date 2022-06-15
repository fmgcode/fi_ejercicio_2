<?php

declare(strict_types=1);

namespace App\Customers\Infrastructure\Persistence;

use App\Entity\Customer;
use App\Customers\Domain\CustomerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CustomerDoctrineRepository extends ServiceEntityRepository implements CustomerRepositoryInterface
{
    protected const ENTITY_CLASS_NAME = Customer::class;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, self::ENTITY_CLASS_NAME);
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $qb = $this->createQueryBuilder('customer')
            ->select(
                'customer.id as id',
                'customer.identifier as identifier',
                'customer.name as name',
                'customer.firstLastname as firstLastname'
            );

        $qb->orderBy('customer.id', 'desc');

        return $qb->getQuery()->execute();
    }

    /**
     * @param array $params
     * @return array
     */
    public function filterBy(array $params): array
    {
        $qb = $this->createQueryBuilder('customer')
            ->select(
                'customer.id as id',
                'customer.identifier as identifier',
                'customer.name as name',
                'customer.firstLastname as firstLastname'
            );

        if(isset($params['identifier'])){
            $qb->andWhere('customer.identifier like :identifier')
                ->setParameter('identifier', $params['identifier']);
        }

        if(isset($params['name'])){
            $qb->andWhere('customer.name like :name')
                ->setParameter('name', $params['name']);
        }

        if(isset($params['firstLastname'])){
            $qb->andWhere('customer.firstLastname like :firstLastname')
                ->setParameter('firstLastname', $params['firstLastname']);
        }

        $qb->orderBy('customer.id', 'desc');

        return $qb->getQuery()->execute();
    }

    /**
     * @param int $customerId
     * @return array
     */
    public function searchById(int $customerId): array
    {
        $qb = $this->createQueryBuilder('customer')
            ->select(
                'customer.id',
                'customer.identifier',
                'customer.name',
                'customer.firstLastname'
            )
            ->where('customer.id = :customerId')
            ->setParameter('customerId', $customerId);

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @param int $customerId
     * @return Customer|null
     */
    public function findById(int $customerId): ?Customer
    {
        return $this->_em->getRepository(self::ENTITY_CLASS_NAME)->find($customerId);
    }

    /**
     * @param Customer $customer
     * @return void
     */
    public function save(Customer $customer): void
    {
        $this->_em->persist($customer);
        $this->_em->flush($customer);
    }
}