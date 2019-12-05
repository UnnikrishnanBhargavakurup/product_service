<?php

namespace App\Repository;

use App\Entity\OrderItem;
use App\Model\OrderItemRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderItem[]    findAll()
 * @method OrderItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderItemRepository extends ServiceEntityRepository implements OrderItemRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderItem::class);
    }

    /**
     * @param int $OrderItemId
     * @return OrderItem
     */
    public function findById(int $OrderItemId): ?OrderItem
    {
        return $this->find($OrderItemId);
    }

    /**
     * @return array
     */
    public function _findAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param OrderItem $OrderItem
     */
    public function save(OrderItem $OrderItem): void
    {
        $this->_em->persist($OrderItem);
        $this->_em->flush();
    }

    /**
     * @param OrderItem $OrderItem
     */
    public function delete(OrderItem $OrderItem): void
    {
        $this->_em->remove($OrderItem);
        $this->_em->flush();
    }
}
