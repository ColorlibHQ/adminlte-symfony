<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * AdminLTE 4 / Bootstrap 5.3 alert.
 *
 * Usage:
 *   <twig:Adminlte:Alert variant="success" icon="bi bi-check-circle" title="Saved!" dismissible>
 *       Your changes were stored.
 *   </twig:Adminlte:Alert>
 */
#[AsTwigComponent(name: 'Adminlte:Alert', template: '@AdminLte/components/widget/alert.html.twig')]
final class Alert
{
    /** primary | secondary | success | info | warning | danger | light | dark */
    public string $variant = 'info';
    public ?string $title = null;
    public ?string $icon = null;
    public bool $dismissible = false;
}
