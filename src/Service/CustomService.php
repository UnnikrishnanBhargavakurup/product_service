<?php

namespace App\Service;

use App\Entity\Product;
use App\Model\OrderRepositoryInterface;
use App\Model\ProductRepositoryInterface;

/**
 * Class CustomService
 * @package App\Service
 */
final class CustomService
{

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * CustomService constructor.
     * @param CustomRepositoryInterface $orderRepository
     * @param CustomerRepositoryInterface $productRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Find all the products and calculate the discounted price and return
     * @return array|null
     */
    public function getAllProducts(): ?array
    {
        $products = $this->productRepository->findAll();
        $customProductList = [];
        foreach ($products as $product) {
            // get all the required properties
            $name = $product->getName();
            $price = $this->applyOffer($product);

            $customProductList[] = [
                "name" => $name,
                "price" => $price,
            ];
        }

        return $customProductList;
    }

    /**
     * Get order details
     * @param int $orderId
     * @return array|null
     */
    public function getOrderDetails(int $orderId): ?array
    {
        $order = $this->orderRepository->findById($orderId);
        if (!$order) {
            throw new EntityNotFoundException('Order with id ' . $orderId . ' does not exist!');
        }

        $orderDetails = [];
        $orderTotal = 0;
        $lineItems = [];
        foreach ($order->getItems() as $item) {

            $product = $item->getProduct();
            $price = $this->applyOffer($product);
            $qty = $item->getCount();
            $name = $product->getName();

            $lineItems[] = [
                "product" => $name,
                "price" => $price,
                "qty" => $qty,
            ];

            $orderTotal += $price * $qty;
        }

        $orderDetails['lineItems'] = $lineItems;
        $orderDetails['total'] = $orderTotal;

        return $orderDetails;
    }

    /**
     * Get offer price for a product
     * @param Product $product
     * @return int
     */
    private function applyOffer(Product $product): ?int
    {
        $offer = $product->getOffer();
        $price = $product->getPrice();
        // if we have an offer we need to reduce that amount from product price
        if ($offer) {
            //TODO: should check if this offer is active and within the timeframe
            $offerValue = $offer->getValue();
            if ($offer->getIsFixed()) {
                $price -= $offerValue;
            } else {
                $price -= (($offerValue / 100) * $price);
            }
        }
        return $price;
    }

}
