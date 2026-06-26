<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * AdminLTE 4 small-box stat widget.
 *
 * Usage:
 *   <twig:Adminlte:SmallBox title="150" text="New orders" variant="primary"
 *       icon="bi bi-bag" url="/orders" />
 */
#[AsTwigComponent(name: 'Adminlte:SmallBox', template: '@AdminLte/components/widget/small_box.html.twig')]
final class SmallBox
{
    public string $title = '';
    public string $text = '';

    /** primary | secondary | success | info | warning | danger */
    public string $variant = 'primary';
    public ?string $icon = null;
    public ?string $url = null;
    public string $linkText = 'More info';
}
