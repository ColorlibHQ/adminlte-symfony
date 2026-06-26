<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * AdminLTE 4 card.
 *
 * Usage:
 *   <twig:Adminlte:Card title="Traffic" icon="bi bi-graph-up" variant="primary" collapsible>
 *       ...body...
 *   </twig:Adminlte:Card>
 */
#[AsTwigComponent(name: 'Adminlte:Card', template: '@AdminLte/components/widget/card.html.twig')]
final class Card
{
    public ?string $title = null;
    public ?string $icon = null;

    /** primary | secondary | success | info | warning | danger | null */
    public ?string $variant = null;
    public bool $outline = false;
    public bool $collapsible = false;
    public bool $removable = false;
    public bool $collapsed = false;
    public ?string $footer = null;
    public ?string $bodyClass = null;

    public function cardClass(): string
    {
        $classes = ['card'];

        if (null !== $this->variant && '' !== $this->variant) {
            $classes[] = 'card-'.$this->variant;
            if ($this->outline) {
                $classes[] = 'card-outline';
            }
        }

        if ($this->collapsed) {
            $classes[] = 'collapsed-card';
        }

        return implode(' ', $classes);
    }
}
