<?php

namespace App\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;

final class AdminProductFormMenuListener
{
    public function addItems(ProductMenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $all = ['details','taxonomy','attributes','associations','media'];
        if($menu->offsetExists('inventory')){
            array_unshift($all, 'inventory');
        }
        $menu->reorderChildren($all);
    }
}