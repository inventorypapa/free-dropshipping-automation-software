<?php

namespace App\Entity;

use App\Repository\InventoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @ORM\Entity(repositoryClass=InventoryRepository::class)
 *  @ORM\Table(name="inventory")
 */
class Inventory implements ResourceInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name",type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="code",type="string", length=128)
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
	    
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

}
