<?php

namespace App\Repository;

use App\Entity\Product;
use App\Model\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param int $productId
     * @return Product
     */
    public function findById(int $productId): ?Product
    {
        return $this->find($productId);
    }

    /**
     * @param array $productIds
     * @return Product[]
     */
    public function findManyById(array $productIds): array
    {
        return $this->findBy(['id' => $productIds]);
    }

    /**
     * @return array
     */
    public function _findAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param Product $product
     */
    public function save(Product $product): void
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }

    /**
     * @param Product $product
     */
    public function delete(Product $product): void
    {
        $this->_em->remove($product);
        $this->_em->flush();
    }
}
