<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Order as BaseOrder;
use Sylius\Component\Order\Model\OrderInterface;
/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`sylius_order`")
 */
class Order extends  BaseOrder implements OrderInterface
{
    private $routedText = '';

    public function getRoutedText(): ?string  
    {
        $t = [];

        foreach($this->getItems() as $v){
            $routed = $v->getRouted();
            if($routed){
                $t[] = $v->getVariant()->getCode().' : '.$routed->getInventory()->getName();
            }
        }

        $this->routedText = implode('<br/>', $t);
        return  $this->routedText;
    }

    public function setRoutedText(?string  $routed)
    {
        $this->routedText = $routed;
        return $this;
    }
}
