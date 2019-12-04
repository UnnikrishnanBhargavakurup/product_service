<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderItemRepository")
 */
class OrderItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Orders", inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $_order;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $products;

    /**
     * @ORM\Column(type="smallint")
     */
    private $count;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrder(): ?self
    {
        return $this->_order;
    }

    public function setOrder(?self $_order): self
    {
        $this->_order = $_order;

        return $this;
    }

    public function getProducts(): ?Product
    {
        return $this->products;
    }

    public function setProducts(?Product $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }
}
