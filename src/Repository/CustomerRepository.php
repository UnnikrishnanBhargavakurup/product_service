<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Model\CustomerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository implements CustomerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    /**
     * @param int $CustomerId
     * @return Customer
     */
    public function findById(int $CustomerId): ?Customer
    {
        return $this->find($CustomerId);
    }

    /**
     * @return array
     */
    public function _findAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param Customer $Customer
     */
    public function save(Customer $Customer): void
    {
        $this->_em->persist($Customer);
        $this->_em->flush();
    }

    /**
     * @param Customer $Customer
     */
    public function delete(Customer $Customer): void
    {
        $this->_em->remove($Customer);
        $this->_em->flush();
    }
}
