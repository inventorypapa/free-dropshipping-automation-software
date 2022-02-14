<?php

namespace App\Entity;

use App\Repository\OrderRoutedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRoutedRepository::class)
 * @ORM\Table(name="order_routed",uniqueConstraints={@ORM\UniqueConstraint(name="uniq_idx", fields={"orderItemId"})})
 */
class OrderRouted
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
     * @ORM\Column(type="integer")
     */
    private $inventoryId;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Mapping\Annotation\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sent;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $received;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $invoiceId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Inventory", cascade={"detach"}, fetch="LAZY")
     * @ORM\JoinColumn(name="inventory_id", referencedColumnName="id")
     */
    private $inventory;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\OrderItem", cascade={"detach"}, fetch="LAZY", inversedBy="routed")
     * @ORM\JoinColumn(name="order_item_id", referencedColumnName="id")
     */
    private $orderItem;

    public function getOrderItem(): ?\App\Entity\OrderItem
    {
        return $this->orderItem;
    }

    public function setOrderItem(?\App\Entity\OrderItem $item)
    {
        $this->orderItem = $item;
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

    public function getId(): ?int
    {
        return $this->id;
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

    public function getInventoryId(): ?int
    {
        return $this->inventoryId;
    }

    public function setInventoryId(int $inventoryId): self
    {
        $this->inventoryId = $inventoryId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSent(): ?string
    {
        return $this->sent;
    }

    public function setSent(?string $sent): self
    {
        $this->sent = $sent;

        return $this;
    }

    public function getReceived(): ?string
    {
        return $this->received;
    }

    public function setReceived(?string $received): self
    {
        $this->received = $received;

        return $this;
    }

    public function getInvoiceId(): ?string
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(?string $invoiceId): self
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }
}
