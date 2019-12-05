<?php

namespace App\Service;

use App\Entity\OrderItem;
use App\Model\OrderItemRepositoryInterface;
use App\Model\OrderRepositoryInterface;
use App\Model\ProductRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class OrderItemService
 * @package App\Service
 */
final class OrderItemService
{

    /**
     * @var OrderItemRepositoryInterface
     */
    private $orderItemRepository;

    /**
     * @var OrderRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * OrderItemService constructor.
     * @param OrderItemRepositoryInterface $orderItemRepository
     */
    public function __construct(
        OrderItemRepositoryInterface $orderItemRepository,
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     * @param int $orderItemId
     * @return OrderItem
     * @throws EntityNotFoundException
     */
    public function getOrderItem(int $orderItemId): OrderItem
    {
        $orderItem = $this->orderItemRepository->findById($orderItemId);
        if (!$orderItem) {
            throw new EntityNotFoundException('OrderItem with id ' . $orderItemId . ' does not exist!');
        }

        return $orderItem;
    }

    /**
     * @return array|null
     */
    public function getAllOrderItems(): ?array
    {
        return $this->orderItemRepository->_findAll();
    }

    /**
     * @param int $productId
     * @param int $orderId
     * @param int $count
     * @return OrderItem
     */
    public function createOrderItem(
        int $orderId,
        int $productId,
        int $count): OrderItem {
        $order = $this->orderRepository->findById($orderId);
        if (!$order) {
            throw new EntityNotFoundException('Order with id ' . $orderId . ' does not exist!');
        }

        $product = $this->productRepository->findById($productId);
        if (!$product) {
            throw new EntityNotFoundException('Product with id ' . $productId . ' does not exist!');
        }

        $orderItem = new OrderItem();
        $orderItem->setOrder($order);
        $orderItem->setProduct($product);
        $orderItem->setCount($count);
        $this->orderItemRepository->save($orderItem);

        return $orderItem;
    }

    /**
     * @param int $orderItemId
     * @param int $count
     * @return OrderItem
     * @throws EntityNotFoundException
     */
    public function updateOrderItem(
        int $orderItemId,
        int $count): OrderItem {
        $orderItem = $this->orderItemRepository->findById($orderItemId);
        if (!$orderItem) {
            throw new EntityNotFoundException('OrderItem with id ' . $orderItemId . ' does not exist!');
        }
        // if there is no products we can remove this lineitem
        if ($count === 0) {
            $this->deleteOrderItem($orderItemId);
            return null;
        }
        $orderItem->setCount($count);
        $this->orderItemRepository->save($orderItem);

        return $orderItem;
    }

    /**
     * @param int $orderItemId
     * @throws EntityNotFoundException
     */
    public function deleteOrderItem(int $orderItemId): void
    {
        $orderItem = $this->orderItemRepository->findById($orderItemId);
        if (!$orderItem) {
            throw new EntityNotFoundException('OrderItem with id ' . $orderItemId . ' does not exist!');
        }

        $this->orderItemRepository->delete($orderItem);
    }

}
