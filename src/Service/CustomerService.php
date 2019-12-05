<?php

namespace App\Service;


use App\Entity\Customer;
use App\Model\CustomerRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class CustomerService
 * @package App\Service
 */
final class CustomerService
{

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * CustomerService constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository){
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param int $customerId
     * @return Customer
     * @throws EntityNotFoundException
     */
    public function getCustomer(int $customerId): Customer
    {
        $customer = $this->customerRepository->findById($customerId);
        if (!$customer) {
            throw new EntityNotFoundException('Customer with id '. $customerId .' does not exist!');
        }

        return $customer;
    }

    /**
     * @return array|null
     */
    public function getAllCustomers(): ?array
    {
        return $this->customerRepository->_findAll();
    }

    /**
     * @param string $name
     * @param string $street
     * @param string $city
     * @param string $phone
     * @return Customer
     */
    public function createCustomer(
        string $name, 
        string $street, 
        string $city, 
        string $phone): Customer
    {
        $customer = new Customer();
        $customer->setName($name);
        $customer->setStreet($street);
        $customer->setCity($city);
        $customer->setPhone($phone);
        $this->customerRepository->save($customer);

        return $customer;
    }

    /**
     * @param int $customerId
     * @param string $title
     * @param string $content
     * @return Customer
     * @throws EntityNotFoundException
     */
    public function updateCustomer(
        int $customerId, 
        string $name, 
        string $street, 
        string $city, 
        string $phone): Customer
    {
        $customer = $this->customerRepository->findById($customerId);
        if (!$customer) {
            throw new EntityNotFoundException('Customer with id '. $customerId .' does not exist!');
        }

        $customer->setName($name);
        $customer->setStreet($street);
        $customer->setCity($city);
        $customer->setPhone($phone);
        $this->customerRepository->save($customer);

        return $customer;
    }

    /**
     * @param int $customerId
     * @throws EntityNotFoundException
     */
    public function deleteCustomer(int $customerId): void
    {
        $customer = $this->customerRepository->findById($customerId);
        if (!$customer) {
            throw new EntityNotFoundException('Customer with id '.$customerId.' does not exist!');
        }

        $this->customerRepository->delete($customer);
    }

}
