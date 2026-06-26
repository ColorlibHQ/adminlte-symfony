<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Bootstrap 5.3 breadcrumb.
 *
 * Usage:
 *   <twig:Adminlte:Breadcrumb align="float-sm-end" :items="[
 *       { label: 'Home', url: '/' },
 *       { label: 'Dashboard', active: true },
 *   ]" />
 */
#[AsTwigComponent(name: 'Adminlte:Breadcrumb', template: '@AdminLte/components/widget/breadcrumb.html.twig')]
final class Breadcrumb
{
    /** @var list<array{label: string, url?: string, active?: bool}> */
    public array $items = [];

    /** Optional float utility, e.g. "float-sm-end". */
    public ?string $align = null;
}
