<?php

namespace App\Model;

use App\Entity\Orders;
 
/**
 * Interface OrderRepositoryInterface
 * @package App\Entity\Order
 */
interface OrderRepositoryInterface
{

    /**
     * @param int $orderId
     * @return Orders
     */
    public function findById(int $orderId): ?Orders;

    /**
     * @return array
     */
    public function _findAll(): array;

    /**
     * @param Orders $order
     */
    public function save(Orders $order): void;

    /**
     * @param Orders $order
     */
    public function delete(Orders $order): void;

}
