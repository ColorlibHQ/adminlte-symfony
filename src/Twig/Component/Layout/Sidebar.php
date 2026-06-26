<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Layout;

use ColorlibHQ\AdminLteBundle\Config\AdminLteConfig;
use ColorlibHQ\AdminLteBundle\Menu\MenuBuilder;
use ColorlibHQ\AdminLteBundle\Menu\MenuItem;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * The AdminLTE 4 `<aside class="app-sidebar">` shell: brand + config-driven nav.
 *
 * Usage: `<twig:Adminlte:Sidebar />`
 */
#[AsTwigComponent(name: 'Adminlte:Sidebar', template: '@AdminLte/components/layout/sidebar.html.twig')]
final class Sidebar
{
    public function __construct(
        private readonly MenuBuilder $menuBuilder,
        private readonly AdminLteConfig $config,
    ) {
    }

    /**
     * @return list<MenuItem>
     */
    public function getItems(): array
    {
        return $this->menuBuilder->build();
    }

    public function getConfig(): AdminLteConfig
    {
        return $this->config;
    }
}
