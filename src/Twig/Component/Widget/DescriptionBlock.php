<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * AdminLTE 4 description-block (stat with trend arrow), typically used in a
 * card footer row.
 *
 * Usage: <twig:Adminlte:DescriptionBlock header="$35,210.43" text="Total Revenue" percentage="17%" trend="up" />
 */
#[AsTwigComponent(name: 'Adminlte:DescriptionBlock', template: '@AdminLte/components/widget/description_block.html.twig')]
final class DescriptionBlock
{
    public string $header = '';
    public ?string $text = null;
    public ?string $percentage = null;

    /** up | down */
    public string $trend = 'up';

    /** Overrides the trend colour (success/danger by default). */
    public ?string $trendVariant = null;

    public function trendClass(): string
    {
        return 'text-'.($this->trendVariant ?? ('up' === $this->trend ? 'success' : 'danger'));
    }

    public function trendIcon(): string
    {
        return 'up' === $this->trend ? 'bi-caret-up-fill' : 'bi-caret-down-fill';
    }
}
