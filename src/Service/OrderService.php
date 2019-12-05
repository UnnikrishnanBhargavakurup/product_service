<?php

namespace App\Service;

use App\Entity\Orders;
use App\Model\OrderRepositoryInterface;
use App\Model\CustomerRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class OrderService
 * @package App\Service
 */
final class OrderService
{

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var OrderRepositoryInterface
     */
    private $customerRepository;

    /**
     * OrderService constructor.
     * @param OrderRepositoryInterface $orderRepository
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param int $orderId
     * @return Orders
     * @throws EntityNotFoundException
     */
    public function getOrder(int $orderId): Orders
    {
        $order = $this->orderRepository->findById($orderId);
        if (!$order) {
            throw new EntityNotFoundException('Order with id ' . $orderId . ' does not exist!');
        }
        
        return $order;
    }

    /**
     * @return array|null
     */
    public function getAllOrders(): ?array
    {
        return $this->orderRepository->findAll();
    }

    /**
     * @param int $customerId
     * @return Orders
     */
    public function createOrder(int $customerId): Orders
    {
        $customer = $this->customerRepository->findById($customerId);
        if (!$customer) {
            /**
             * TODO: we have an issue with exception handler it will get fixed
             * when the following issue get resolved in FOSRestBundle
             * https://github.com/FriendsOfSymfony/FOSRestBundle/issues/2031
             */
            throw new EntityNotFoundException('Customer with id ' . $customerId . ' does not exist!');
        }
        $order = new Orders();
        $order->setCustomer($customer);
        $order->setStatus('new');
        $this->orderRepository->save($order);

        return $order;
    }

    /**
     * @param int $orderId
     * @param string $title
     * @param string $content
     * @return Order
     * @throws EntityNotFoundException
     */
    public function updateOrder(int $orderId, string $status): Orders
    {
        $order = $this->orderRepository->findById($orderId);
        if (!$order) {
            throw new EntityNotFoundException('Order with id ' . $orderId . ' does not exist!');
        }

        $order->setStatus($status);
        $this->orderRepository->save($order);

        return $order;
    }

    /**
     * @param int $orderId
     * @throws EntityNotFoundException
     */
    public function deleteOrder(int $orderId): void
    {
        $order = $this->orderRepository->findById($orderId);
        if (!$order) {
            throw new EntityNotFoundException('Order with id ' . $orderId . ' does not exist!');
        }

        $this->orderRepository->delete($order);
    }

}
