<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Layout;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * A light/dark toggle button. Pairs with the SSR-safe init script in
 * `@AdminLte/components/layout/_color_mode_script.html.twig`, which is included
 * once in the document `<head>` and exposes `window.adminlteToggleColorMode()`.
 *
 * Usage: `<twig:Adminlte:ColorModeToggle />`
 */
#[AsTwigComponent(name: 'Adminlte:ColorModeToggle', template: '@AdminLte/components/layout/color_mode_toggle.html.twig')]
final class ColorModeToggle
{
}
