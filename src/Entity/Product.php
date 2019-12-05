<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * Many child products can have many parent products.
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="child_products")
     */
    private $parent_products;

    /**
     * Many parent products can have many child products.
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="parent_products")
     * @ORM\JoinTable(name="product_bundle",
     *      joinColumns={@ORM\JoinColumn(name="parent_product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="child_product_id", referencedColumnName="id")}
     * )
     */
    private $child_products;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="products")
     */
    private $offer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    public function __construct() {
        $this->parent_products = new ArrayCollection();
        $this->child_products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Product[]
     */
    public function getParentProducts(): Collection
    {
        return $this->parent_products;
    }
    
    public function addParentProduct(Product $parentProduct): self
    {
        if (!$this->parent_products->contains($parentProduct)) {
            $this->parent_products[] = $parentProduct;
            $parentProduct->addChildProduct($this);
        }

        return $this;
    }

    public function removeParentProduct(Product $parentProduct): self
    {
        if ($this->parent_products->contains($parentProduct)) {
            $this->parent_products->removeElement($parentProduct);
            $parentProduct->removeChildProduct($this);
        }

        return $this;
    }

    /**
     * @return Product[]
     */
    public function getChildProducts(): Collection
    {
        return $this->child_products;
    }

    public function addChildProduct(Product $childProduct): self
    {
        if (!$this->child_products->contains($childProduct)) {
            $this->child_products[] = $childProduct;
        }

        return $this;
    }

    public function removeChildProduct(Product $childProduct): self
    {
        if ($this->child_products->contains($childProduct)) {
            $this->child_products->removeElement($childProduct);
        }

        return $this;
    }
    
    public function __toString() {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }
}
