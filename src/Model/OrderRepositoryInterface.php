<?php

namespace App\Model;

use App\Entity\Order;
 
/**
 * Interface OrderRepositoryInterface
 * @package App\Entity\Order
 */
interface OrderRepositoryInterface
{

    /**
     * @param int $orderId
     * @return Order
     */
    public function findById(int $orderId): ?Order;

    /**
     * @return array
     */
    public function _findAll(): array;

    /**
     * @param Order $order
     */
    public function save(Order $order): void;

    /**
     * @param Order $order
     */
    public function delete(Order $order): void;

}
