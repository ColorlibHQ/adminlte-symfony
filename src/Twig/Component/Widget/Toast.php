<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Bootstrap 5.3 toast. Body is the default slot.
 *
 * Usage: <twig:Adminlte:Toast title="AdminLTE" variant="primary" time="just now">Hello!</twig:Adminlte:Toast>
 */
#[AsTwigComponent(name: 'Adminlte:Toast', template: '@AdminLte/components/widget/toast.html.twig')]
final class Toast
{
    public ?string $title = null;

    /** Header background colour (text-bg-*), null = default. */
    public ?string $variant = null;
    public ?string $time = null;
    public bool $autohide = true;
    public int $delay = 5000;
}
