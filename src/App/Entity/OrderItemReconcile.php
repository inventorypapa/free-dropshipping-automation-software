<?php

namespace App\Entity;

use App\Repository\OrderItemReconcileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderItemReconcileRepository::class)
 */
class OrderItemReconcile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer",name="order_item_id")
     */
    private $orderItemId;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     */
    private $real_cost;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     */
    private $real_shipping;

    /**
     * @ORM\OnetoOne(targetEntity="\App\Entity\OrderItem",cascade={"detach"},fetch="LAZY", inversedBy="reconcile")
     * @ORM\JoinColumn(name="order_item_id", referencedColumnName="id")
     */
    private $orderItem;

    public function setOrderItem(\App\Entity\OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;

        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id)
    {
        $this->id = $id;
        return $this;
    }
    public function getOrderItemId(): ?int
    {
        return $this->orderItemId;
    }

    public function setOrderItemId(int $orderItemId): self
    {
        $this->orderItemId = $orderItemId;

        return $this;
    }

    public function getRealCost(): ?float
    {
        return $this->real_cost;
    }

    public function setRealCost(float $real_cost): self
    {
        $this->real_cost = $real_cost / 100;

        return $this;
    }

    public function getRealShipping(): ?float
    {
        return $this->real_shipping;
    }

    public function setRealShipping(float $real_shipping): self
    {
        $this->real_shipping = $real_shipping / 100;

        return $this;
    }
}
