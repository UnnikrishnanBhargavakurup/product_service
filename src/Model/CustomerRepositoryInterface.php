<?php

namespace App\Model;

use App\Entity\Customer;
 
/**
 * Interface CustomerRepositoryInterface
 * @package App\Entity\Customer
 */
interface CustomerRepositoryInterface
{

    /**
     * @param int $CustomerId
     * @return Customer
     */
    public function findById(int $CustomerId): ?Customer;

    /**
     * @return array
     */
    public function _findAll(): array;

    /**
     * @param Customer $Customer
     */
    public function save(Customer $Customer): void;

    /**
     * @param Customer $Customer
     */
    public function delete(Customer $Customer): void;

}
