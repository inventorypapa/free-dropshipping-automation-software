<?php

namespace App\Entity;

use App\Repository\AmazonFieldRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AmazonFieldRepository::class)
 * @ORM\Table(name="amazonfield",uniqueConstraints={@ORM\UniqueConstraint(name="uniq_idx", fields={"amazonAccount", "amazonSku"})})
 */
class AmazonField
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $amazonAccount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $amazonSku;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $asin;

    /**
     * @ORM\Column(type="integer")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer")
     */
    private $variantId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductVariant",inversedBy="amazonFields")
     * @ORM\JoinColumn(name="variant_id", nullable=false, referencedColumnName="id")
     */
    protected $variant;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="amazonFields")
     * @ORM\JoinColumn(name="product_id", nullable=false, referencedColumnName="id")
     */
    protected $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmazonAccount(): ?string
    {
        return $this->amazonAccount;
    }

    public function setAmazonAccount(string $amazonAccount): self
    {
        $this->amazonAccount = $amazonAccount;

        return $this;
    }

    public function getAmazonSku(): ?string
    {
        return $this->amazonSku;
    }

    public function setAmazonSku(string $amazonSku): self
    {
        $this->amazonSku = $amazonSku;

        return $this;
    }

    public function getAsin(): ?string
    {
        return $this->asin;
    }

    public function setAsin(string $asin): self
    {
        $this->asin = $asin;

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
