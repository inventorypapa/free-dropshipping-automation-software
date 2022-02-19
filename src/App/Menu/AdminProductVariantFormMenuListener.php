<?php

namespace App\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductVariantMenuBuilderEvent;

final class AdminProductVariantFormMenuListener
{
    public function addItems(ProductVariantMenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $menu->addChild('ebayfields') 
        ->setAttribute('template', '@SyliusAdmin/ProductVariant/Tab/_ebayfields.html.twig')
        ->setLabel('sylius.ui.ebayfields');
        $menu->reorderChildren(['inventory','ebayfields','details','taxes']);
    }
}