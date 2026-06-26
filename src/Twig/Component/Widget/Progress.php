<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Bootstrap 5.3 progress bar.
 *
 * Usage: <twig:Adminlte:Progress :value="70" variant="success" striped animated showLabel />
 */
#[AsTwigComponent(name: 'Adminlte:Progress', template: '@AdminLte/components/widget/progress.html.twig')]
final class Progress
{
    public int $value = 0;

    /** primary | secondary | success | info | warning | danger */
    public string $variant = 'primary';
    public ?string $height = null;
    public bool $striped = false;
    public bool $animated = false;
    public bool $showLabel = false;

    public function barClass(): string
    {
        $classes = ['progress-bar', 'bg-'.$this->variant];

        if ($this->striped || $this->animated) {
            $classes[] = 'progress-bar-striped';
        }
        if ($this->animated) {
            $classes[] = 'progress-bar-animated';
        }

        return implode(' ', $classes);
    }
}
