<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductInterface;
use App\Entity\ProductInventory;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="sylius_product")
 */ 
class Product extends BaseProduct implements ProductInterface
{
    /**
     * @ORM\OneToMany(targetEntity="\App\Entity\ProductInventory", mappedBy="product",cascade={"all"})
     */
    protected $inventories;

    public function __construct()
    {
        parent::__construct();
        $this->inventories = new ArrayCollection;
    }

    public function getInventories(): ?Collection
    {
        //var_dump($this->inventories);exit;
        return $this->inventories;
    }

    public function setInventories(?Collection $inventories): self
    {
        
        $this->inventories = $inventories;

        return $this;
    }
    public function addInventory(ProductInventory $inventory): void
    {
        if (!$this->hasInventory($inventory)) {
            $this->inventories->add($inventory);
            $inventory->setProduct($this);
        }
    }

    public function removeInventory(ProductInventory $inventory): void
    {
        if ($this->hasInventory($inventory)) {
            $inventory->setProduct(null);
            $this->inventories->removeElement($inventory);
        }
    }

    public function hasInventory(ProductInventory $inventory): bool
    {
        return $this->inventories->contains($inventory);
    }
}