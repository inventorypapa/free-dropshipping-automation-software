<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Bundle\ShopBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

if(php_sapi_name() != 'cli' and ! strstr($_SERVER['REQUEST_URI'], '/admin')){
    header('Location:/admin');
    exit;
}

final class SyliusShopBundle extends Bundle
{
}
