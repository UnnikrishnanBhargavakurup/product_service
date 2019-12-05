<?php

namespace App\Controller\Rest;

use App\Service\CustomService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CustomController
 * @package App\Controller\Rest
 */
final class CustomController extends AbstractFOSRestController
{
    /**
     * @var CustomService
     */
    private $customService;

    /**
     * CustomController constructor.
     * @param CustomService $customService
     */
    public function __construct(CustomService $customService)
    {
        $this->customService = $customService;
    }

    /**
     * Retrieves all the products and calculate the discounted price
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"Custom"},
     *      consumes={"application/json"},
     *
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *      ),
     * )
     *
     * @Rest\Get("/product-list")
     * @return View
     */
    public function getProducts(): View
    {
        $products = $this->customService->getAllProducts();

        // In case our GET was a success we need to return a 200 HTTP OK
        return View::create($products, Response::HTTP_OK);
    }

    /**
     * Get list of products and total price of an order
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"Custom"},
     *      consumes={"application/json"},
     * 
     *      @SWG\Parameter(
     *          name="orderId",
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
     * @Rest\Get("/order-details/{orderId}")
     * @return View
     */
    public function getOrderDetails(int $orderId): View
    {
        $orderDetails = $this->customService->getOrderDetails($orderId);

        // In case our GET was a success we need to return a 200 HTTP OK
        return View::create($orderDetails, Response::HTTP_OK);
    }
}
