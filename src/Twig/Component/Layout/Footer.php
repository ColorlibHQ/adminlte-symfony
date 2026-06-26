<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Layout;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * The AdminLTE 4 `<footer class="app-footer">`.
 *
 * Usage: `<twig:Adminlte:Footer />`
 */
#[AsTwigComponent(name: 'Adminlte:Footer', template: '@AdminLte/components/layout/footer.html.twig')]
final class Footer
{
}
