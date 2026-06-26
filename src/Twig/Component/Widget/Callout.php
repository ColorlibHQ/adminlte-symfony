<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * AdminLTE 4 callout.
 *
 * Usage: <twig:Adminlte:Callout variant="warning" title="Heads up">…</twig:Adminlte:Callout>
 */
#[AsTwigComponent(name: 'Adminlte:Callout', template: '@AdminLte/components/widget/callout.html.twig')]
final class Callout
{
    /** info | success | warning | danger */
    public string $variant = 'info';
    public ?string $title = null;
}
