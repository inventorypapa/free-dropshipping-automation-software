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

    /**
     * @ORM\OneToMany(targetEntity="\App\Entity\EbayField", mappedBy="product",cascade={"all"})
     */
    protected $ebayFields;

    /**
     * @ORM\OneToMany(targetEntity="\App\Entity\AmazonField", mappedBy="product",cascade={"all"})
     */
    protected $amazonFields;

    public function __construct()
    {
        parent::__construct();
        $this->inventories = new ArrayCollection;
    }

    public function getInventories(): ?Collection
    {
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

    public function getEbayFields(): ?Collection
    {
        return $this->ebayFields;
    }

    public function setEbayFields(?Collection $ebayFields): self
    {
        
        $this->EbayField = $ebayFields;

        return $this;
    }
    public function addEbayField(EbayField $ebayField): void
    {
        if (!$this->hasEbayField($ebayField)) {
            $this->ebayFields->add($ebayField);
            $ebayField->setProductVariant($this);
            $ebayField->setProduct($this->getProduct());
        }
    }

    public function removeEbayField(EbayField $ebayField): void
    {
        if ($this->hasEbayField($ebayField)) {
            $ebayField->setProductVariant(null);
            $this->ebayFields->removeElement($ebayField);
        }
    }

    public function hasEbayField(EbayField $ebayField): bool
    {
        return $this->ebayFields->contains($ebayField);
    }

    public function getAmazonFields(): ?Collection
    {
        return $this->amazonFields;
    }

    public function setAmazonFields(?Collection $amazonFields): self
    {
        
        $this->AmazonFields = $amazonFields;

        return $this;
    }
    public function addAmazonField(AmazonField $amazonField): void
    {
        if (!$this->hasAmazonField($amazonField)) {
            $this->amazonFields->add($amazonField);
            $amazonField->setProductVariant($this);
            $amazonField->setProduct($this->getProduct());
        }
    }

    public function removeAmazonField(AmazonField $amazonField): void
    {
        if ($this->hasAmazonField($amazonField)) {
            $amazonField->setProductVariant(null);
            $this->amazonFields->removeElement($amazonField);
        }
    }

    public function hasAmazonField(AmazonField $amazonField): bool
    {
        return $this->amazonFields->contains($amazonField);
    }
}