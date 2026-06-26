<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * AdminLTE 4 info-box widget (icon + label + number, optional progress).
 *
 * Usage:
 *   <twig:Adminlte:InfoBox text="Bookmarks" number="41,410" icon="bi bi-bookmark"
 *       variant="info" :progress="70" progressText="70% increase in 30 days" />
 */
#[AsTwigComponent(name: 'Adminlte:InfoBox', template: '@AdminLte/components/widget/info_box.html.twig')]
final class InfoBox
{
    public string $text = '';
    public string $number = '';
    public ?string $icon = null;

    /** primary | secondary | success | info | warning | danger */
    public string $variant = 'primary';
    public ?int $progress = null;
    public ?string $progressText = null;
}
