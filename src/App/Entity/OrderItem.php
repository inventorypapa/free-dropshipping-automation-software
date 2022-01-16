<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\OrderItem as BaseOrderItem;
use Sylius\Component\Order\Model\OrderItemInterface;
/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 * @ORM\Table(name="sylius_order_item")
 */
class OrderItem extends  BaseOrderItem implements OrderItemInterface
{

    /**
     * @ORM\OneToOne(targetEntity="\App\Entity\OrderRouted", cascade={"detach"}, fetch="LAZY",mappedBy="orderItem")
     */
    private $routed;

    /**
     * @ORM\OneToOne(targetEntity="\App\Entity\OrderItemReconcile", cascade={"detach"}, fetch="LAZY",mappedBy="orderItem")
     */
    private $reconcile;

    /**
     * @ORM\OneToOne(targetEntity="\App\Entity\OrderTrack", cascade={"detach"}, fetch="LAZY",mappedBy="orderItem")
     */
    private $track;

    public function getTrack(): ?\App\Entity\OrderTrack
    {
        return $this->track;
    }

    public function setTrack(?\App\Entity\OrderTrack  $track)
    {
        $this->track = $track;
        return $this;
    }

    public function getReconcile(): ?\App\Entity\OrderItemReconcile
    {
        return $this->reconcile;
         
    }

    public function setReconcile(?\App\Entity\OrderItemReconcile  $reconcile)
    {
        $this->reconcile = $reconcile;
        return $this;
    }

    public function getRouted(): ?\App\Entity\OrderRouted  
    {
        return $this->routed;
    }

    public function setRouted(?\App\Entity\OrderRouted  $routed)
    {
        $this->routed = $routed;
        return $this;
    }

}
