<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * A single timeline entry. Set `label` to render a time-label badge instead of
 * a full item.
 *
 * Usage:
 *   <twig:Adminlte:TimelineItem icon="bi bi-envelope" variant="info" time="12:05" header="New mail">
 *       Body text…
 *   </twig:Adminlte:TimelineItem>
 */
#[AsTwigComponent(name: 'Adminlte:TimelineItem', template: '@AdminLte/components/widget/timeline_item.html.twig')]
final class TimelineItem
{
    public string $icon = 'bi bi-circle-fill';

    /** primary | secondary | success | info | warning | danger */
    public string $variant = 'primary';
    public ?string $time = null;
    public ?string $header = null;

    /** When set, renders a time-label badge rather than an item. */
    public ?string $label = null;
}
