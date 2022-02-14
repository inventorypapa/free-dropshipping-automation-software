<?php

namespace App\Entity;

use App\Repository\OrderTrackRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderTrackRepository::class)
 * @ORM\Table(name="order_track",uniqueConstraints={@ORM\UniqueConstraint(name="uniq_idx", fields={"orderItemId", "trackId"})})
 */
class OrderTrack
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderItemId;

    /**
     * @ORM\Column(type="integer")
     */
    private $trackId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tracknum;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\OrderItem", cascade={"detach"}, fetch="LAZY", inversedBy="track")
     * @ORM\JoinColumn(name="order_item_id", referencedColumnName="id")
     */
    private $orderItem;

    /**
     *@ORM\ManyToOne(targetEntity="App\Entity\Track", cascade={"detach"}, fetch="LAZY") 
     * @ORM\JoinColumn(name="track_id", referencedColumnName="id")
     */
    private $track;

    public function getOrderItem(): ?\App\Entity\OrderItem
    {
        return $this->orderItem;
    }

    public function setOrderItem(?\App\Entity\OrderItem $item)
    {
        $this->orderItem = $item;
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

    public function getTrackId(): ?int
    {
        return $this->trackId;
    }

    public function setTrackId(int $trackId): self
    {
        $this->trackId = $trackId;

        return $this;
    }

    public function getTracknum(): ?string
    {
        return $this->tracknum;
    }

    public function setTracknum(string $tracknum): self
    {
        $this->tracknum = $tracknum;

        return $this;
    }
    public function getTrack(): ?\App\Entity\Track
    {
        return $this->track;
    }

    public function setTrack(\App\Entity\Track $track): self
    {
        $this->track = $track;

        return $this;
    }
}
