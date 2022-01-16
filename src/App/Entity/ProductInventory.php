<?php

namespace App\Entity;

use App\Repository\ProductInventoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @ORM\Entity(repositoryClass=ProductInventoryRepository::class)
 * @ORM\Table(name="product_inventory",uniqueConstraints={@ORM\UniqueConstraint(name="uniq_idx", fields={"productId", "inventoryId"})})
 */
class ProductInventory implements ResourceInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    protected $name;

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductVariant",inversedBy="inventories")
     * @ORM\JoinColumn(name="variant_id", nullable=false, referencedColumnName="id")
     */
    protected $variant;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="inventories")
     * @ORM\JoinColumn(name="product_id", nullable=false, referencedColumnName="id")
     */
    protected $product;
    
     /**
     * @ORM\Column(type="integer")
     * 
     */
    private $productId;

    /**
     * @ORM\Column(type="integer")
     * 
     */
    private $inventoryId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Inventory", cascade={"detach"}, fetch="EAGER")
     * @ORM\JoinColumn(name="inventory_id", referencedColumnName="id")
     */
    private $inventory;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotNull
     */
    private $cost;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * 
     */
    private $shipping;

    /**
     * @ORM\Column(type="integer")
     * 
     */
    private $onHand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sku;

    /**
     * @ORM\Column(type="integer", nullable="true")
     */
    private $variantId;

    public function getName()
    {
        return $this->getInventory()->getName();
    }
    public function setName($name)
    {
    }
    public function getCode()
    {
        return $this->getInventory()->getCode();
    }
    
    public function getTotalCost()
    {
        return $this->cost + $this->shipping;
    }

    public function setTotalCost($totalCost)
    {
        
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $this->productId;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost): self
    {
        $this->cost = $cost;
 
        return $this;
    }

    public function getShipping(): ?float
    {
        return $this->shipping;
    }

    public function setShipping(?float $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getOnHand()
    {
        return $this->onHand;
    }

    public function setOnHand($onHand): self
    {
        $this->onHand = $onHand;

        return $this;
    }

    public function getInventoryId(): ?int
    {
        return $this->inventoryId;
    }

    public function setInventoryId(int $inventoryId): self
    {
        $this->inventoryId = $inventoryId;

        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory(?Inventory $inventory): self
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function setProductVariant($variant)
    {
        $this->variant = $variant;
        return $this;
    }

    public function getProductVariant()
    {
        return $this->variant;
    }

    public function setProduct($variant)
    {
        $this->product = $variant;
        return $this;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getVariantId(): ?int
    {
        return $this->variantId;
    }

    public function setVariantId(int $variantId): self
    {
        $this->variantId = $variantId;

        return $this;
    }
}
