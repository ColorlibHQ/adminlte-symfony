<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * A single accordion item. Body is the default slot.
 */
#[AsTwigComponent(name: 'Adminlte:AccordionItem', template: '@AdminLte/components/widget/accordion_item.html.twig')]
final class AccordionItem
{
    public string $id;
    public string $title = '';

    /** Parent accordion id; enables single-open (`data-bs-parent`) behaviour. */
    public ?string $parent = null;
    public bool $open = false;
}
