<?php

namespace App\Controller\Rest;

use App\Entity\Customer;
use App\Service\CustomerService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CustomerController
 * @package App\Controller\Rest
 */
final class CustomerController extends AbstractFOSRestController
{
    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * CustomerController constructor.
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Creates a Customer resource
     * @SWG\Post(
     *      produces={"application/json"},
     *      tags={"Customer"},
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
     *              @SWG\Property(property="name", type="string", example="Hugues Bureau"),
     *              @SWG\Property(property="street", type="string", example="64, rue Reine Elisabeth"),
     *              @SWG\Property(property="city", type="string", example="48000 MENDE"),
     *              @SWG\Property(property="phone", type="string", example="04.62.86.54.80")
     *           )
     *      ),
     *
     *      @SWG\Response(
     *          response="201",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Customer::class)
     *          )
     *      ),
     *
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     *
     * @Rest\Post("/customers")
     * @param Request $request
     * @return View
     */
    public function createCustomer(Request $request): View
    {
        $customer = $this->customerService->createCustomer(
            $request->get('name'),
            $request->get('street'),
            $request->get('city'),
            $request->get('phone')
        );

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($customer, Response::HTTP_CREATED);
    }

    /**
     * Retrieves a Customer resource
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"Customer"},
     *      consumes={"application/json"},
     *
     *      @SWG\Parameter(
     *          name="customerId",
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
     *              @Model(type=Customer::class)
     *          )
     *      ),
     *
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     *
     * @Rest\Get("/customers/{customerId}")
     * @param int $customerId
     * @return View
     */
    public function getCustomer(int $customerId): View
    {
        $customer = $this->customerService->getCustomer($customerId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($customer, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Customer resource
     * @SWG\Get(
     *      produces={"application/json"},
     *      tags={"Customer"},
     *      consumes={"application/json"},
     *
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Customer::class)
     *          )
     *      ),
     *
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     *
     * @Rest\Get("/customers")
     * @return View
     */
    public function getCustomers(): View
    {
        $customers = $this->customerService->getAllCustomers();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of customer object
        return View::create($customers, Response::HTTP_OK);
    }

    /**
     * Replaces Customer resource
     * @SWG\Put(
     *      produces={"application/json"},
     *      tags={"Customer"},
     *      consumes={"application/json"},
     *
     *      @SWG\Parameter(
     *          name="customerId",
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
     *              @SWG\Property(property="name", type="string", example="Hugues Bureau"),
     *              @SWG\Property(property="street", type="string", example="64, rue Reine Elisabeth"),
     *              @SWG\Property(property="city", type="string", example="48000 MENDE"),
     *              @SWG\Property(property="phone", type="string", example="04.62.86.54.80")
     *           )
     *      ),
     *
     *      @SWG\Response(
     *          response="200",
     *          description="Success",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Customer::class)
     *          )
     *      ),
     *
     *      @SWG\Response(
     *          response="500",
     *           description="Internal Server Error"
     *      ),
     * )
     * @Rest\Put("/customers/{customerId}")
     * @param int $customerId
     * @param Request $request
     * @return View
     */
    public function putCustomer(int $customerId, Request $request): View
    {
        $customer = $this->customerService->updateCustomer(
            $customerId,
            $request->get('name'),
            $request->get('street'),
            $request->get('city'),
            $request->get('phone')
        );

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($customer, Response::HTTP_OK);
    }

    /**
     * Removes the Customer resource
     * @SWG\Delete(
     *      produces={"application/json"},
     *      tags={"Customer"},
     *      consumes={"application/json"},
     *
     *      @SWG\Parameter(
     *          name="customerId",
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
     * @Rest\Delete("/customers/{customerId}")
     * @param int $customerId
     * @return View
     */
    public function deleteCustomer(int $customerId): View
    {
        $this->customerService->deleteCustomer($customerId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
