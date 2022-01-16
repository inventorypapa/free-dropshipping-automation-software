<?php

namespace App\Menu;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $menu->removeChild('customers');
        $menu->addChild('Returns',['route' => 'sylius_admin_rma_index']);
        $menu->getChild('Returns')->addChild('Returns',['route' => 'sylius_admin_rma_index']);
        $menu
            ->removeChild('marketing')
            ->getChild('configuration')
                ->removeChild('payment_methods')
                ->removeChild('shipping_methods')
                ->removeChild('shipping_categories')
                ->removeChild('tax_categories')
                ->removeChild('tax_rates')
                ->removeChild('exchange_rates')
                ->removeChild('zones')
        ;
        $menu->getChild('sales')->removeChild('payments')->removeChild('shipments');
        $menu->getChild('configuration')->addChild('pricemarkup',['route' => 'sylius_admin_pricemarkup_index'])
        ->setLabel('sylius.ui.pricemarkups')
        ->setLabelAttribute('icon', 'dollar')
;
        $menu->getChild('configuration')->addChild('track',['route' => 'app_admin_track_index'])
        ->setLabel('sylius.ui.track')
        ->setLabelAttribute('icon', 'shipping fast');
        $menu->reOrderChildren(['catalog','sales','Returns','configuration',]);
    }
}