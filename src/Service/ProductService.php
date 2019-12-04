<?php

namespace App\Service;


use App\Entity\Product;
use App\Model\ProductRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class ProductService
 * @package App\Service
 */
final class ProductService
{

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * ProductService constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository){
        $this->productRepository = $productRepository;
    }

    /**
     * @param int $productId
     * @return Product
     * @throws EntityNotFoundException
     */
    public function getProduct(int $productId): Product
    {
        $product = $this->productRepository->findById($productId);
        if (!$product) {
            throw new EntityNotFoundException('Product with id '. $productId .' does not exist!');
        }
    }

    /**
     * @return array|null
     */
    public function getAllProducts(): ?array
    {
        return $this->productRepository->_findAll();
    }

    /**
     * @param string $name
     * @param float $price
     * @param int $stock
     * @param string $description
     * @param bool $is_active
     * @return Product
     */
    public function createProduct(
        string $name, 
        float $price, 
        int $stock, 
        string $description = "", 
        bool $is_active = TRUE): Product
    {
        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->setStock($stock);
        $product->setDescription($description);
        $product->setIsActive($is_active);
        $this->productRepository->save($product);

        return $product;
    }

    /**
     * @param string $title
     * @param array $childProducts
     * @return Product
     */
    public function createProductBundle(int $productId, array $childProducts): Product
    {
        $product = $this->productRepository->findById($productId);
        if (!$product) {
            throw new EntityNotFoundException('Product with id '. $productId .' does not exist!');
        }
        //TODO: insted of fetching one by one we can fetch everything together and compare with ids
        foreach($childProducts as $childProductId) {
            $childProduct = $this->productRepository->findById($childProductId);
            if (!$childProduct) {
                throw new EntityNotFoundException('Product with id '. $childProductId .' does not exist!');
            }
            $product->addChildProduct($childProduct);
        }
        $this->productRepository->save($product);

        return $product;
    }

    /**
     * @param int $productId
     * @param string $title
     * @param string $content
     * @return Product
     * @throws EntityNotFoundException
     */
    public function updateProduct(
        int $productId, 
        string $name, 
        float $price, 
        int $stock, 
        string $description = "", 
        bool $is_active = TRUE): Product
    {
        $product = $this->productRepository->findById($productId);
        if (!$product) {
            throw new EntityNotFoundException('Product with id '. $productId .' does not exist!');
        }

        $product->setTitle($title);
        $product->setDescription($content);
        $this->productRepository->save($product);

        return $product;
    }

    /**
     * @param int $productId
     * @throws EntityNotFoundException
     */
    public function deleteProduct(int $productId): void
    {
        $product = $this->productRepository->findById($productId);
        if (!$product) {
            throw new EntityNotFoundException('Product with id '.$productId.' does not exist!');
        }

        $this->productRepository->delete($product);
    }

}
