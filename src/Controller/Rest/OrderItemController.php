<?php

namespace App\Controller\Rest;


use App\Service\OrderItemService;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\OrderItem;

/**
 * Class OrderItemController
 * @package App\Controller\Rest
 */
final class OrderItemController extends AbstractFOSRestController
{
    /**
     * @var OrderItemService
     */
    private $orderItemService;

    /**
     * OrderItemController constructor.
     * @param OrderItemService $orderItemService
     */
    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    /**
     * Creates a OrderItem resource
     * @SWG\Post(
     *      produces={"application/json"},
     *      tags={"OrderItem"},
     *      consumes={"application/json"},
     *      produces={"application/json"},
     * 
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          format="application/json",
     *          description="Create a line item for a given order with product and quantity",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="order", type="integer", example=12),
     *              @SWG\Property(property="product", type="integer", example=12),
     *              @SWG\Property(property="count", type="integer", example=1)
     *           )
     *      ),
     * 
     *      @SWG\Response(
     *          response="201",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=OrderItem::class)
     *          )
     *      ),
     * 
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * 
     * @Rest\Post("/orderItems")
     * @param Request $request
     * @return View
     */
    public function createOrderItem(Request $request): View
    {
        $orderItem = $this->orderItemService->createOrderItem(
            $request->get('order'), 
            $request->get('product'), 
            $request->get('count')
        );


        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($orderItem, Response::HTTP_CREATED);
    }

    /**
     * Retrieves a OrderItem resource
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"OrderItem"},
     *      consumes={"application/json"},
     * 
     *      @SWG\Parameter(
     *          name="orderItemId",
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
     *              @Model(type=OrderItem::class)
     *          )
     *      ),
     * 
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * 
     * @Rest\Get("/orderItems/{orderItemId}")
     * @param int $orderItemId
     * @return View
     */
    public function getOrderItem(int $orderItemId): View
    {
        $orderItem = $this->orderItemService->getOrderItem($orderItemId);


        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($orderItem, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of OrderItem resource
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"OrderItem"},
     *      consumes={"application/json"},
     * 
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=OrderItem::class)
     *          )
     *      ),
     * 
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * 
     * @Rest\Get("/orderItems")
     * @return View
     */
    public function getOrderItems(): View
    {
        $orderItems = $this->orderItemService->getAllOrderItems();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of orderItem object
        return View::create($orderItems, Response::HTTP_OK);
    }

    /**
     * Replaces OrderItem resource
     * @SWG\Put(
     *      produces={"application/json"},
     *      tags={"OrderItem"},
     *      consumes={"application/json"},
     * 
     *      @SWG\Parameter(
     *          name="orderItemId",
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
     *          description="Update product count for a lineitem",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="count", type="integer", example=1)
     *           )
     *      ),
     * 
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=OrderItem::class)
     *          )
     *      ),
     * 
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * @Rest\Put("/orderItems/{orderItemId}")
     * @param int $orderItemId
     * @param Request $request
     * @return View
     */
    public function putOrderItem(int $orderItemId, Request $request): View
    {
        $orderItem = $this->orderItemService->updateOrderItem(
            $orderItemId, 
            $request->get('count')
        );


        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($orderItem, Response::HTTP_OK);
    }

    /**
     * Removes the OrderItem resource
     * @SWG\Delete(
     *      produces={"application/json"},
     *      tags={"OrderItem"},
     *      consumes={"application/json"},
     * 
     *      @SWG\Parameter(
     *          name="orderItemId",
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
     * @Rest\Delete("/orderItems/{orderItemId}")
     * @param int $orderItemId
     * @return View
     */
    public function deleteOrderItem(int $orderItemId): View
    {
        $this->orderItemService->deleteOrderItem($orderItemId);


        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
