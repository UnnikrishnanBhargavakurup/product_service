<?php

namespace App\Controller\Rest;

use App\Entity\Product;
use App\Service\ProductService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProductController
 * @package App\Controller\Rest
 */
final class ProductController extends AbstractFOSRestController
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Creates a Product resource
     * @SWG\Post(
     *      produces={"application/json"},
     *      tags={"Product"},
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          format="application/json",
     *          description="Provide name, price, stock, description, is_active",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="name", type="string", example="Nokia 8.1"),
     *              @SWG\Property(property="price", type="float", example=10.5),
     *              @SWG\Property(property="stock", type="integer", example=100),
     *              @SWG\Property(property="description", type="string", example="Gorgeous selfies, day or night"),
     *              @SWG\Property(property="is_active", type="boolean", example=TRUE)
     *           )
     *      ),
     *
     *      @SWG\Response(
     *          response="201",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Product::class)
     *          )
     *      ),
     * )
     *
     * @Rest\Post("/products")
     * @param Request $request
     * @return View
     */
    public function createProduct(Request $request): View
    {
        $product = $this->productService->createProduct(
            $request->get('name'),
            $request->get('price'),
            $request->get('stock'),
            $request->get('description'),
            $request->get('is_active')
        );

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($product, Response::HTTP_CREATED);
    }

    /**
     * Retrieves a Product resource
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"Product"},
     *      consumes={"application/json"},
     *
     *      @SWG\Parameter(
     *          name="productId",
     *          in="path",
     *          type="integer",
     *          required=true,
     *      ),
     *
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Product::class)
     *          )
     *      ),
     * )
     *
     * @Rest\Get("/products/{productId}")
     * @param int $productId
     * @return View
     */
    public function getProduct(int $productId): View
    {
        $product = $this->productService->getProduct($productId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($product, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Product resource
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"Product"},
     *      consumes={"application/json"},
     *
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Product::class)
     *          )
     *      ),
     * )
     *
     * @Rest\Get("/products")
     * @return View
     */
    public function getProducts(): View
    {
        $products = $this->productService->getAllProducts();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of product object
        return View::create($products, Response::HTTP_OK);
    }

    /**
     * Replaces Product resource
     * @SWG\Put(
     *      produces={"application/json"},
     *      tags={"Product"},
     *      consumes={"application/json"},
     *
     *      @SWG\Parameter(
     *          name="productId",
     *          in="path",
     *          type="integer",
     *          required=true,
     *      ),
     *
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          type="json",
     *          format="application/json",
     *          description="Provide name, price, stock, description, is_active",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="name", type="string", example="Nokia 8.1"),
     *              @SWG\Property(property="price", type="float", example=10.5),
     *              @SWG\Property(property="stock", type="integer", example=100),
     *              @SWG\Property(property="description", type="string", example="Gorgeous selfies, day or night"),
     *              @SWG\Property(property="is_active", type="boolean", example=TRUE)
     *           )
     *      ),
     *
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Product::class)
     *          )
     *      ),
     * )
     * @Rest\Put("/products/{productId}")
     * @param int $productId
     * @param Request $request
     * @return View
     */
    public function putProduct(int $productId, Request $request): View
    {
        $product = $this->productService->updateProduct(
            $productId,
            $request->get('name'),
            $request->get('price'),
            $request->get('stock'),
            $request->get('description'),
            $request->get('is_active')
        );

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($product, Response::HTTP_OK);
    }

    /**
     * Removes the Product resource
     * @SWG\Delete(
     *      produces={"application/json"},
     *      tags={"Product"},
     *      consumes={"application/json"},
     *
     *      @SWG\Parameter(
     *          name="productId",
     *          in="path",
     *          type="integer",
     *          required=true,
     *      ),
     *
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *      ),
     * )
     *
     * @Rest\Delete("/products/{productId}")
     * @param int $productId
     * @return View
     */
    public function deleteProduct(int $productId): View
    {
        $this->productService->deleteProduct($productId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a product bundle resource
     * @SWG\Post(
     *      produces={"application/json"},
     *      tags={"Product"},
     *      consumes={"application/json"},
     *
     *      @SWG\Parameter(
     *          name="childProducts",
     *          in="body",
     *          description="Provide a list of child product ids",
     *          required=true,
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(
     *                  type="integer",
     *                  format="int32"
     *              ),
     *          )
     *      ),
     *
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Product::class)
     *          )
     *      ),
     * )
     *
     * @Rest\Post("/products/{productId}/add-products")
     * @param Request $request
     * @return View
     */
    public function createProductBundle(int $productId, Request $request): View
    {
        $product = $this->productService->createProductBundle(
            $request->get('childProducts')
        );

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($product, Response::HTTP_CREATED);
    }
}
