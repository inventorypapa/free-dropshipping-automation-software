<?php

namespace App\Entity;

use App\Repository\PriceMarkupRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
/**
 * @ORM\Entity(repositoryClass=PriceMarkupRepository::class)
 */
class PriceMarkup implements  ResourceInterface
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
    private $channelId;

    /**
     * @ORM\OneToOne(targetEntity="\Sylius\Component\Channel\Model\Channel", cascade={"detach"},fetch="LAZY")
     * @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
     */
    private $channel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $formula;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChannelId(): ?int
    {
        return $this->channelId;
    }

    public function setChannelId(int $channelId): self
    {
        $this->channelId = $channelId;

        return $this;
    }
    public function setChannel(\Sylius\Component\Channel\Model\Channel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getChannel(): \Sylius\Component\Channel\Model\Channel
    {
        return $this->channel;
    }
    public function getFormula(): ?string
    {
        return $this->formula;
    }

    public function setFormula(string $formula): self
    {
        $this->formula = $formula;

        return $this;
    }


}
