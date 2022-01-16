<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductVariant as BaseProductVariant;
use Sylius\Component\Product\Model\ProductVariantInterface;
use App\Entity\ProductInventory;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="sylius_product_variant")
 */ 
class ProductVariant extends BaseProductVariant implements ProductVariantInterface
{

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
            $inventory->setProductVariant($this);
            $inventory->setProduct($this->getProduct());
        }
    }

    public function removeInventory(ProductInventory $inventory): void
    {
        if ($this->hasInventory($inventory)) {
            $inventory->setProductVariant(null);
            $this->inventories->removeElement($inventory);
        }
    }

    public function hasInventory(ProductInventory $inventory): bool
    {
        return $this->inventories->contains($inventory);
    }
}