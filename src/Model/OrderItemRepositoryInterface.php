<?php

namespace App\Model;

use App\Entity\OrderItem;
 
/**
 * Interface OrderItemRepositoryInterface
 * @package App\Entity\OrderItem
 */
interface OrderItemRepositoryInterface
{

    /**
     * @param int $orderId
     * @return OrderItem
     */
    public function findById(int $orderId): ?OrderItem;

    /**
     * @return array
     */
    public function _findAll(): array;

    /**
     * @param OrderItem $order
     */
    public function save(OrderItem $order): void;

    /**
     * @param OrderItem $order
     */
    public function delete(OrderItem $order): void;

}
