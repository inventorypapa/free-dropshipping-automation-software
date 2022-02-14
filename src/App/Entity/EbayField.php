<?php

namespace App\Entity;

use App\Repository\EbayFieldRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EbayFieldRepository::class)
 * @ORM\Table(name="ebayfield",uniqueConstraints={@ORM\UniqueConstraint(name="uniq_idx", fields={"ebayItemId", "ebayAccount"})})
 */
class EbayField
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="ebay_account")
     */
    private $ebayAccount;

    /**
     * @ORM\Column(type="string", length=255, name="ebay_item_id")
     */
    private $ebayItemId;

    /**
     * @ORM\Column(type="string", length=255, name="ebay_brand_name")
     */
    private $ebayBrandName;

    
    /**
     * @ORM\Column(type="integer", name="product_id")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer", name="variant_id")
     */
    private $variantId;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductVariant",inversedBy="ebayFields")
     * @ORM\JoinColumn(name="variant_id", nullable=false, referencedColumnName="id")
     */
    protected $variant;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="ebayFields")
     * @ORM\JoinColumn(name="product_id", nullable=false, referencedColumnName="id")
     */
    protected $product;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEbayAccount(): ?string
    {
        return $this->ebayAccount;
    }

    public function setEbayAccount(string $ebayAccount): self
    {
        $this->ebayAccount = $ebayAccount;

        return $this;
    }

    public function getEbayItemId(): ?string
    {
        return $this->ebayItemId;
    }

    public function setEbayItemId(string $ebayItemId): self
    {
        $this->ebayItemId = $ebayItemId;

        return $this;
    }

    public function getEbayBrandName(): ?string
    {
        return $this->ebayBrandName;
    }

    public function setEbayBrandName(string $ebayBrandName): self
    {
        $this->ebayBrandName = $ebayBrandName;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

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
}
