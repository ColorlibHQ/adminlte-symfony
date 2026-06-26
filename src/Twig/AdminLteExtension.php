<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig;

use ColorlibHQ\AdminLteBundle\Config\AdminLteConfig;
use ColorlibHQ\AdminLteBundle\Menu\MenuBuilder;
use ColorlibHQ\AdminLteBundle\Menu\MenuItem;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

/**
 * Exposes the bundle to Twig:
 *  - `adminlte`            global  → {@see AdminLteConfig}
 *  - `adminlte_menu()`     function → list<MenuItem> for the current request
 */
final class AdminLteExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(
        private readonly AdminLteConfig $config,
        private readonly MenuBuilder $menuBuilder,
    ) {
    }

    /**
     * @return array<string, AdminLteConfig>
     */
    public function getGlobals(): array
    {
        return ['adminlte' => $this->config];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('adminlte_menu', $this->buildMenu(...)),
        ];
    }

    /**
     * @return list<MenuItem>
     */
    public function buildMenu(): array
    {
        return $this->menuBuilder->build();
    }
}
