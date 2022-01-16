<?php

namespace App\Entity;

use App\Repository\RmaRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
/**
 * @ORM\Entity(repositoryClass=RmaRepository::class)
 */
class Rma implements ResourceInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
