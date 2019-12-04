<?php

namespace App\Model;

use App\Entity\Product;

/**
 * Interface ProductRepositoryInterface
 * @package App\Entity\Product
 */
interface ProductRepositoryInterface
{

    /**
     * @param int $productId
     * @return Product
     */
    public function findById(int $productId): ?Product;

    /**
     * @return array
     */
    public function _findAll(): array;

    /**
     * @param Product $product
     */
    public function save(Product $product): void;

    /**
     * @param Product $product
     */
    public function delete(Product $product): void;

}
