<?php

namespace App\Controller\Rest;


use App\Service\OrderService;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\Orders;

/**
 * Class OrderController
 * @package App\Controller\Rest
 */
final class OrderController extends AbstractFOSRestController
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Creates a Order resource
     * @SWG\Post(
     *      produces={"application/json"},
     *      tags={"Order"},
     *      consumes={"application/json"},
     * 
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          format="application/json",
     *          description="Create a new order for a customer",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="customer_id", type="integer", example=8)
     *           )
     *      ),
     * 
     *      @SWG\Response(
     *          response="201",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Orders::class)
     *          )
     *      ),
     * 
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * 
     * @Rest\Post("/orders")
     * @param Request $request
     * @return View
     */
    public function createOrder(Request $request): View
    {
        $order = $this->orderService->createOrder(
            $request->get('customer_id')
        );


        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($order, Response::HTTP_CREATED);
    }

    /**
     * Retrieves a Order resource
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"Order"},
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
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Orders::class)
     *          )
     *      ),
     * 
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * 
     * @Rest\Get("/orders/{orderId}")
     * @param int $orderId
     * @return View
     */
    public function getOrder(int $orderId): View
    {
        $order = $this->orderService->getOrder($orderId);


        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($order, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Order resource
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"Order"},
     *      consumes={"application/json"},
     * 
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Orders::class)
     *          )
     *      ),
     * 
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * 
     * @Rest\Get("/orders")
     * @return View
     */
    public function getOrders(): View
    {
        $orders = $this->orderService->getAllOrders();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of order object
        return View::create($orders, Response::HTTP_OK);
    }

    /**
     * Replaces Order resource
     * @SWG\Put(
     *      produces={"application/json"},
     *      tags={"Order"},
     *      consumes={"application/json"},
     * 
     *      @SWG\Parameter(
     *          name="orderId",
     *          in="path",
     *          type="integer",
     *          required=true,
     *      ),
     * 
     *      @SWG\Parameter(
     *          name="status",
     *          in="body",
     *          required=true,
     *          enum={"new", "in_checkout", "on_hold", "closed", "shipped", "delivered", "returned", "canceled"},
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="status", 
     *                  type="string", 
     *                  example="in_checkout"
     *              )
     *          )
     *      ),
     * 
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Orders::class)
     *          )
     *      ),
     * 
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * @Rest\Put("/orders/{orderId}")
     * @param int $orderId
     * @param Request $request
     * @return View
     */
    public function putOrder(int $orderId, Request $request): View
    {
        $order = $this->orderService->updateOrder(
            $orderId, 
            $request->get('status')
        );


        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($order, Response::HTTP_OK);
    }

    /**
     * Removes an Order resource
     * @SWG\Delete(
     *      produces={"application/json"},
     *      tags={"Order"},
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
     * 
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * 
     * @Rest\Delete("/orders/{orderId}")
     * @param int $orderId
     * @return View
     */
    public function deleteOrder(int $orderId): View
    {
        $this->orderService->deleteOrder($orderId);


        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
