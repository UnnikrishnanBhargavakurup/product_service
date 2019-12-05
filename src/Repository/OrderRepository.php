<?php

namespace App\Repository;

use App\Entity\Orders;
use App\Model\OrderRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }

    /**
     * @param int $orderId
     * @return Order
     */
    public function findById(int $orderId): ?Orders
    {
        return $this->find($orderId);
    }

    /**
     * @return array
     */
    public function _findAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param Order $order
     */
    public function save(Orders $order): void
    {
        $this->_em->persist($order);
        $this->_em->flush();
    }

    /**
     * @param Order $order
     */
    public function delete(Orders $order): void
    {
        $this->_em->remove($order);
        $this->_em->flush();
    }
}
