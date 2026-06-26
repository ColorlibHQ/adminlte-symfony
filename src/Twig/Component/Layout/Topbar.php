<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Layout;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * The AdminLTE 4 `<nav class="app-header navbar">` topbar: sidebar toggle,
 * optional search, fullscreen + color-mode toggles, and a `user-menu` slot.
 *
 * Usage: `<twig:Adminlte:Topbar>...optional user menu...</twig:Adminlte:Topbar>`
 */
#[AsTwigComponent(name: 'Adminlte:Topbar', template: '@AdminLte/components/layout/topbar.html.twig')]
final class Topbar
{
}
