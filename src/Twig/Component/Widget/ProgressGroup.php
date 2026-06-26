<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * AdminLTE 4 progress-group (label + fraction + thin bar).
 *
 * Usage: <twig:Adminlte:ProgressGroup label="Add Products to Cart" :current="160" :total="200" variant="primary" />
 */
#[AsTwigComponent(name: 'Adminlte:ProgressGroup', template: '@AdminLte/components/widget/progress_group.html.twig')]
final class ProgressGroup
{
    public string $label = '';
    public int $current = 0;
    public int $total = 100;

    /** primary | secondary | success | info | warning | danger */
    public string $variant = 'primary';

    public function percent(): int
    {
        if ($this->total <= 0) {
            return 0;
        }

        return (int) round(min($this->current, $this->total) / $this->total * 100);
    }
}
