<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Layout;

use ColorlibHQ\AdminLteBundle\Menu\MenuItem;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Renders a single sidebar entry, recursing for submenus.
 *
 * Usage: `<twig:Adminlte:SidebarNavItem :item="item" />`
 */
#[AsTwigComponent(name: 'Adminlte:SidebarNavItem', template: '@AdminLte/components/layout/sidebar_nav_item.html.twig')]
final class SidebarNavItem
{
    public MenuItem $item;
}
